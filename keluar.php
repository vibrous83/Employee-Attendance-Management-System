<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keluar</title>
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
    $tes=mysqli_query($conn,"SELECT * FROM absen where ID='$ID' and Tanggal ='$tanggal'");
    $cek=mysqli_num_rows($tes);

        if($cek > 0){
            $izin=mysqli_query($conn,"SELECT * FROM absen where ID='$ID' and Tanggal ='$tanggal' and (Keluar = 'IZIN' or Keluar = 'SAKIT')");
            $cizin= mysqli_num_rows($izin);

            if($cizin == 0){
                $sdh = mysqli_query($conn,"SELECT * FROM absen where  ID='$ID' and Keluar IS NULL and Tanggal ='$tanggal'");
                $scek=mysqli_num_rows($sdh);

                if($scek > 0){
                    mysqli_query($conn,"UPDATE `absen` SET `Keluar`='$waktu' WHERE ID='$ID' and Tanggal ='$tanggal'");
                    ?>
                    
                <header class="masthead">
                    <div class="container">
                        <div class="masthead-heading text-uppercase">Sampai Jumpa Lagi</div>
                        <a class="btn btn-primary btn-xl text-uppercase" href="dashboard_user.php">Kembali</a>
                    </div>
                </header>
                    <?php
                }
                
                else{?>
                    <header class="masthead">
                    <div class="container">
                        <div class="masthead-heading text-uppercase"> Anda Sudah Keluar</div>
                        <a class="btn btn-primary btn-xl text-uppercase" href="dashboard_user.php">Kembali</a>
                    </div>
                </header>
                <?php
                }
            }

            else{?>
                    <header class="masthead">
                    <div class="container">
                        <div class="masthead-heading text-uppercase"> Anda Telah Izin</div>
                        <a class="btn btn-primary btn-xl text-uppercase" href="dashboard_user.php">Kembali</a>
                    </div>
                </header>
                <?php
            }
        }

        else{?>
                <header class="masthead">
                    <div class="container">
                        <div class="masthead-heading text-uppercase"> Anda Belum Absen</div>
                        <a class="btn btn-primary btn-xl text-uppercase" href="dashboard_user.php">Kembali</a>
                    </div>
                </header>
            <?php
        }
        ?>

</body>
</html>