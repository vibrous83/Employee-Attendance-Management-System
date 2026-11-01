<?php
session_start();
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
    <title>History User</title>
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
                                <a class="nav-link" href="#">
                                    <i class="bi bi-clock-history"></i><b>ㅤHistory</b>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="nav-link" href="./settings_user.php">
                                    <i class="bi bi-gear"></i>ㅤSettings
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
                  <h1><i class="bi bi-clock-history"></i> Attendance History</h1><br>
                  <p>Halaman ini menampilkan riwayat absensi <?php echo $_SESSION['nama']?>, termasuk waktu hadir, waktu keluar, 
                    dan status kehadiran untuk setiap hari. Gunakan fitur pencarian untuk melihat data berdasarkan tanggal tertentu.</p>
               </div>
              </div>
            
            <hr width="100%" size="2">
            
            <!-- Datepicker and Buttons -->
            <div class="row">
              <div class="my-4">
                <form class="row g-3" method="GET" action="">
                  <div class="col-auto">
                    <input type="text" class="form-control" id="datepicker" name="tanggal" placeholder="Select Date">
                  </div>
                  <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3"><i class="bi bi-search"></i> Cari Tanggal</button>
                  </div>
                  <div class="col-auto">
                    <button type="submit" class="btn btn-secondary mb-3" name="tampilkan_semua" value="1">Tampilkan Semua</button>
                  </div>
                </form>
              </div>
                
            <!-- Table -->
            <div class="table-responsive">
              <table class="table table-striped table-bordered text-center">
                <thead class="table-dark">
                  <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jam Hadir</th>
                    <th scope="col">Jam Keluar</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    include "koneksi.php";
                    $conn = mysqli_connect($servername, $username, $password, $database);
                    $id = $_SESSION['ID'];

                    // Cek apakah pencarian tanggal dilakukan
                    if (isset($_GET['tanggal']) && !empty($_GET['tanggal'])) {
                        $tanggal = $_GET['tanggal'];
                        // Query berdasarkan tanggal yang dipilih
                        $data = mysqli_query($conn, "SELECT * FROM `absen` WHERE ID = $id AND tanggal = '$tanggal'");
                    } else {
                        // Jika tombol "Tampilkan Semua" ditekan atau halaman pertama kali dibuka
                        $data = mysqli_query($conn, "SELECT * FROM `absen` WHERE ID = $id");
                    }

                    while ($d = mysqli_fetch_array($data)) {
                  ?>
                  <tr>
                    <td><?php echo $d['tanggal']; ?></td>
                    <td><?php echo $d['masuk']; ?></td>
                    <td><?php echo $d['keluar']; ?></td>
                    <td><?php echo $d['keterangan']; ?></td>
                  </tr>
                  <?php
                    }
                  ?>
                </tbody>
              </table>
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

<!-- Activate Datepicker -->
<script>
$(function() {
    $("#datepicker").datepicker({
        dateFormat: "dd-mm-yy" // Format tanggal agar sesuai dengan format MySQL
    });
});
</script>

</body>
</html>
