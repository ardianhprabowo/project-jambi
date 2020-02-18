  <?php  

session_start();
ob_start();

include "../fungsi/koneksi.php";
$page = isset($_GET['p']) ? $_GET['p'] : false;
//include 'cekuser.php';
  $query = mysqli_query($koneksi, "SELECT COUNT(id_jenis) AS jumlah FROM jenis_barang ");
  $data = mysqli_fetch_assoc($query);
  if (! empty($_SESSION['login']) && ($_SESSION['level'] == "staff"))
{
  ?>
<!DOCTYPE html>
<html>
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
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="../assets/plugins/iCheck/flat/blue.css">  
  <link rel="stylesheet" href="../assets/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../assets/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  
  <script src="../assets/plugins/jQuery/jquery.min.js"></script>
  </head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Unit <?=  $_SESSION['divisi']; ?></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="index.php" class="brand-link">
  <img src="../assets/dist/img/jr.png" alt="JR Logo" class="brand-image img-circle elevation-3"
  style="opacity: .8">
  <span class="brand-text font-weight-light">JASA RAHARJA</span>
  </a>
  <div class="sidebar">
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../assets/dist/img/guest.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block"><?=  $_SESSION['nama']; ?></a>
        </div>
      </div>
      <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Stok Barang
                <span class="right badge badge-danger"><?= $data['jumlah']; ?></span>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?p=barang&id_jenis=1" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ATK</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?p=barang&id_jenis=2" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>KERTAS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?p=barang&id_jenis=3" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>TINTA</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?p=barang&id_jenis=4" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>LAINNYA</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="index.php?p=datapesanan" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                 Data Permintaan
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?p=cetakpesanan" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                 Cetak BPP
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                 Logout
              </p>
            </a>
          </li>
</ul>
</nav>
</div>
</aside>
  <div class="content-wrapper">    
    <?php 

          include "page.php"; 
    ?>   
   
  </div>
 
  <footer class="main-footer"> 
	<marquee hspace="40" width="full-width">Setelah permintaan di konfirmasi oleh Kepala Unit, Unit Bersangkutan</marquee>
    <strong>Copyright &copy; Geger Anggon - 2020 </strong>
  </footer>

<!-- jQuery UI 1.11.4 -->
<script src="../assets/plugins/jQueryUI/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->

<script src="../assets/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../assets/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<!-- datepicker -->
<script src="../assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js"></script>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="../assets/dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../assets/plugins/raphael/raphael.min.js"></script>
<script src="../assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../assets/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="../assets/dist/js/pages/dashboard2.js"></script>
</body>
</html>
<?php
}
else
{
    echo 'Anda Belum Melakukan Login. <a href="../index.php">Klik Disini</a> Untuk log in.';
}