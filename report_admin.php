<?php
session_start();
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
    <title>Report Admin</title>
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
                                <a class="nav-link d-flex align-items-center" aria-current="page" href="./dashboard_admin.php">
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
                  <h1><i class="bi  bi-bar-chart"></i> Report</h1><br>
                  <p>Halaman ini menampilkan data lengkap karyawan dan admin, termasuk ID, Nama, Jabatan, Profil, Username, Password, Level, dan Action.
                     Gunakan fitur pencarian untuk melihat data berdasarkan tanggal tertentu.</p>
                </div>
              </div>
            
            <hr width="100%" size="2">
            
            <!-- Buttons -->
              <div class="row">
                <div class="my-4">
                  <div class="row g-3">
                    <div class="col-auto">
                      <form action="" method='post'>
                        <input type="number" name="cari" class="pt-2 me-2">
                        <button type="submit" name="ari" class="btn btn-primary mb-3"><i class="bi bi-search"></i>   Cari ID</button>
                      </form>
                    </div>
                    <div class="col-auto">
                      <form action="" method='post'>
                        <button type="submit" name="semua" class="btn btn-secondary mb-3">Tampilkan Semua</button>
                      </form>
                    </div>
                    <div class="col-auto">
                      <button onclick="document.location='tambah.php'" type="button" class="btn btn-success mb-3"><i class="bi bi-plus-circle"></i>    Tambah User</button>
                    </div>
                </div>
              </div>
                  
              <!-- Table -->
              <div class="row">
              <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                  <thead class="table-dark">
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Profie</th>
                      <th scope="col">Jabatan</th>
                      <th scope="col">Username</th>
                      <th scope="col">Password</th>
                      <th scope="col">Level</th>
                      <th scope="col">Email</th>
                      <th scope="col">No Telepon</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="tbody">
                  <tr>
                  <?php
                    include "koneksi.php";
                    $conn = mysqli_connect($servername,$username,$password,$database);
                    $ID = $_SESSION['ID'];
                    if(isset($_POST['cari'])){
                      $tgl = $_POST['cari'];
                      $data = mysqli_query($conn, "SELECT * FROM `login` WHERE `ID` = '$tgl'");
                      while ($d = mysqli_fetch_array($data)){
                        ?>  
                        <td><?php echo $d['ID'];?></td>
                        <td><?php echo $d['nama'];?></td>
                        <td><img src="Asset/<?php echo $d['gambar'];?>" width = "100" height = "100">
                        <td><?php echo $d['jabatan'];?></td>
                        <td><?php echo $d['username'];?></td>
                        <td><?php echo $d['password'];?></td>
                        <td><?php echo $d['level'];?></td>
                        <td><?php echo $d['email'];?></td>
                        <td><?php echo $d['phone'];?></td>
                        <td>
                        <a class="btn btn-warning btn-sm m-1 js" href="edit.php?ID=<?php echo $d['ID']; ?>">
                          <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        </button>
                        <form action="hapus_report.php" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                          <input type="hidden" name="ID" value="<?php echo $d['ID']; ?>">
                          <button type="submit" class="btn btn-danger btn-sm m-1">
                              <i class="bi bi-trash"></i> Hapus
                          </button>
                        </form>
                        <button onclick="document.location='upload.php?ID=<?php echo $d['ID']; ?>'" class="btn btn-secondary btn-sm mt-1">
                          <i class="bi bi-upload"></i> Upload
                        </button>
                        </td>
                      </tr>
                      <?php
                      }
                    }
                    elseif(isset($_POST['semua'])) {
                      $data = mysqli_query($conn, "SELECT * FROM `login`");
                      while ($d = mysqli_fetch_array($data)){
                        ?>  
                        <td><?php echo $d['ID'];?></td>
                        <td><?php echo $d['nama'];?></td>
                        <td><img src="Asset/<?php echo $d['gambar'];?>" width = "100" height = "100">
                        <td><?php echo $d['jabatan'];?></td>
                        <td><?php echo $d['username'];?></td>
                        <td><?php echo $d['password'];?></td>
                        <td><?php echo $d['level'];?></td>
                        <td ><?php echo $d['email'];?></td>
                        <td><?php echo $d['phone'];?></td>
                        <td>
                        <a class="btn btn-warning btn-sm m-1 js" href="edit.php?ID=<?php echo $d['ID']; ?>">
                          <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="hapus_report.php" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                          <input type="hidden" name="ID" value="<?php echo $d['ID']; ?>">
                          <button type="submit" class="btn btn-danger btn-sm m-1">
                              <i class="bi bi-trash"></i> Hapus
                          </button>
                        </form>
                        <button onclick="document.location='upload.php?ID=<?php echo $d['ID']; ?>'" class="btn btn-secondary btn-sm mt-1">
                          <i class="bi bi-upload"></i> Upload
                        </button>
                        </td>
                      </tr>
                      <?php
                      }
                    }
                    else {
                      $data = mysqli_query($conn, "SELECT * FROM `login`");
                      while ($d = mysqli_fetch_array($data)){
                        ?> 
                        <td><?php echo $d['ID'];?></td>
                        <td><?php echo $d['nama'];?></td>
                        <td><img src="Asset/<?php echo $d['gambar'];?>" width = "100" height = "100">
                        <td><?php echo $d['jabatan'];?></td>
                        <td><?php echo $d['username'];?></td>
                        <td><?php echo $d['password'];?></td>
                        <td><?php echo $d['level'];?></td>
                        <td><?php echo $d['email'];?></td>
                        <td><?php echo $d['phone'];?></td>
                        <td>
                        <a class="btn btn-warning btn-sm m-1 js" href="edit.php?ID=<?php echo $d['ID']; ?>">
                          <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        </button>
                        <form action="hapus_report.php" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                          <input type="hidden" name="ID" value="<?php echo $d['ID']; ?>">
                          <button type="submit" class="btn btn-danger btn-sm m-1">
                              <i class="bi bi-trash"></i> Hapus
                          </button>
                        </form>
                        <button onclick="document.location='upload.php?ID=<?php echo $d['ID']; ?>'" class="btn btn-secondary btn-sm mt-1">
                          <i class="bi bi-upload"></i> Upload
                        </button>
                        </td>
                      </tr>
                      <?php
                      }
                  }
                  ?>
                </table>
                </div>
              </div>  

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