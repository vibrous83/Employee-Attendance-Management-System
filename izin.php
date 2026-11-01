<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berikan Keterangan</title>
    <link href="css/kbl.css" rel="stylesheet" >

</head>
<body>
    
<?php

session_start();
include "Koneksi.php";
date_default_timezone_set("Asia/Jakarta");
$conn = mysqli_connect($servername, $username, $password, $database);

$ID=$_SESSION['ID'];
$nama=$_SESSION['nama'];
$tanggal=date('d-m-Y' );
$alasan=$_POST['alasan'];;
$ket = $_POST['ket'];
$namafile=$_FILES["bkt"]["name"];
$namasementara = $_FILES["bkt"]["tmp_name"];
$dirUpload= "bukti/$namafile";
$terupload = move_uploaded_file($namasementara,$dirUpload);
$tes=mysqli_query($conn,"SELECT * FROM absen where ID='$ID' and Tanggal ='$tanggal'");
$cek=mysqli_num_rows($tes);
if($cek == 0){
    mysqli_query($conn,"INSERT INTO `absen`(`ID`, `Nama`, `Masuk`, `Keluar`, `Tanggal`, `Keterangan`, `bukti`) VALUES ('$ID','$nama','$ket','$ket','$tanggal','$alasan','$namafile')");?>
   <header class="masthead">
            <div class="container">
                <div class="masthead-heading text-uppercase">Izin Tercatat</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="absensi_user.php">Kembali</a>
            </div>
        </header>
<?php
}
else{?>
    <header class="masthead">
            <div class="container">
                <div class="masthead-heading text-uppercase">Anda Telah Absen</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="absensi_user.php">Kembali</a>
            </div>
        </header>
    <?php
}
?>
</body>
</html>