<?php
$servername='localhost';
$username='root';
$password='';
$database='sistemabsensi';

$conn = mysqli_connect($servername,$username,$password,$database);
// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>