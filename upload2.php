<?php

include 'Koneksi.php';
error_reporting(0);
session_start();

$conn = mysqli_connect($servername, $username, $password, $database);
$ID= @$_GET['ID'];
$namafile=$_FILES["berkas"]["name"];
$namasementara = $_FILES["berkas"]["tmp_name"];
$dirUpload= "Asset/$namafile";
$terupload = move_uploaded_file($namasementara,$dirUpload);
$sql = "UPDATE `login` SET `gambar`='$namafile' WHERE `ID`='$ID'";
$result= mysqli_query($conn,$sql);

if($terupload){?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload Gambar</title>
        <link href="css/kbl.css" rel="stylesheet" >
    </head>
    <body>
    <header class="masthead">
            <div class="container">
                <div class="masthead-heading text-uppercase">Selamat Upload Gambar Anda Berhasil</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="report_admin.php">Kembali</a>
            </div>
        </header>
        <?php

}else{?>
<header class="masthead">
            <div class="container">
                <div class="masthead-heading text-uppercase"> Upload Gambar Gagal</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="report_admin.php">Kembali</a>
            </div>
        </header>
    <?php
}
?>
</body>
    </html>