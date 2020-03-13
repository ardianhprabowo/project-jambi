<?php

include "../fungsi/koneksi.php";
$query = mysqli_query($koneksi, "SELECT MAX(id_jenis) from jenis_barang");
$kode_brg = mysqli_fetch_array($query);
if ($kode_brg) {

    $nilaikode = substr($kode_brg[0], 2);

    $kode = (int) $nilaikode;

    //setiap kode ditambah 1
    $kode = $kode + 1;
    $kode_otomatis = "5" . str_pad($kode, 1, "0", STR_PAD_LEFT);
} else {
    $kode_otomatis = "5";
}

if (isset($_GET['id_jenis'])) {
    $id_jenis = $_GET['id_jenis'];
    $query = mysqli_query($koneksi, "SELECT * FROM stokbarang WHERE id_jenis='$id_jenis' ");
} else {
    $query = mysqli_query($koneksi, "SELECT * FROM stokbarang");
}

?>

<section class="content">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Tambah Kategori Barang</h3>
                </div>
                <form method="post" action="proses_ktg.php" class="form-horizontal">
                    <div class="form-group ">
                        <label for="nama_brg" class="col-sm-offset-1 col-sm-3 control-label">Kode Kategori</label>
                        <div class="col-sm-4">
                            <input type="text" value="<?= $kode_otomatis; ?>" class="form-control" name="id_jenis" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label id="tes" for="nama_brg" class="col-sm-offset-1 col-sm-3 control-label">Nama Kategori</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="jenis_brg">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="simpan" class="btn btn-primary col-sm-offset-4 " value="Simpan">
                        &nbsp;
                        <input type="reset" class="btn btn-danger" value="Batal">
                    </div>
            </div>
            </form>
            </div>
        </div>
    </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('.tanggal').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
    });
</script>