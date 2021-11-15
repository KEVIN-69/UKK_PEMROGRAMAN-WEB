<?php
 session_start();

 // cek apakah yang mengakses halaman ini sudah login
 if($_SESSION['level']==""){
  header("location:login.php?pesan=gagal");
 }

 ?>

 <?php 
  error_reporting(0);
  include 'koneksi.php';

  $buku = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku = '".$_GET['id']."' ");
  $b = mysqli_fetch_object($buku);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="logo.png">
    <title>Toko Buku Cemerlang</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-primary static-top shadow">

  <div class="container">
    <h1><a href="homepage.php" class="navbar-brand" style="color:white;"><img src="logo.png" width="50px">   Toko Buku Cemerlang</a></h1>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">



      <ul class="navbar-nav ml-auto">

        <li class="nav-item active">
          <a class="nav-link" href="homepage.php" style="color:white;">Daftar Buku <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="keluar.php" style="color:white;">Keluar <span class="sr-only">(current)</span></a>
        </li>
      </ul>

    </div>
  </div>
</nav>
<br>
  

      <div class="container">

    <form class="d-flex" action="homepage.php" method="GET">
      <input class="form-control me-2 bg-white border-2 small" type="text" placeholder="Search" aria-describedby="basic-addon2" aria-label="Masukkan judul buku" name="cari">
      <div class="input-group-append">
              <button class="btn btn-primary" type="submit" value="Cari">
                      <i class="fas fa-search fa-sm"></i>
              </button>
      </div>
    </form><br>
  </div>

   <div class="container">
<?php
    include "koneksi.php";
    if(isset($_GET['cari']))
    {
        $cari = $_GET['cari'];

        echo "<b> Hasil Pencarian : " .$cari."</b>";

    }
?>
</div>
    <!-- product detail -->

    <div class="container">
      
      <h3>Detail Buku</h3>
        <div class="card-body col-k2">
          <img src="imgbuku/<?php echo $b->gambar ?>" class="card-img-top" height="500">
        </div>
        <div class="col-k2">
          <h3><?php echo $b->judul ?></h3>
          <p>Pengarang :<br>
            <?php echo $b->pengarang ?>
          </p>
          <p>Penerbit :<br>
            <?php echo $b->penerbit ?>
          
        
      </div>
    </div>

    <div class="container-fluid card">
            <footer class="sticky-footer bg-white">
                
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; 2021 Toko Buku Cemerlang</span>
                    </div>
                
            </footer>
      </div>
    
    </div>   
</body>
</html>