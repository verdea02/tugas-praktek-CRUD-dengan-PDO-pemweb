<?php
include "header.php";
include "koneksi.php";

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Buku</h6>
        </div>
        <div class="card-body">
            <div class="d-flex mb-1 justify-content-between">
                <div>
                    <a href="insert_buku.php" class="btn btn-success"><span class="fa fa-plus"></span></a>
                </div>
                <div class="d-flex flex-row">
                    <div>
                        <form class="d-flex" action="" method="POST">
                            <input class="form-control me-2" type="text" placeholder="title/writer/publisher/release" name="key">
                            <button class="btn btn-primary mx-1" type="submit" name="submit"><span class="fa fa-search"></span></button>
                        </form>
                    </div>
                    <div>
                        <a href="buku.php" class="btn btn-danger"><span class="fa fa-times"></span></a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>judul buku</th>
                            <th>cover buku</th>
                            <th>penulis</th>
                            <th>penerbit</th>
                            <th>tahun terbit</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($_POST['submit'])) {
                            $key = '%' . $_POST['key'] . '%';

                            $query = 'SELECT * FROM buku WHERE Judul LIKE :title OR Penulis LIKE :writer OR Penerbit LIKE :publisher OR Tahun_terbit LIKE :release';
                            $search = $koneksi->prepare($query);
                            $search->bindParam(':title', $key);
                            $search->bindParam(':writer', $key);
                            $search->bindParam(':publisher', $key);
                            $search->bindParam(':release', $key);
                            $search->execute();
                            foreach ($search as $value) {
                                $no = 1;
                        ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $value['Judul'] ?></td>
                                    <td class="text-center" width="20%"><img src="uploads/<?php echo $value['Cover_buku'] ?>" height="50%" width="50%" alt="" srcset=""></td>
                                    <td><?php echo $value['Penulis'] ?></td>
                                    <td><?php echo $value['Penerbit'] ?></td>
                                    <td><?php echo $value['Tahun_terbit'] ?></td>
                                    <td class="text-center">
                                        <a href="update_buku.php?id=<?php echo $value['Id_buku']; ?>" class="btn btn-warning">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                        <a onclick="return confirm('Apakah yakin data akan di hapus?')" href="delete_buku.php?id=<?php echo $value['Id_buku']; ?>" class="btn btn-danger">
                                            <span class="fa fa-trash"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php };
                        } else {
                            $query = $koneksi->prepare("SELECT * FROM buku");
                            $query->execute();
                            $data = $query->fetchAll();
                            foreach ($data as $value) {
                                $no = 1;
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $value['Judul'] ?></td>
                                    <td class="text-center" width="20%"><img src="uploads/<?php echo $value['Cover_buku'] ?>" height="50%" width="50%" alt="" srcset=""></td>
                                    <td><?php echo $value['Penulis'] ?></td>
                                    <td><?php echo $value['Penerbit'] ?></td>
                                    <td><?php echo $value['Tahun_terbit'] ?></td>
                                    <td class="text-center">
                                        <a href="update_buku.php?id=<?php echo $value['Id_buku']; ?>" class="btn btn-warning">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                        <a onclick=" confirm('Apakah yakin data akan di hapus?')" href="delete_buku.php?id=<?php echo $value['Id_buku']; ?>" class="btn btn-danger">
                                            <span class="fa fa-trash"></span>
                                        </a>
                                    </td>
                                </tr>
                        <?php };
                        }; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php include "footer.php"; ?>