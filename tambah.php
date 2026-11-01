<?php
include 'koneksi.php';
session_start();
$conn = mysqli_connect($servername, $username, $password, $database);

if (isset($_POST['submit'])){
    $id = $_POST['ID'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $nama=$_POST['nama'];
    $level=$_POST['level'];
    $jabatan=$_POST['jabatan'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $sql = "INSERT INTO `login`(`ID`, `username`, `password`, `nama`, `Level`, `jabatan`, `email`, `phone`) VALUES ('$id','$username','$password','$nama','$level', '$jabatan' ,'$email', '$phone')";

$result= mysqli_query($conn,$sql);
if($result){
    echo "<script>alert('Data telah ditambah'); window.location.href = 'report_admin.php';</script>";    
    $_POST['username'] = "";
    $_POST['password'] = "";
    $_POST['nama'] = "";
    $_POST['level'] = "";
    $_POST['jabatan'] = "";
}
else{
echo "Data ditambah gagal";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./CSS/styles.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <title>Tambah</title>
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
                                <a class="nav-link d-flex align-items-center" aria-current="page" href="dashboard_admin.php">
                                    <i class="bi bi-speedometer2"></i>ㅤDashboard
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-bar-chart"></i>ㅤ<b>Report</b>
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
            <div class="col-md-10 table-container">
              <div class="row">
                <div class="col-md-12 p-4">
                  <h1><i class="bi bi-plus-circle"></i>  Tambah User</h1><br>
                </div>
            
            <hr width="100%" size="2">
            
            <!-- Table -->
            <div class="col-md-12 table-container">
              <table class="table table-bordered table-striped table-centered">
                  <tbody>
                  <form action="" method="post">
                      <tr>
                          <th scope="row">ID</th>
                          <td><input class="form-control inputlg" type="number" name="ID" required></td> 
                      </tr>
                      <tr>
                          <th scope="row">Username</th>
                          <td><input class="form-control inputlg" type="text" name="username" required></td>
                      </tr>
                      <tr>
                          <th scope="row">Password</th>
                          <td><input class="form-control inputlg" type="text" name="password" required></td>
                      </tr>
                      <tr>
                          <th scope="row">Nama</th>
                          <td><input class="form-control inputlg" type="text" name="nama" required></td>
                      </tr> 
                      <tr>
                          <th scope="row">Email</th>
                          <td><input class="form-control inputlg" type="email" name="email"></td>
                      </tr> 
                      <tr>
                          <th scope="row">No Telepon</th>
                          <td><input class="form-control inputlg" type="text" name="phone"></td>
                      </tr> 
                      <tr>
                          <th scope="row">Level</th>
                          <td><select name="level" id="level" class="form-select form-select-md" required>
                            <option value="" selected disabled>Pilih Level</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                            </select></td>
                      </tr>
                      <tr>
                        <th scope="row">Jabatan</th>
                        <td><select name="jabatan" id="jabatan" class="form-select form-select-md">
                            <option value="" selected disabled>Pilih Jabatan</option>
                            <option value="Staff of NOC">Staff of NOC</option>
                            <option value="Staff of Retail">Staff of Retail</option>
                            <option value="Staff of Asset">Staff of Asset</option>
                            <option value="Staff of Asset">Admin</option>
                            </select>
                        </td>
                      </tr>
                  </tbody>
              </table>
            </div>

            <div class="col-md-12 d-flex justify-content-center">
                <div class="col-auto">
                    <button  onclick="document.location='report_admin.php'" type="button" class="btn btn-secondary mb-3 me-3"><i class="bi bi-arrow-return-left"></i>    Kembali</button>
                    <button type="submit" name="submit" class="btn btn-success mb-3 me-3"><i class="bi bi-plus-circle"></i>    Tambah User</button>
                </div>
            </div>
            </form>


            <!-- Footer -->
            <hr width="100%" size="2">
            <footer class="footer">
                <p><i class="bi bi-geo-alt"></i> Alamat: Jl. Demang Lebar Daun No.375, 20 Ilir D. IV, Kec. Ilir Tim. I, Kota Palembang, Sumatera Selatan 30131</p>
                <p><i class="bi bi-telephone"></i> Telepon: 150678</p>
            </footer>
            
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>