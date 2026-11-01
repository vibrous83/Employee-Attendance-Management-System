<?php
session_start();
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST['ID'];

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
    $sql = "DELETE FROM login WHERE ID = '$ID'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('User berhasil dihapus'); window.location.href = 'report_admin.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Tutup koneksi
    mysqli_close($conn);
}
?>
