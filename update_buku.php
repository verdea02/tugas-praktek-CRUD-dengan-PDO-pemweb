<?php
include "header.php";
include "koneksi.php";

if (isset($_POST['submit'])) {

    $title = $_POST['judul'];
    $writer = $_POST['penulis'];
    $publisher = $_POST['penerbit'];
    $release = $_POST['tahun'];
    $id = $_POST['id'];
    $filename = $_FILES['cover']['name'];
    $filetemp = $_FILES['cover']['tmp_name'];
    $filetype = $_FILES['cover']['type'];
    $filesize = $_FILES['cover']['size'];

    if ($filename == "") {

        $data[] = $title;
        $data[] = $writer;
        $data[] = $publisher;
        $data[] = $release;
        $data[] = $id;
        $query = 'UPDATE buku SET Judul=?, Penulis=?, Penerbit=?, Tahun_terbit=? WHERE Id_buku =?';
        $update = $koneksi->prepare($query);
        $update->execute($data);
        echo '<script>alert("Berhasil Edit Data");window.location="buku.php"</script>';
    } else {

        $target_dir = ('uploads/');
        $removeExtension = explode('.', basename($filename));
        $rename = date("m-d-y") . "." . date("h-i-s") . "." .  "$removeExtension[0]" . ".$removeExtension[1]";
        $target_file = $target_dir . $rename;

        $cover = 'SELECT Cover_buku FROM buku WHERE Id_buku= ?';
        $proses = $koneksi->prepare($cover);
        $proses->execute(array($id));
        $lama = $proses->fetch();
        if ($filetype == 'image/png' || $filetype == 'image/jpg' || $filetype == 'image/jpeg') {
            $data[] = $title;
            $data[] = $writer;
            $data[] = $publisher;
            $data[] = $release;
            $data[] = $rename;
            $data[] = $id;
            print_r($data);
            if (move_uploaded_file($filetemp, $target_file)) {
                unlink('uploads/' . $lama['Cover_buku']);
                $query = 'UPDATE buku SET Judul=?, Penulis=?, Penerbit=?, Tahun_terbit=?, Cover_buku=? WHERE Id_buku=?';
                $update = $koneksi->prepare($query);
                $update->execute($data);

                echo '<script>alert("Berhasil Tambah Data");window.location="buku.php"</script>';
            }
        } else {
            echo '<script>alert("hanya dapat upload file PNG/JPEG/JPG");window.location="update_buku.php?id=' . $id . '"</script>';
        }
    }
}

$id = $_GET['id'];
$query = 'SELECT * FROM buku WHERE Id_buku =?';
$select = $koneksi->prepare($query);
$select->execute(array($id));
$value = $select->fetch();

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Update Data Buku</h4>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Judul buku</label>
                    <input type="text" value="<?php echo $value['Judul'] ?>" class="form-control" name="judul" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label>Penulis</label>
                    <input type="text" value="<?php echo $value['Penulis'] ?>" class="form-control" name="penulis" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" value="<?php echo $value['Penerbit'] ?>" class="form-control" name="penerbit" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label class="mb-1">Cover Lama</label>
                    <br>
                    <?php if ($value['Cover_buku'] != "") { ?>
                        <img src="uploads/<?php echo $value['Cover_buku']; ?>" width="40%" height="40%" alt="" srcset="">
                    <?php } ?>
                    <br>
                    <label class="mt-2">Cover baru</label>
                    <input class="form-control" type="file" id="cover" name="cover" required>
                </div>
                <div class=" form-group">
                    <label>Tahun terbit</label>
                    <select class="form-control" name="tahun" id="" required>
                        <?php for ($i = 1990; $i <= 2025; $i++) { ?>
                            <option value="<?php echo $i; ?>" <?php if ($value['Tahun_terbit'] == $i) {
                                                                    echo "selected";
                                                                } ?>>
                                <?php echo $i; ?></option>
                        <?php }; ?>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?php echo $value['Id_buku']; ?>">
                <button type="submit" name="submit" class="btn btn-success" name="Insert"><i class="fa fa-plus"> </i> Insert</button>
            </form>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>