<?php
include "koneksi.php";
session_start();
if (isset($_SESSION['username'])) {
    header("location: index.php");
}

if (isset($_POST['submit'])) {
    $user = $_POST['name'];
    $pass = $_POST['pass'];

    $data[] = $user;
    $data[] = $pass;

    $query = 'SELECT * FROM pengguna WHERE Username=? AND Password=?';
    $select = $koneksi->prepare($query);
    $select->execute($data);

    $count = $select->rowCount();

    if ($count == 1) {
        $_SESSION['username'] = $user;
        header("location: index.php");
    } else {
        echo '<script>alert("Gagal Login");window.location="login.php"</script>';
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

    <title>Login</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-info">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-black-900 mb-4">Selamat Datang!</h1>
                                    </div>
                                    <form class="user" action="" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="" name="name" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="pass" placeholder="Password" required>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" type="submit" name="submit">Login</button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>