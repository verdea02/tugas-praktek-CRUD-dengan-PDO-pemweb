<?php
include "header.php";
include "koneksi.php";

if (isset($_POST['submit'])) {
    $name = $_POST['nama'];
    $title = $_POST['judul'];
    $id = $_POST['id'];

    $data[] = $name;
    $data[] = $title;
    $data[] = $id;

    $query = 'UPDATE peminjaman SET nama_peminjam=?, judul_buku=?, waktu_peminjaman=now() WHERE Id_peminjaman=?';
    $update = $koneksi->prepare($query);
    $update->execute($data);

    echo '<script>alert("Berhasil Edit Data");window.location="peminjaman.php"</script>';
}

$id = $_GET['id'];
$query = 'SELECT * FROM peminjaman WHERE Id_peminjaman =?';
$select = $koneksi->prepare($query);
$select->execute(array($id));
$value = $select->fetch();
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Update Data Peminjaman</h4>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Nama Peminjam</label>
                    <input type="text" value="<?php echo $value['nama_peminjam']; ?>" class="form-control" name="nama" maxlength="25" required>
                </div>
                <div class="form-group">
                    <label>Judul buku</label>
                    <select class="form-control" name="judul" id="" required>
                        <?php
                        $query = 'SELECT Judul FROM buku';
                        $select = $koneksi->prepare($query);
                        $select->execute();
                        $pilihan = $select->fetchAll();
                        foreach ($pilihan as $isi) { ?>
                            <option value="<?php echo $isi[0]; ?>" <?php if ($value['judul_buku'] == $isi[0]) {
                                                                        echo "selected";
                                                                    } ?>><?php echo $isi[0]; ?></option>
                        <?php }; ?>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?php echo $value['Id_peminjaman']; ?>">
                <button type="submit" name="submit" class="btn btn-info" name="Insert"><i class="fa fa-plus"> </i> Update</button>
            </form>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>