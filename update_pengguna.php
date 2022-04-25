<?php
include "header.php";
include "koneksi.php";

if (isset($_POST['submit'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $hak = $_POST['hak'];
    $id = $_POST['id'];

    $data[] = $user;
    $data[] = $pass;
    $data[] = $hak;
    $data[] = $id;

    $query = 'UPDATE pengguna SET Username=?, Password=?, Hak_akses=? WHERE Id_user=?';
    $update = $koneksi->prepare($query);
    $update->execute($data);

    echo '<script>alert("Berhasil Edit Data");window.location="pengguna.php"</script>';
}

$id = $_GET['id'];
$query = 'SELECT * FROM pengguna WHERE Id_user =?';
$select = $koneksi->prepare($query);
$select->execute(array($id));
$value = $select->fetch();
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Update Data Pengguna</h4>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" value="<?php echo $value['Username']; ?>" class="form-control" name="username" maxlength="25" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="Password" value="<?php echo $value['Password']; ?>" class="form-control" name="password" maxlength="8" required>
                </div>
                <div class="mb-3">
                    <label>Hak Akses</label>
                    <select class="form-control" name="hak" required>
                        <option value="admin" <?php if ($value['Hak_akses'] == "admin") : echo "selected";
                                                endif ?>>Admin</option>
                        <option value="anggota" <?php if ($value['Hak_akses'] == "anggota") : echo "selected";
                                                endif ?>>Anggota</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?php echo $value['Id_user']; ?>">
                <button type="submit" name="submit" class="btn btn-info" name="Insert"><i class="fa fa-plus"> </i> Update</button>
            </form>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>