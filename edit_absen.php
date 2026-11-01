<?php
include 'Koneksi.php';
session_start();

$conn = mysqli_connect($servername, $username, $password, $database);
$id = @$_GET['ID'];
$tgl = @$_GET['tgl'];
$data=mysqli_query($conn,"SELECT * FROM `absen` WHERE `ID`='$id' AND `Tanggal`='$tgl'");
$d=mysqli_fetch_array($data);

if (isset($_GET['ID']) && isset($_GET['tgl'])) {
    $id = $_GET['ID'];
    $data = mysqli_query($conn, "SELECT * FROM `absen` WHERE ID='$id'");
    $d = mysqli_fetch_array($data);

    if (isset($_POST['submit'])) {
        $Masuk=$_POST['masuk'];
        $Keluar=$_POST['keluar'];
        $Tanggal=$_POST['tgl'];
        $ket=$_POST['ket'];
        $sql = "UPDATE `absen` SET `Masuk`='$Masuk',`Keluar`='$Keluar',`Tanggal`='$Tanggal',`Keterangan`='$ket' WHERE `ID`='$id' and `Tanggal`='$tgl'";
        $result= mysqli_query($conn,$sql);

        if($result){
            echo "<script>alert('Data telah diupdate'); window.location = 'history_admin.php'; </script>";
        }
        else{
        echo "Update Data Gagal";
        }
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
    <title>Edit Absen</title>
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
                                <a class="nav-link" href="./report_admin.php">
                                    <i class="bi bi-bar-chart"></i>ㅤReport
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-clock-history"></i>ㅤ<b>History</b>
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
                  <h1><i class="bi bi-pencil-square"></i>  Edit Absen</h1><br>
                </div>
            
            <hr width="100%" size="2">
            
            <!-- Table -->
            <div class="col-md-12 table-container">
              <table class="table table-bordered table-striped table-centered">
                  <tbody>
                    <form action="" method="post">
                      <tr>
                          <th scope="row">ID</th>
                          <td><input class="form-control inputlg" type="number" name="ID" value="<?php echo $id;?>" disabled></td> 
                      </tr>
                      <tr>
                          <th scope="row">Nama</th>
                          <td><input class="form-control inputlg" type="text" name="username"   value="<?php echo $d['nama']; ?>" disabled></td>
                      </tr>
                      <tr>
                          <th scope="row">Jam Masuk </th>
                          <td><input class="form-control inputlg" type="text" name="masuk" value="<?php echo $d['masuk']; ?>"></td>
                      </tr>
                      <tr>
                        <th scope="row">Jam Keluar </th>
                        <td><input class="form-control inputlg" type="text" name="keluar" value="<?php echo $d['keluar']; ?>"></td>
                      </tr>
                      <tr>
                        <th scope="row">Tanggal</th>
                        <td><input class="form-control inputlg" type="text" name="tgl" id="datepicker" value="<?php echo $d['tanggal']; ?>"></td>
                      </tr>
                      <tr>
                        <th scope="row">Keterangan</th>
                        <td><input class="form-control inputlg" type="text" name="ket" value="<?php echo $d['keterangan']; ?>"></td>
                      </tr>
                  </tbody>
              </table>
            </div>

            <div class="col-md-12 d-flex justify-content-center">
                <div class="col-auto">
                <button onclick="document.location='history_admin.php'" type="button" class="btn btn-secondary mb-3 me-3"><i class="bi bi-arrow-return-left"></i>    Kembali</button>
                <button type="submit" name="submit" class="btn btn-success mb-3 me-3"><i class="bi bi-save"></i>    Simpan Perubahan</button>
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

<script>
$(function() {
    $("#datepicker").datepicker({
        dateFormat: "dd-mm-yy" // Format tanggal agar sesuai dengan format yang diinputkan
    });
});
</script>

</body>
</html>