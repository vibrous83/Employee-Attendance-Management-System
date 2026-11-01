<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
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
    <script type="text/javascript" src="./JS/waktu.js" async></script>
    <title>Absensi User</title>
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
            <div class="col-md-10 p-4 d-flex flex-column">
                <div class="row">
                    <div class="col-md-8 p-4">
                        <h1><i class="bi bi-bar-chart"></i> Attendance</h1><br>
                        <p>Waktu Pergi : 08:00:00</p>
                        <p>Waktu Pulang : 17:00:00</p>
                    </div>
                    <div class="col-md-4 p-4 text-center">
                        <h2><i class="bi bi-activity"></i>  Status Kehadiran</h2><br>
                        <h5 class="text-bg-info d-flex justify-content-center p-3">
                        <?php
                            include "Koneksi.php";
                            $conn = mysqli_connect($servername, $username, $password, $database);
                            date_default_timezone_set("Asia/Jakarta");
                            $ID=$_SESSION['ID'];
                            $tanggal=date('d-m-Y' );
                            $ket= "Belum Absen";
                            $tes=mysqli_query($conn,"SELECT * FROM absen where ID='$ID' and Tanggal ='$tanggal'");
                            $cek=mysqli_num_rows($tes);
                            if($cek == 0){
                                $ket = 'Belum Absen';
                            }
                            else{
                                $ket = 'Telah Absen';
                            }
                        echo $ket
                        ?>
                        </h5>
                    </div>
                </div>
                
                <hr width="100%" size="2"><br>
                <div class="row">
                    <h3 class="text-center">Selamat Datang <?php echo $_SESSION['nama'];?>! Silakan Mengisi Absen</h3><br><br>
                    <h5 class="text-center bg-success text-white p-3" style="width: auto; margin: 0 auto;">Absen Harian</h5>
                    <div class="col-md-12 table-container">
                        <table class="table table-bordered table-striped table-centered">
                            <tbody>
                                <tr>
                                    <th scope="row">ID</th>
                                    <td><?php echo $_SESSION['ID'];?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Nama</th>
                                    <td><?php echo $_SESSION['nama'];?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal</th>
                                    <td><?php  echo date('d-m-Y'); ?></div></td>
                                </tr>
                                <tr>
                                    <th scope="row">Waktu</th>
                                    <td><div id="DisplayClock" class="clock" onload="showTime()"></div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <form action="absen.php" method="post" class="d-inline">
                            <button type="submit" name="masuk" class="btn btn-primary">Hadir</button>
                        </form>
                        <form action="keluar.php" method="post" class="d-inline">
                            <button type="submit" name="keluar" class="btn btn-danger">Keluar</button>
                        </form>
                        <form action="tdkhadir.php" method="post" class="d-inline">
                            <button type="submit" name="tdkhdr" class="btn btn-warning">Izin</button>
                        </form>
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