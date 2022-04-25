<?php
include('koneksi.php');
$id = $_GET['id'];
$sql = "DELETE FROM pengguna WHERE Id_user= ?";
$row = $koneksi->prepare($sql);
$row->execute(array($id));
echo '<script>alert("Berhasil Hapus Data");window.location="pengguna.php"</script>';
