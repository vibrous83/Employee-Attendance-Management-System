<?php
session_start();
include 'koneksi.php';

$message = '';

// Proses pengubahan password
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
    $currentPassword = $_POST['password'];
    $newPassword = $_POST['new_password'];

    // Asumsikan ID pengguna disimpan di session
    $id = $_SESSION['ID'];

    // Ambil password saat ini dari database untuk pengguna
    $query = "SELECT password FROM login WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }

    $user = mysqli_fetch_assoc($result);

    if ($user && $user['password'] === $currentPassword) {
        // Perbarui password
        $updateQuery = "UPDATE login SET password = '$newPassword' WHERE id = '$id'";
        if (mysqli_query($conn, $updateQuery)) {
            $message = "Password berhasil diubah!";
        } else {
            $message = "Terjadi kesalahan saat mengubah password: " . mysqli_error($conn);
        }
    } else {
        $message = "Password saat ini salah!";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./CSS/styles.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <title>Settings User</title>
</head>
<body>
    <div class="container-fluid p-4 bg-primary text-white">
        <div class="header-container">
            <div class="logo-container">
                <img style="width:80px; height:80px;" src="./Asset/OIP.jpeg" alt="Logo">
                <h1 class="fs-18">ICONNET SBU SUMBAGSEL</h1>
            </div>
            <div class="profile">
                <img src="Asset/<?php echo $_SESSION['gambar'];?>" alt="Profile Picture">
                <p class="mt-3"><?php echo $_SESSION['nama'];?></p>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Vertical Navbar -->
            <div class="col-md-2 bg-light min-vh-100">
                <nav class="navbar navbar-expand-md navbar-light flex-column align-items-start">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="nav flex-column">
                            <li class="nav-item mb-3 pt-3">
                                <a class="nav-link d-flex align-items-center" aria-current="page" href="dashboard_user.php">
                                    <i class="bi bi-speedometer2"></i>ㅤDashboard
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="nav-link" href="./absensi_user.php">
                                    <i class="bi bi-bar-chart"></i>ㅤAttendance
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="nav-link" href="./history_user.php">
                                    <i class="bi bi-clock-history"></i>ㅤHistory
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-gear"></i>ㅤ<b>Settings</b>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a style="color:red;" class="nav-link" href="./cblogout.php">
                                    <i class="bi bi-box-arrow-right"></i>ㅤLogout
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 table-container">
              <div class="row">
                <div class="col-md-12 p-4">
                  <h1><i class="bi bi-gear"></i> Settings</h1>
                </div>
              </div>
            
            <hr width="100%" size="2">

            <div class="container bootstrap snippets bootdeys">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-sm-10">
                            <!-- Avatar -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="card-title">Profile</h4>
                                </div>
                                <div class="card-body text-center">
                                    <img src="Asset/<?php echo $_SESSION['gambar'];?>" style="width: 300px; height: 400px;" alt="Profile Picture">
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-12 d-flex justify-content-center">
                                        <a href="Asset/<?php echo $_SESSION['gambar'];?>" target="_blank" class="btn btn-secondary">View</a>
                                    </div>
                                </div>
                            </div>

                            <!-- User info -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="card-title">User Info</h4>
                                </div>
                                
                                <div class="card-body">
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">Location</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" disabled>
                                                <option>Jambi</option>
                                                <option selected>Sumatera Selatan</option>
                                                <option>Bengkulu</option>
                                                <option>Lampung</option>
                                                <option>Bangka Belitung</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">Company Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="PT INDONESIA COMNETS PLUS PALEMBANG" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">Position</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="<?php echo $_SESSION['jabatan'];?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Contact info -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="card-title">Contact Info</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">E-mail address</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" value="<?php echo $_SESSION['email'];?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">Mobile number</label>
                                        <div class="col-sm-10">
                                            <input type="tel" class="form-control" value="<?php echo $_SESSION['phone'];?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Security --> 
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="card-title">Security</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" class="form-control" placeholder="Enter current password" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">New Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="new_password" class="form-control" placeholder="Enter new password" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-10 offset-sm-2">
                                            <button type="submit" name="change_password" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <?php if ($message): ?>
                                <div class="alert alert-info mt-3"><?php echo $message; ?></div>
                            <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <hr width="100%" size="2">
            <footer class="footer">
                <p><i class="bi bi-geo-alt"></i> Alamat: Jl. Demang Lebar Daun No.375, 20 Ilir D. IV, Kec. Ilir Tim. I, Kota Palembang, Sumatera Selatan 30131</p>
                <p><i class="bi bi-telephone"></i> Telepon: 150678</p>
            </footer>
            
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
