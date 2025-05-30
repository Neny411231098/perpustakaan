
<?php
session_start();

$koneksi = new mysqli("localhost", "root", "", "db_perpustakaan");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}


if (!isset($_SESSION['user'])) {
    header("location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Dashboard Anggota - Enjoy Read</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<body>
    <div id="wrapper">
        <!-- Navbar atas -->
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="index_anggota.php">Enjoy Read</a> 
            </div>
            <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                Last access : <?php echo date("d M Y"); ?> &nbsp;
                <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
            </div>
        </nav>

        <!-- Sidebar -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="assets/img/find_user.png" class="user-image img-responsive"/>
                    </li>
                    <li>
                        <a href="index_anggota.php"><i class="fa fa-book fa-3x"></i> Daftar Buku</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Konten utama -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <marquee>Selamat Datang di Enjoy Read</marquee>
                <h2>Daftar Buku</h2>
                <table class="table table-striped table-bordered" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>ID Buku</th>
                            <th>Judul Buku</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Jumlah Buku</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = $koneksi->query("SELECT * FROM tb_buku");
                        while ($row = $sql->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['id_buku']}</td>
                                <td>{$row['judul_buku']}</td>
                                <td>{$row['pengarang']}</td>
                                <td>{$row['penerbit']}</td>
                                <td>{$row['tahun_terbit']}</td>
                                <td>{$row['jumlah_buku']}</td>
                                <td>{$row['lokasi']}</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
