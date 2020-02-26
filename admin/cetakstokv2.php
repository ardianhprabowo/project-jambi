<?php
session_start();
include "../fungsi/koneksi.php";
include "../fungsi/fungsi.php";
if (isset($_GET['tgl'])) {
    $tgl = $_GET['tgl'];
    $query = mysqli_query($koneksi, "SELECT  permintaan.id_permintaan, permintaan.kode_brg, nama_brg, jumlah, satuan,permintaan.keterangan, status FROM permintaan INNER JOIN 
        stokbarang ON permintaan.kode_brg = stokbarang.kode_brg  WHERE tgl_permintaan='$tgl' AND unit='$_SESSION[divisi]' ");
}
$id  = isset($_GET['id']) ? $_GET['id'] : false;


$unit = $_GET['unit'];
$tgl = $_GET['tgl'];

$bln = array(
    '01' => 'JANUARI',
    '02' => 'FEBRUARI',
    '03' => 'MARET',
    '04' => 'APRIL',
    '05' => 'MEI',
    '06' => 'JUNI',
    '07' => 'JULI',
    '08' => 'AGUSTUS',
    '09' => 'SEPTEMBER',
    '10' => 'OKTOBER',
    '11' => 'NOVEMBER',
    '12' => 'DESEMBER',
);
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aplikasi Inventory Aset | E-Factory</title>
    <link rel="shortcut icon" type="image/icon" href="../assets/dist/img/jr.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/fa/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<style>
    <?php include '../assets/dist/css/adminlte.min.css'; ?>
</style>
<style type="text/css">
    div.kanan {
        position: absolute;
        bottom: 100px;
        right: 50px;

    }

    div.tengah {
        position: absolute;
        bottom: 100px;
        right: 330px;

    }

    div.kiri {
        position: absolute;
        bottom: 100px;
        left: 10px;
    }
</style>
<section class="invoice">
    <table>
        <?php
        include "../fungsi/koneksi.php";
        $id = isset($_GET['idjenis']) ? $_GET['idjenis'] : "";
        switch ($id) {
            case 1:
                $material = "ATK";
                break;
            case 2:
                $material = "TINTA";
                break;
            case 3:
                $material = "LAINNYA";
                break;
            default:
                $material = "";
        }

        ?>
        <thead>
            <tr>
                <th rowspan="3"><img src="../gambar/logojr.png" style="width:50px;height:50px" /></th>
                <td align="left" style="width: 520px;">
                    <font style="font-size: 18px"><b> PT JASA RAHARJA (PERSERO) <br> Cabang Jambi</b></font>
            </tr>
        </thead>
    </table>
    <hr>
    <!-- /.row -->
    <p align="center" style="font-weight: bold; font-size: 18px;"><u>LAPORAN DATA STOK BARANG</u></p>
    <!-- Table row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td style="text-align: center; "><b>No.</b></td>
                        <td style="text-align: center; "><b>Kode Barang</b></td>
                        <td style="text-align: center; "><b>Nama Barang</b></td>
                        <td style="text-align: center; "><b>Satuan</b></td>
                        <td style="text-align: center; "><b>Stok Awal</b></td>
                        <td style="text-align: center; "><b>Keluar</b></td>
                        <td style="text-align: center; "><b>Sisa</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($id)) {
                        $sql = mysqli_query($koneksi, "SELECT * FROM stokbarang WHERE id_jenis='$id' ");
                    } else {
                        $sql = mysqli_query($koneksi, "SELECT * FROM stokbarang");
                    }
                    $i   = 1;
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                        <tr>
                            <td style="text-align: center; width=15px;"><?php echo $i; ?></td>
                            <td style="text-align: center; width=80px;"><?php echo $data['kode_brg']; ?></td>
                            <td style="text-align: center; width=120px;"><?php echo $data['nama_brg']; ?></td>
                            <td style="text-align: center; width=70px;"><?php echo $data['satuan']; ?></td>
                            <td style="text-align: center; width=70px;"><?php echo $data['stok']; ?></td>
                            <td style="text-align: center; width=70px;"><?php echo $data['keluar']; ?></td>
                            <td style="text-align: center; width=70px;"><?php echo $data['sisa']; ?></td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.col -->
    </div>
    <p align='right'>Jambi, <?php echo date('d') . ' ' . (strtolower($bln[date('m')])) . ' ' . date('Y') ?></p>
    <?php

    $query2 = mysqli_query($koneksi, "SELECT permintaan.nama, unit FROM permintaan INNER JOIN stokbarang ON permintaan.kode_brg = stokbarang.kode_brg  WHERE unit='$_SESSION[divisi]'  AND  status='4' AND tgl_permintaan='$tgl'");
    if ($query2) {
        $data2 = mysqli_fetch_assoc($query2);
    } else {
        echo 'gagal';
    }
    ?>

    <div class="row">
        <div class="col-sm-4">
            <p align='center'>Mengetahui :<br>KA UNIT HC & UMUM</p>
            <br>
            <br>
            <b>
                <p align='center'><u>M. SYAFAAT, S.T</u><br>NIK : 197810170371</p>
            </b>
        </div>
        <div class="col-sm-4">
            <p align='center'></p>
            <br>
            <br>
            <b>
                <p align='center'></p>
            </b>
        </div>
        <div class="col-sm-4">
            <p align='center'>Mengetahui :<br>Asisten Manajer Gudang</p>
            <br>
            <br>
            <b>
                <p align='center'><u>Irwan Saputra, A.MD</u><br>NIK : 19808300482</p>
            </b>
        </div>
    </div>
</section>
<script type="text/javascript">
    window.addEventListener("load", window.print());
</script>