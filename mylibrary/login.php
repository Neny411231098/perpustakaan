<?php
ob_start();
session_start();
$koneksi = new mysqli("localhost", "root", "", "db_perpustakaan");

// Jika sudah login, langsung redirect ke index
if (isset($_SESSION['admin']) || isset($_SESSION['user'])) {
    header("location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h2>Selamat Datang</h2>
                <h5>(Masukkan Username dan Password)</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Login</strong>
                    </div>
                    <div class="panel-body">
                        <form method="POST">
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="Username" required />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" name="pass" class="form-control" placeholder="Password" required />
                            </div>
                            <input type="submit" name="login" value="Login" class="btn btn-primary btn-block">
                        </form>
                    </div>
                </div>
                <br/>
                <?php
                if (isset($_POST['login'])) {
                    $username = $_POST['username'];
                    $pass = $_POST['pass'];

                    // Query untuk cek user
                    $sql = $koneksi->query("SELECT * FROM tb_user WHERE username='$username' AND password='$pass'");

                    $data = $sql->fetch_assoc();
                    $ketemu = $sql->num_rows;

                    if ($ketemu >= 1) {
                        if ($data['level'] == "admin") {
                            $_SESSION['admin'] = $data['id'];
                        } else {
                            $_SESSION['user'] = $data['id'];
                        }

                        header("location:index.php");
                        exit;
                    } else {
                        echo "<div class='alert alert-danger'>Username atau password salah.</div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
