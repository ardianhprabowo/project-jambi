<?php
session_start();
include "fungsi/koneksi.php";
include "fungsi/ceklogin.php";

if (isset($_COOKIE['cookielogin'])) {
  //cek cookie login dengan password dan username yang valid
  //$user = $_COOKIE['cookielogin']['username'];
  //print_r($user);
  if (($_COOKIE['cookielogin']['username'] == $username) && ($_COOKIE['cookielogin']['password'] == $password)) {
    print_r($_COOKIE);
    //jika valid set status login 1
    $_SESSION['login'] = true;
    //redirect ke halaman member area
    if ($_SESSION['level'] == "staff") {
      header("location:staff/index.php");
    } else if ($_SESSION['level'] == "administrator") {
      header("location:admin/index.php");
    } else if ($_SESSION['level'] == "supervisor") {
      header("location:supervisor/index.php");
    } else {
      header("location:index.php");
    }
  }
}

$err = "";

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $level = $_POST['level'];
  $time = time();
  $check = isset($_POST['setcookie']) ? $_POST['setcookie'] : '';

  $query = "SELECT a.*, b.divisi FROM user a join divisi b on a.iddivisi = b.iddivisi WHERE a.username='$username' && a.password='$password'";
  $hasil = mysqli_query($koneksi, $query);

  if (!$hasil) {
    echo "ada error";
  }

  if (mysqli_num_rows($hasil) == 0) {
    $err = "
		<div class='row' style='margin-top: 15px';>
	       <div class='col-md-12'>
	        	<div class='box box-solid bg-red'>
	        		<div class='box-header'>
	        			<h3 class='box-title'>Login Gagal!</h3>
	        		</div>
	        		<div class='box-body'>
	        			<p>Username atau password yang anda masukan salah.</p>
	        		</div>
			    </div>
			 </div>
		 </div>
	</div>";
  } else {
    $row = mysqli_fetch_array($hasil);
    $_SESSION['username'] = $row['username'];
    $_SESSION['nama'] = $row['nama'];
    $_SESSION['idjabatan'] = $row['idjabatan'];
    $_SESSION['divisi'] = $row['divisi'];
    $_SESSION['level'] = $row['level'];

    if ($row['level'] == "staff") {
      $_SESSION['login'] = true;
      if ($check) {
        setcookie("cookielogin[username]", $username, $time + 3600);
        setcookie("cookielogin[password]", $password, $time + 3600);
      }
      header("location:staff/index.php");
      exit();
    } else if ($row['level'] == "supervisor") {
      $_SESSION['login'] = true;
      header("location:supervisor/index.php");
      exit();
    } else if ($row['level'] == "administrator") {
      $_SESSION['login'] = true;
      header("location:admin/index.php");
      exit();
    } else {
      $err = "
		<div class='row' style='margin-top: 15px';>
	       <div class='col-md-12'>
	        	<div class='box box-solid bg-red'>
	        		<div class='box-header'>
	        			<h3 class='box-title'>Login Gagal!</h3>
	        		</div>
	        		<div class='box-body'>
	        			<p>Anda salah memilih level login.</p>
	        		</div>
			    </div>
			 </div>
		 </div>
    </div>";
      exit();
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Geger Anggon">
  <meta name="keyword" content="">

  <title>Aplikasi Inventory Aset | E-Factory</title>

  <!-- Theme icon -->
  <link rel="shortcut icon" type="image/icon" href="../assets/dist/img/jr.png">

  <!-- Theme Css -->
 <!-- Font Awesome -->
 <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
   <div class="card">
    <div class="card-body login-card-body">
      <h3 class="login-box-msg">Aplikasi Inventory Aset</h3>
      <h3 class="login-box-msg">E-Factory</h3>
      <center><img src="gambar/logo.png" style="width: 120px; height: 100px;"></center>
      <form method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name ="username" required >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" value="Login" name="login" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <?= $err; ?>
    <script src="assets/plugins/jQuery/jquery.min.js" type="text/javascript"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>