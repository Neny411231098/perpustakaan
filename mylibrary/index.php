<<?php
session_start();

$koneksi = new mysqli("localhost", "root", "", "db_perpustakaan");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("location:login.php");
    exit;
}
?>


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>mylibrary</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Enjoy Read</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">
    Last access : <?php echo date("d M Y"); ?> &nbsp;
    <a href="login.php" class="btn btn-danger square-btn-adjust">Logout</a>
</div>

        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
                    </li>
                    <li>
                        <a  href="index.php"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>

                    <li>
                        <a  href="?page=anggota"><i class="fa fa-dashboard fa-3x"></i> Data anggota</a>
                    </li>

                    <li>
                        <a  href="?page=buku"><i class="fa fa-dashboard fa-3x"></i> Data buku</a>
                    </li>

                    <li>
                        <a  href="?page=transaksi"><i class="fa fa-dashboard fa-3x"></i> Transaksi</a>
                    </li>
                      
                       
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">

            <?php
$page = isset($_GET['page']) ? $_GET['page'] : '';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

if ($page == "buku") {
    if ($aksi == "") {
        include "page/buku/buku.php";
    } elseif ($aksi == "tambah") {
        include "page/buku/tambah.php";
    } elseif ($aksi == "edit") {
        include "page/buku/edit.php";
    } elseif ($aksi == "hapus") {
        include "page/buku/hapus.php";
    }
} elseif ($page == "anggota") {
    if ($aksi == "") {
        include "page/anggota/anggota.php";
    } elseif ($aksi == "tambah") {
        include "page/anggota/tmbhanggota.php";
    } elseif ($aksi == "edit") {
        include "page/anggota/editanggota.php";
    } elseif ($aksi == "hapus") {
        include "page/anggota/hapusanggota.php";
    }
} elseif ($page == "transaksi") {
    if ($aksi == "") {
        include "page/transaksi/transaksi.php";
    } elseif ($aksi == "tambah") {
        include "page/transaksi/addtransaksi.php";
    } elseif ($aksi == "edit") {
        include "page/transaksi/edittransaksi.php";
    } elseif ($aksi == "hapus") {
        include "page/transaksi/hapustransaksi.php";
    }}elseif ($page==""){
    include "home.php";
}
?>


                     
        
        


                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

    
   
</body>
</html>
