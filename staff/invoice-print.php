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
    <thead>
      <tr>
        <th rowspan="3"><img src="../gambar/logojr.png" style="width:50px;height:50px" /></th>
        <td align="left" style="width: 520px;">
          <font style="font-size: 18px"><b> PT JASA RAHARJA (PERSERO) <br> Cabang Jambi</b></font>
      </tr>
    </thead>
  </table>
  <hr>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      <p> Dari : <strong><?= $_SESSION['divisi']; ?></strong></p>
      <p> Kepada : <strong>Unit SDM & UMUM</strong></p>
    </div>
    <div class="col-sm-4 invoice-col">
      <p> No Dokumen : .....</p>
      <p> Revisi : .....</p>
    </div>
    <div class="col-sm-4 invoice-col">
      <p> Tanggal Terbit : <?php echo date('d') . ' ' . (strtolower($bln[date('m')])) . ' ' . date('Y') ?></p>
    </div>
  </div>
  <!-- /.row -->
  <p align="center" style="font-weight: bold; font-size: 18px;"><u>BUKTI PERMINTAAN BARANG </u></p>
  <p align="center" style="font-weight: bold; font-size: 18px;"><u>BULAN:<?php echo $bln[date('m')] . ' ' . date('Y') ?> </u></p>
  <p align="left"><u>Mohon dikirim : </u></p>
  <!-- Table row -->
  <div class="row">
    <div class="col-12 table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Jenis Barang</th>
            <th>Satuan</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php


            $query = mysqli_query($koneksi, "SELECT permintaan.kode_brg, unit, nama_brg, jumlah, satuan, tgl_permintaan,keterangan FROM permintaan INNER JOIN stokbarang ON permintaan.kode_brg = stokbarang.kode_brg  WHERE unit='$_SESSION[divisi]'  AND  status='4' AND tgl_permintaan='$tgl' ");
            $i   = 1;
            while ($data = mysqli_fetch_array($query)) {
            ?>
              <td> <?php echo $i; ?> </td>
              <td> <?php echo $data['nama_brg']; ?> </td>
              <td> <?php echo $data['satuan']; ?> </td>
              <td> <?php echo $data['jumlah']; ?> </td>
              <td> <?php echo $data['keterangan']; ?> </td>
          </tr> <?php
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

  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      <p align='center'>Mengetahui<br>Kepala Cabang</p>
      <br>
      <br>
      <b>
        <p align='center'><u>Eva Yuliasta</u></p>
      </b>
    </div>
    <div class="col-sm-4 invoice-col">
      <p align='center'>Mengetahui<br>Ka. Perw/Ka. Unit SDM & Umum</p>
      <br>
      <br>
      <b>
        <p align='center'><u>SYAFAAT RAHMAN</u></p>
      </b>
    </div>
    <div class="col-sm-4 invoice-col">
      <p align='center'>Yang Mengajukan<br>Kepala Unit <?= $data2['unit']; ?></p>
      <br>
      <br>
      <b>
        <p align='center'><u><?= $data2['nama']; ?></u></p>
      </b>
    </div>
  </div>
</section>
<script type="text/javascript">
  window.addEventListener("load", window.print());
</script>