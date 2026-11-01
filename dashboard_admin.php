<?php
session_start();

include "Koneksi.php";
$conn = mysqli_connect($servername, $username, $password, $database);
date_default_timezone_set("Asia/Jakarta");

// Query untuk mendapatkan data dari database
// 1. Jumlah karyawan
$jumlah_karyawan_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM login where level='user'");
$jumlah_karyawan = mysqli_fetch_assoc($jumlah_karyawan_result)['total'];

// 2. Jumlah absensi
$jumlah_absensi_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM absen");
$jumlah_absensi = mysqli_fetch_assoc($jumlah_absensi_result)['total'];

// 3. Jumlah jabatan
$jumlah_jabatan_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM login");
$jumlah_jabatan = mysqli_fetch_assoc($jumlah_jabatan_result)['total'];

// 4. Jumlah kehadiran 
$kehadiran_result = mysqli_query($conn, "SELECT COUNT(*) as hadir FROM absen WHERE keterangan = 'Hadir'");
$kehadiran = mysqli_fetch_assoc($kehadiran_result)['hadir'];

// 5. Jumlah izin 
$izin_result = mysqli_query($conn, "SELECT COUNT(*) as izin FROM absen WHERE masuk = 'IZIN' ");
$izin = mysqli_fetch_assoc($izin_result)['izin'];

// 6. Jumlah sakit 
$sakit_result = mysqli_query($conn, "SELECT COUNT(*) as sakit FROM absen WHERE masuk = 'Sakit'");
$sakit = mysqli_fetch_assoc($sakit_result)['sakit'];

// Perhitungan persentase kehadiran, izin, dan sakit
$persentase_kehadiran = ($kehadiran / $jumlah_absensi) * 100;
$persentase_izin = ($izin / $jumlah_absensi) * 100;
$persentase_sakit = ($sakit / $jumlah_absensi) * 100;


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./CSS/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="./JS/waktu.js" async></script>
    <title>Dashboard Admin</title>
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
                                <a class="nav-link d-flex align-items-center" aria-current="page" href="#">
                                    <i class="bi bi-speedometer2"></i><b>ㅤDashboard</b>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="nav-link" href="./report_admin.php">
                                    <i class="bi bi-bar-chart"></i>ㅤReport
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="nav-link" href="./history_admin.php">
                                    <i class="bi bi-clock-history"></i>ㅤHistory
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
                        <h1><i class="bi bi-speedometer2"></i> Dashboard</h1><br>
                        <h5>Selamat Datang <?php echo $_SESSION['nama'];?>!</h5>
                    </div>
                    <div class="col-md-4 p-4 text-center">
                        <h1><i class="bi bi-clock"> Waktu</i></h1><br>
                        <div id="DisplayClock" class="clock" onload="showTime()"></div>
                    </div>
                    <div class="col-md-12 p-4">
                        <p>Sistem absensi ICONNET SBU SUMBAGSEL adalah sistem yang dirancang untuk memudahkan pengelolaan kehadiran karyawan secara digital. 
                            Melalui aplikasi ini, admin dapat dengan mudah memantau kehadiran karyawan, mengedit data karyawan, serta melihat statistik absensi.
                            Sistem ini mendukung transparansi dan akurasi dalam pencatatan kehadiran, serta meningkatkan produktivitas melalui otomatisasi laporan kehadiran.</p>
                    </div>
                </div>
                <hr width="100%" size="2">

                <div class="row mt-4 d-flex justify-content-center">
                    <div class="col-md-3 mx-3 d-flex flex-column align-items-center p-3 mb-2 bg-info text-white">
                        <p>Jumlah Karyawan</p>
                        <p style="font-size: 36px;"><b><?php echo $jumlah_karyawan; ?></b></p>
                    </div>

                    <div class="col-md-3 mx-3 d-flex flex-column align-items-center p-3 mb-2 bg-secondary text-white">
                        <p>Jumlah Absensi</p>
                        <p style="font-size: 36px;"><b><?php echo $jumlah_absensi; ?></b></p>
                    </div>

                    <div class="col-md-3 mx-3 d-flex flex-column align-items-center p-3 mb-2 text-white" style="background-color: salmon">
                        <p>Jumlah Jabatan</p>
                        <p style="font-size: 36px;"><b><?php echo $jumlah_jabatan; ?></b></p>
                    </div>

                </div>

                <div class="row mt-4 d-flex justify-content-center">
                    <div class="col-md-3 mx-3 d-flex flex-column align-items-center p-3 mb-2 bg-success text-white">
                        <p>Jumlah Kehadiran</p>
                        <p style="font-size: 36px;"><b><?php echo round($persentase_kehadiran, 2); ?>%</b></p>
                        <p><?php echo $kehadiran; ?>/<?php echo $jumlah_absensi; ?></p>
                    </div>

                    <div class="col-md-3 mx-3 d-flex flex-column align-items-center p-3 mb-2 bg-warning text-white">
                        <p>Jumlah Izin</p>
                        <p style="font-size: 36px;"><b><?php echo round($persentase_izin, 2); ?>%</b></p>
                        <p><?php echo $izin; ?>/<?php echo $jumlah_absensi; ?></p>
                    </div>

                    <div class="col-md-3 mx-3 d-flex flex-column align-items-center p-3 mb-2 bg-danger text-white">
                        <p>Jumlah Sakit</p>
                        <p style="font-size: 36px;"><b><?php echo round($persentase_sakit, 2); ?>%</b></p>
                        <p><?php echo $sakit; ?>/<?php echo $jumlah_absensi; ?></p>
                    </div>
                </div>

                <div class="row mt-4 d-flex justify-content-center">
                    <div class="col mt-12 d-flex justify-content-center">
                        <iframe src="https://calendar.google.com/calendar/embed?src=gamerazka699%40gmail.com&ctz=Asia%2FJakarta" style="border: 0" width="750" height="450" frameborder="0" scrolling="no"></iframe>
                    </div>
                </div>

                <hr width="100%" size="2">
                <footer class="footer">
                    <p><i class="bi bi-geo-alt">  Alamat : Jl. Demang Lebar Daun No.375, 20 Ilir D. IV, Kec. Ilir Tim. I, Kota Palembang, Sumatera Selatan 30131</p></i>
                    <p><i class="bi bi-telephone">  Telepon : 150678</i></p>
                </footer>

            </div>
            
        </div>

    </div>
</body>
</html>
