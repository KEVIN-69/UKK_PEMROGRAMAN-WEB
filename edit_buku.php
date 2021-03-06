<!-- mengambil data untuk diedit -->
<?php
    include "koneksi.php";
    $id = $_GET['id_buku'];
    $ambildata = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku = '$id'");
    $data= mysqli_fetch_array($ambildata);
?>

<?php

    include "koneksi.php";
    if(isset($_POST['simpan']))
    {
        $judul       = $_POST['judul'];
        $pengarang            = $_POST['pengarang'];
        $penerbit        = $_POST['penerbit'];
  
    //memasukkan gambar
    print_r($_POST);
    $rand     = rand();
    $ekstensi =  array('png','jpg','jpeg','gif');
    $filename = $_FILES['gambar']['name'];
    $ukuran   = $_FILES['gambar']['size'];
    $ext      = pathinfo($filename, PATHINFO_EXTENSION);
    $lama     = $_POST['foto_lama'];
    
    if($filename == ""){ //jika gambar tidak diubah
        mysqli_query($koneksi, "UPDATE buku SET judul='$judul', pengarang='$pengarang', penerbit='$penerbit'
        WHERE id_buku= '$id'") or die(mysqli_error($koneksi));
        
    }else{
    if(!in_array($ext,$ekstensi) ) {
        header("location:daftarbuku.php?alert=gagal_ekstensi");
    }else{
        if($ukuran < 1044070){      
            unlink('imgbuku/'.$lama);
            $xx = $rand.'_'.$filename;
            move_uploaded_file($_FILES['gambar']['tmp_name'], 'imgbuku/'.$rand.'_'.$filename);
            
            mysqli_query($koneksi, "UPDATE buku SET
                judul='$judul', pengarang='$pengarang', penerbit='$penerbit', gambar='$xx'
                WHERE id_buku= '$id'") or die(mysqli_error($koneksi));

            echo "<div align='center'><h5>Silahkan Tunggu, Data Sedang Disimpan...</h5></div>";
            header("location:daftarbuku.php?alert=berhasil");

        }else{
            header("location:daftarbuku.php?alert=gagal_ukuran");
            echo "<div align='center'><h5>Silahkan Tunggu, Data Sedang Disimpan...</h5></div>";
        }
    }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="logo.png">
    <title>Edit Buku || Toko Buku Cemerlang</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="indexadmin.php">
                <img src="logo.png" width="45px">
                <div class="sidebar-brand-text mx-3" style="color:white;">  Toko Buku Cemerlang</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="indexadmin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            

            <!-- Nav Item - Daftar Barang -->
            <li class="nav-item">
                <a class="nav-link" href="daftarbuku.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Daftar Barang</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">ADMIN</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>



                <!-- End of Topbar -->
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Edit Buku</h1>
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label class="form-label">Judul Buku</label>
                <input type="text" class="form-control" name="judul" placeholder="Judul Buku" value="<?php echo $data['judul'] ?>" required>
              </div>
              <div class="mb-3">
              <label class="form-label">Pengarang</label>
                <input type="text" class="form-control" name="pengarang" placeholder="Pengarang Buku" value="<?php echo $data['pengarang'] ?>" required>
              </div>
              <div class="mb-3">
              <label class="form-label">Penerbit</label>
                <input type="text" class="form-control" name="penerbit" placeholder="Penerbit Buku" value="<?php echo $data['penerbit'] ?>" required>
              </div>
              <div class="mb-3">
              <img src="imgbuku/<?php echo $data['gambar']; ?>" height="200"><br>
                <input type="file" class="form-control" name="gambar" value="<?php echo $data['gambar'] ?>" required>
              </div>  <br><br>
              <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                    <a href="daftarbuku.php" class="btn btn-primary">Cancel</a>
            </form><br><br><br>
            </div>

                
          
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; 2021 Toko Buku Cemerlang</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" jika kamu ingin keluar.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>