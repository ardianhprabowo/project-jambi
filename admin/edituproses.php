<?php  

include "../fungsi/koneksi.php";

if(isset($_POST['update'])) {
	$id = $_POST['id'];
	
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$cabang = $_POST['cabang'];
	$kaunit = $_POST['kaunit'];	
	$iddivisi = $_POST['iddivisi'];
	$idjabatan = $_POST['idjabatan'];
	
	$level = $_POST['level'];	
	
	$query = mysqli_query($koneksi, "UPDATE user SET nama = '$nama', username='$username', cabang='$cabang', kaunit='$kaunit', iddivisi='$iddivisi', idjabatan='$idjabatan', level='$level' WHERE id_user ='$id' ");
	
	if ($query) {
		header("location:index.php?p=user");
	} else {
		echo 'error' . mysqli_error($koneksi);
	}

}



?>