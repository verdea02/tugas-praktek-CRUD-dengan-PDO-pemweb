<?php
include "header.php";
include "koneksi.php";

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Peminjaman</h6>
        </div>
        <div class="card-body">
            <div class="d-flex mb-1 justify-content-between">
                <div>
                    <a href="insert_peminjaman.php" class="btn btn-success"><span class="fa fa-plus"></span></a>
                </div>
                <div class="d-flex flex-row">
                    <div>
                        <form class="d-flex" action="" method="POST">
                            <input class="form-control me-2" type="text" placeholder="search by name/title" name="key">
                            <button class="btn btn-primary mx-1" type="submit" name="submit"><span class="fa fa-search"></span></button>
                        </form>
                    </div>
                    <div>
                        <a href="peminjaman.php" class="btn btn-danger"><span class="fa fa-times"></span></a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>nama peminjam</th>
                            <th>judul buku</th>
                            <th>waktu peminjaman</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($_POST['submit'])) {
                            $key = '%' . $_POST['key'] . '%';

                            $query = 'SELECT * FROM peminjaman WHERE nama_peminjam LIKE :name OR judul_buku LIKE :judul';
                            $search = $koneksi->prepare($query);
                            $search->bindParam(':name', $key);
                            $search->bindParam(':judul', $key);
                            $search->execute();
                            foreach ($search as $value) {
                                $no = 1;
                        ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $value['nama_peminjam'] ?></td>
                                    <td><?php echo $value['judul_buku'] ?></td>
                                    <td><?php echo $value['waktu_peminjaman'] ?></td>
                                    <td class="text-center">
                                        <a href="update_peminjaman.php?id=<?php echo $value['Id_peminjaman']; ?>" class="btn btn-warning">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                        <a onclick=" confirm('Apakah yakin data akan di hapus?')" href="delete_peminjaman.php?id=<?php echo $value['Id_peminjaman']; ?>" class="btn btn-danger">
                                            <span class="fa fa-trash"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php };
                        } else {
                            $query = $koneksi->prepare("SELECT * FROM peminjaman");
                            $query->execute();
                            $data = $query->fetchAll();
                            foreach ($data as $value) {
                                $no = 1;
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $value['nama_peminjam'] ?></td>
                                    <td><?php echo $value['judul_buku'] ?></td>
                                    <td><?php echo $value['waktu_peminjaman'] ?></td>
                                    <td class="text-center">
                                        <a href="update_peminjaman.php?id=<?php echo $value['Id_peminjaman']; ?>" class="btn btn-warning">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                        <a onclick="return confirm('Apakah yakin data akan di hapus?')" href="delete_peminjaman.php?id=<?php echo $value['Id_peminjaman']; ?>" class="btn btn-danger">
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