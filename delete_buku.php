<?php
include('koneksi.php');
$id = $_GET['id'];
$cover = 'SELECT Cover_buku FROM buku WHERE Id_buku= ?';
$proses = $koneksi->prepare($cover);
$proses->execute(array($id));
$data = $proses->fetch();
$sql = "DELETE FROM buku WHERE Id_buku= ?";
$row = $koneksi->prepare($sql);
$row->execute(array($id));
unlink('uploads/' . $data['Cover_buku']);
echo '<script>alert("Berhasil Hapus Data");window.location="buku.php"</script>';
