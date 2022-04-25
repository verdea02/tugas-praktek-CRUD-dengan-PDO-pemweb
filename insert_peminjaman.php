<?php
include "header.php";
include "koneksi.php";

if (isset($_POST['submit'])) {
    $name = $_POST['nama'];
    $title = $_POST['judul'];

    $data[] = $name;
    $data[] = $title;

    $query = 'INSERT INTO peminjaman (nama_peminjam, judul_buku) VALUE (?,?)';
    $insert = $koneksi->prepare($query);
    $insert->execute($data);

    echo '<script>alert("Berhasil Tambah Data");window.location="peminjaman.php"</script>';
}

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Insert Data Peminjaman</h4>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Nama peminjam</label>
                    <input type="text" value="" class="form-control" name="nama" maxlength="25" required>
                </div>
                <?php
                $query = 'SELECT Judul FROM buku';
                $select = $koneksi->prepare($query);
                $select->execute();
                $pilihan = $select->fetchAll();
                ?>
                <div class="form-group">
                    <label>Judul buku</label>
                    <select class="form-control" name="judul" id="" required>
                        <?php foreach ($pilihan as $value) { ?>
                            <option value="<?php echo $value[0]; ?>"><?php echo $value[0]; ?></option>
                        <?php }; ?>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-success" name="Insert"><i class="fa fa-plus"> </i> Insert</button>
            </form>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>