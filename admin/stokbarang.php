<?php
include "../fungsi/koneksi.php";
include "../fungsi/fungsi.php";

if (isset($_GET['aksi']) && isset($_GET['id'])) {
    //die($id = $_GET['id']);
    $id = $_GET['id'];
    echo $id;

    if ($_GET['aksi'] == 'edit') {
        header("location:?p=edit&id=$id");
    } else if ($_GET['aksi'] == 'hapus') {
        header("location:?p=hapus&id=$id");
    }
}

if (isset($_GET['id_jenis'])) {
    $id_jenis = $_GET['id_jenis'];
    $query = mysqli_query($koneksi, "SELECT * FROM stokbarang WHERE id_jenis='$id_jenis' ");
} else {
    $query = mysqli_query($koneksi, "SELECT * FROM stokbarang");
}



?>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Olah Data Stok Barang </h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <a href="index.php?p=tambahbarang" class=" btn btn-primary"><i class="fa fa-plus"></i> Tambah Data Stok</a><br>
                        </div>

                        <div class="col-sm-2 pull-right">
                            <a target="_blank" href="cetakstok.php?idjenis=<?= $id_jenis;  ?>" class="btn btn-success"><i class="fa fa-print"></i> Cetak Data Stok</a><br>
                        </div>
                        <div class="col-sm-4">
                            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
                                <div class="form-group">
                                    <select class="form-control" name="jenis_barang">
                                        <?php
                                        //Perintah sql untuk menampilkan semua data pada tabel barang
                                        $sql = "SELECT * FROM jenis_barang ";
                                        $hasil = mysqli_query($koneksi, $sql);
                                        $no = 0;
                                        while ($data = mysqli_fetch_array($hasil)) {
                                            $no++;

                                            $ket = "";
                                            if (isset($_GET['jenis_barang'])) {
                                                $barang = trim($_GET['jenis_barang']);

                                                if ($barang == $data['id_jenis']) {
                                                    $ket = "selected";
                                                }
                                            }
                                        ?>
                                            <option <?php echo $ket; ?> value="<?php echo $data['id_jenis']; ?>"><?php echo $data['jenis_brg']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-4">
                            <a href="index.php?p=stokbarang&id_jenis=<?= $row['id_jenis']; ?>" class="btn btn-info"><i class="fa fa-search"></i> Filter</a>
                        </div>
            <div class="table-responsive">
                <table class="table text-center" id="barang">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Masuk</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Stok Awal</th>
                            <th>Keluar</th>
                            <th>Sisa</th>

                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            if (mysqli_num_rows($query) == 0) echo ("Masukkan Data Dahulu..<tr><td colspan=9>Belum ada Barang</td></tr>");
                            else echo (""); {
                                while ($row = mysqli_fetch_assoc($query)) :

                            ?>
                                    <td> <?= $no; ?> </td>
                                    <td> <?= tanggal_indo($row['tgl_masuk']); ?> </td>
                                    <td> <?= $row['kode_brg']; ?> </td>
                                    <td> <?= $row['nama_brg']; ?> </td>
                                    <td> <?= $row['satuan']; ?> </td>
                                    <td> <?= $row['stok']; ?> </td>
                                    <td> <?= $row['keluar']; ?> </td>
                                    <td> <?= $row['sisa']; ?> </td>
                                    <td>
                                        <a href="?p=barang&aksi=edit&id=<?= $row['kode_brg']; ?>"><span data-placement='top' data-toggle='tooltip' title='Update'><button class="btn btn-info">Update</button></span></a>

                                        <a href="?p=barang&aksi=hapus&id=<?= $row['kode_brg']; ?>"><span data-placement='top' data-toggle='tooltip' title='Hapus'><button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus ?')">Hapus</button></span></a>
                                    </td>
                        </tr>
                <?php $no++;
                                endwhile;
                            } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
<script>
    $(function() {
        $("#barang").DataTable({
            "language": {
                "url": "../assets/plugins/Indonesia.json",
                "sEmptyTable": "Tidak ada data di database"
            }
        });
    });
</script>