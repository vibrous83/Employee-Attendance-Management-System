
<?php
session_start();
include "Koneksi.php";
$conn = mysqli_connect($servername, $username, $password, $database);
$username=$_POST['username'];
$password=$_POST['password'];
$login = mysqli_query($conn,"select * from login where username='$username' and password = '$password'");
$cek=mysqli_num_rows($login);
if($cek > 0){
    $data = mysqli_fetch_assoc($login);
    if($data['level']=="admin"){
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "admin";
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['gambar'] = $data['gambar'];
        $_SESSION['ID'] = $data['ID'];
        header("location:dashboard_admin.php");
    }
    else if($data['level']=="user"){
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['level'] = "user";
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['gambar'] = $data['gambar'];
        $_SESSION['jabatan'] = $data['jabatan'];
        $_SESSION['phone'] = $data['phone'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['ID'] = $data['ID'];
        header("location:dashboard_user.php");
    }
}
else{
    echo "<h1>Gagal Login</h1>";
}