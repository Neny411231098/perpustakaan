<?php
    ob_start();

    session_start();

    $koneksi = new mysqli("localhost", "root", "", "db_perpustakaan");

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman Login</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <h2> Selamat Datang</h2>
               
        
                 <br />
            </div>
        </div>
         <div class="row ">
               
                  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong> Masukkan Username dan Password </strong>  
                            </div>
                            <div class="panel-body">
                                <form role="form" method="POST">
                                       <br />
                                <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" name="username" class="form-control" placeholder="Your Username " />
                                        </div>

                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" name="pass" class="form-control"  placeholder="Your Password" />
                                        </div>
                                        <input type="submit" name="login" value="login" class="btn btn-primary ">
                                     
                                
                                    
                            </div>
                           
                        </div>
                    </div>
                
                
        </div>
    </div>


     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
   
</body>
</html>

<?php
ob_start();

$koneksi = new mysqli("localhost", "root", "", "db_perpustakaan");

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    $sql = $koneksi->query("SELECT * FROM tb_user WHERE username='$username'");
    $data = $sql->fetch_assoc();
    $ketemu = $sql->num_rows;

    if ($ketemu >= 1) {
        if ($data['password'] == $pass) { // Idealnya pakai password_verify
            if ($data['level'] == "admin") {
                $_SESSION['admin'] = $data['id'];
                header("Location: index.php");
                exit;
            } else if ($data['level'] == "user") {
                $_SESSION['user'] = $data['id'];
                header("Location: index_anggota.php");
                exit;
            } else {
                echo "<script>alert('Level user tidak dikenal');</script>";
            }
        } else {
            echo "<script>alert('Password salah');</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan');</script>";
    }
}
?>
