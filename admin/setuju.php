<?php  
	include "../fungsi/koneksi.php";
	if(isset($_GET['tgl']) && isset($_GET['unit']) && isset($_GET['unit'])) {
		$tanggal = date('Y-m-d');
		$unit  = $_GET['unit'];
    	$tgl = $_GET['tgl'];
		
		
		$query1 = mysqli_query($koneksi, "UPDATE permintaan SET status = '2' WHERE unit='$unit' and tgl_permintaan='$tgl' ");		

		
		if($query1) {
			header("location:index.php?p=datapesanan");
		} else {
			echo "ada yang salah" . mysqli_error($koneksi);
		}
		
	}

	

?>