<?php
session_start();
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST['ID'];
    $tanggal = $_POST['tanggal'];

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
    $sql = "DELETE FROM absen WHERE ID = '$ID' AND tanggal = '$tanggal'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Bagian ini berhasil dihapus'); window.location.href = 'history_admin.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
