<?php
include "../fungsi/koneksi.php";
include "../fungsi/fungsi.php";

if (isset($_GET['aksi']) && isset($_GET['tgl'])) {
  //die($id = $_GET['id']);
  $tgl = $_GET['tgl'];
  echo $tgl;

  if ($_GET['aksi'] == 'detil') {
    header("location:?p=detil&tgl=$tgl");
  }
}
$query = mysqli_query($koneksi, "SELECT tgl_permintaan, count(kode_brg),status  FROM permintaan where status in ('0','1') GROUP BY tgl_permintaan  ");
if ($_SESSION['divisi'] == 'Teknik dan Humas'){
  $query2 = mysqli_query($koneksi, "SELECT COUNT(id_permintaan) as jml FROM (
    SELECT id_permintaan,unit, tgl_permintaan,COUNT(*) as jml
    FROM permintaan WHERE status = '0' and unit in ('Pelayanan','Teknik dan Humas') GROUP BY unit,tgl_permintaan) as totreq");
} else {
  $query2 = mysqli_query($koneksi, "SELECT COUNT(id_permintaan) as jml FROM (
    SELECT id_permintaan,unit, tgl_permintaan,COUNT(*) as jml
    FROM permintaan WHERE status = '0' and unit = '{$_SESSION['divisi']}' GROUP BY unit,tgl_permintaan) as totreq");
}
$data2 = mysqli_fetch_assoc($query2);

$query3 = mysqli_query($koneksi, "SELECT SUM(stok) as jmlbrg FROM stokbarang");
$data3 = mysqli_fetch_assoc($query3);

$query4 = mysqli_query($koneksi, "SELECT COUNT(id_user) as jmluser FROM user a JOIN jabatan b on a.idjabatan = b.idjabatan JOIN divisi c on a.iddivisi = c.iddivisi WHERE c.divisi='{$_SESSION['divisi']}' ORDER BY level DESC");
$data4 = mysqli_fetch_assoc($query4);

if ($_SESSION['divisi'] == 'Teknik dan Humas'){
  $query5 = mysqli_query($koneksi, "SELECT COUNT(id_permintaan) as jmlkeluar FROM (
    SELECT id_permintaan,unit, tgl_permintaan,COUNT(*) as jmlkeluar
    FROM permintaan WHERE status = '4' and unit in ('Pelayanan','Teknik dan Humas') GROUP BY unit,tgl_permintaan) as totreq");
} else {
  $query5 = mysqli_query($koneksi, "SELECT COUNT(id_permintaan) as jmlkeluar FROM (
    SELECT id_permintaan,unit, tgl_permintaan,COUNT(*) as jmlkeluar
    FROM permintaan WHERE status = '4' and unit = '{$_SESSION['divisi']}' GROUP BY unit,tgl_permintaan) as totreq");
}
$data5 = mysqli_fetch_assoc($query5);
?>

<section class="content-header">
  <h1 class="m-0 text-dark">
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $data2['jml']; ?></h3>

            <p>Permintaan Belum di Setujui</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="index.php?p=datapesanan" class="small-box-footer">Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?= $data5['jmlkeluar']; ?></h3>

            <p>Permintaan Selesai</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?= $data4['jmluser']; ?></h3>

            <p>User Terdaftar</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="index.php?p=user" class="small-box-footer">Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?= $data3['jmlbrg']; ?></h3>

            <p>Total Stok Barang</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="index.php?p=barang" class="small-box-footer">Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->

    <!-- TABLE: LATEST ORDERS -->
    <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Permintaan Terbaru</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table m-0">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal Permintaan</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Detail</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
                $no = 1;
                if (mysqli_num_rows($query)) {
                  while ($row = mysqli_fetch_assoc($query)) :
                ?>
                    <td> <?= $no; ?> </td>
                    <td> <?= tanggal_indo($row['tgl_permintaan']); ?> </td>
                    <td> <?= $row['count(kode_brg)']; ?> </td>
                    <td>
                      <?php if ($row['status'] == 0) : ?>
                        <span class="badge badge-warning">Menunggu Persetujuan</span>
                      <?php elseif ($row['status'] == 1) : ?>
                        <span class="badge badge-info">Di Setujui Oleh KA Unit, Menunggu Acc HC & Umum</span>
                      <?php elseif ($row['status'] == 2) : ?>
                        <span class="badge badge-success">Menunggu Pengeluaran Barang</span>
                      <?php elseif ($row['status'] == 3) : ?>
                        <span class="badge badge-danger">Data Permintaan Telah di Batalkan Oleh KA UNIT</span>
                      <?php else : ?>
                        <span class="badge badge-danger">Permintaan Selesai</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="?p=datapesanan&aksi=detil&tgl=<?= $row['tgl_permintaan']; ?>"><span data-placement='top' data-toggle='tooltip' title='Detail Permintaan'><button class="btn btn-info">Detail Permintaan</button></span></a>
                    </td>
              </tr>
          <?php $no++;
                  endwhile;
                } else {
                  echo "<tr><td colspan=9>Tidak ada permintaan Barang.</td></tr>";
                } ?>

            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <a href="index.php?p=datapesanan" class="btn btn-sm btn-secondary float-right">Semua Data</a>
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->

  </div>
  </div>