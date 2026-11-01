<?php
session_start();

if(isset($_SESSION['username'])) {
    session_unset(); 
    session_destroy(); 

    header("Location: http://localhost/absensi/index.php");
    exit();

   } else {
    echo 'Terjadi Masalah';
    exit(); 
}
?>