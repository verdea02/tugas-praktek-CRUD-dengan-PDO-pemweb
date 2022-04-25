<?php
$user = "root";
$pass = "";
try {
    $koneksi = new PDO('mysql:host=localhost;dbname=perpus', $user, $pass);
    $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $th) {
    die("koneksi gagal" . $th->getMessage());
}
