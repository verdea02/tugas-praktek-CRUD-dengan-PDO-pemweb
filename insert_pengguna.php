<?php
include "header.php";
include "koneksi.php";

if (isset($_POST['submit'])) {
    $name = $_POST['username'];
    $pass = $_POST['password'];
    $hak = $_POST['hak'];

    $data[] = $name;
    $data[] = $pass;
    $data[] = $hak;

    $query = 'INSERT INTO pengguna (Username, Password, Hak_akses) VALUE (?,?,?)';
    $insert = $koneksi->prepare($query);
    $insert->execute($data);

    echo '<script>alert("Berhasil Tambah Data");window.location="pengguna.php"</script>';
}

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Insert Data Pengguna</h4>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" value="" class="form-control" name="username" maxlength="25" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="Password" value="" class="form-control" name="password" maxlength="8" required>
                </div>
                <div class="mb-3">
                    <label>Hak Akses</label>
                    <select class="form-control" name="hak" required>
                        <option value="admin">Admin</option>
                        <option value="anggota">Anggota</option>
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