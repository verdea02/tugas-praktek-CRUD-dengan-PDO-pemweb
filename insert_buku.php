<?php
include "header.php";
include "koneksi.php";

if (isset($_POST['submit'])) {

    $title = $_POST['judul'];
    $writer = $_POST['penulis'];
    $publisher = $_POST['penerbit'];
    $release = $_POST['tahun'];
    $filename = $_FILES['cover']['name'];
    $filetemp = $_FILES['cover']['tmp_name'];
    $filetype = $_FILES['cover']['type'];
    $filesize = $_FILES['cover']['size'];
    $target_dir = ('uploads/');
    $removeExtension = explode('.', basename($filename));
    $rename = date("m-d-y") . "." . date("h-i-s") . "." .  "$removeExtension[0]" . ".$removeExtension[1]";
    $target_file = $target_dir . $rename;

    $data[] = $title;
    $data[] = $writer;
    $data[] = $publisher;
    $data[] = $release;
    $data[] = $rename;

    if ($filetype == 'image/png' || $filetype == 'image/jpg' || $filetype == 'image/jpeg') {
        if (move_uploaded_file($filetemp, $target_file)) {
            $query = 'INSERT INTO buku (Judul, Penulis, Penerbit, Tahun_terbit, Cover_buku) VALUE (?,?,?,?,?)';
            $insert = $koneksi->prepare($query);
            $insert->execute($data);

            echo '<script>alert("Berhasil Tambah Data");window.location="buku.php"</script>';
        }
    } else {
        echo '<script>alert("hanya dapat upload file PNG/JPEG/JPG");window.location="insert_buku.php"</script>';
    }
}

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Insert Data Buku</h4>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Judul buku</label>
                    <input type="text" value="" class="form-control" name="judul" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label>Penulis</label>
                    <input type="text" value="" class="form-control" name="penulis" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" value="" class="form-control" name="penerbit" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label>Cover buku</label>
                    <input class="form-control" type="file" id="cover" name="cover" required>
                </div>
                <div class="form-group">
                    <label>Tahun terbit</label>
                    <select class="form-control" name="tahun" id="" required>
                        <?php for ($i = 1990; $i <= 2025; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
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