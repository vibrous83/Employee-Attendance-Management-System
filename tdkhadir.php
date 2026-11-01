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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Tidak Hadir</title>
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
                                <a class="nav-link d-flex align-items-center" aria-current="page" href="./dashboard_user.php">
                                    <i class="bi bi-speedometer2"></i>ㅤDashboard
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-bar-chart"></i><b>ㅤAttendance</b>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="nav-link" href="./history_user.php">
                                    <i class="bi bi-clock-history"></i>ㅤHistory
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
            <div class="col-md-10">
                <div class="row">
                    <div class="table-responsive table--no-card m-b-30">
                        <div class="form-group"><br>
                        <h2 class="text-center"><?php echo $_SESSION['nama'];?>, Mohon Berikan Keterangan Izin</h2><br>
                            <table class="table table-borderless table-striped table-earning" >
                                <tbody>
                                    <form action="izin.php" method="post" enctype="multipart/form-data">
                                    <tr>
                                        <td>Keterangan</td>
                                        <td><select name="ket" class="form-control">
                                      <option value="IZIN">Izin</option>
                                    <option value="SAKIT">Sakit</option></select></td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Alasan</td>
                                        <td><input type="text" class="form-control" name="alasan" required></td>
                                    </tr>
                                    <tr>
                                        <td>Bukti</td>
                                        <td><input type="file" class="form-control" name="bkt" required></td>
                                    </tr>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-success ps-5 pe-5" type="submit" name="masuk">Izin</button></center></td>
                                    </form>
                        <button class="btn btn-secondary ps-5 pe-5" onclick="document.location='./absensi_user.php'">Kembali</button></center></td>
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
</body>
</html>