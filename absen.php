<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <link href="css/kbl.css" rel="stylesheet" >
</head>
<body>
<?php
    session_start();
    include "Koneksi.php";
    $conn = mysqli_connect($servername, $username, $password, $database);
    date_default_timezone_set("Asia/Jakarta");
    $ID=$_SESSION['ID'];
    $nama=$_SESSION['nama'];
    $tanggal=date('d-m-Y' );
    $waktu=date('H:i:s' );
    $ket= "Hadir";
    $tes=mysqli_query($conn,"SELECT * FROM absen where ID='$ID' and Tanggal ='$tanggal'");
    $cek=mysqli_num_rows($tes);

        if($cek == 0){
            mysqli_query($conn,"INSERT INTO `absen`(`ID`, `Nama`, `Masuk`, `Tanggal`, `Keterangan`) VALUES ('$ID','$nama','$waktu','$tanggal','$ket')");?>
            <header class="masthead">
                    <div class="container">
                        <div class="masthead-heading text-uppercase">Absensi Tercatat</div>
                        <a class="btn btn-primary btn-xl text-uppercase" href="absensi_user.php">Kembali</a>
                    </div>
                </header>
            <?php
        }

        else{
            $izin=mysqli_query($conn,"SELECT * FROM absen where ID='$ID' and Tanggal ='$tanggal' and Masuk = 'IZIN' or Masuk = 'SAKIT'");
            $cizin= mysqli_num_rows($izin);
                if($cizin == 0){?>
                <header class="masthead">
                        <div class="container">
                            <div class="masthead-heading text-uppercase">Anda Telah Absen</div>
                            <a class="btn btn-primary btn-xl text-uppercase" href="absensi_user.php">Kembali</a>
                        </div>
                    </header>
                        <?php
                }
                else{?>
                        <header class="masthead">
                        <div class="container">
                            <div class="masthead-heading text-uppercase">Anda Telah Izin</div>
                            <a class="btn btn-primary btn-xl text-uppercase" href="absensi_user.php">Kembali</a>
                        </div>
                    </header>

                    <?php
                }
        }
        ?>


</body>
</html>