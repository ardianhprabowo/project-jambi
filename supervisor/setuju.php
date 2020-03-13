<?php  
	include "../fungsi/koneksi.php";
	

	if(isset($_GET['tgl']) && isset($_GET['unit'])) {
		$tanggal = date('Y-m-d');
		$unit  = $_GET['unit'];
    	$tgl = $_GET['tgl'];
		
		$query = mysqli_query($koneksi, "SELECT a.*, c.nama , c.idjabatan FROM permintaan a INNER JOIN divisi b ON a.unit=b.divisi INNER JOIN user c on b.iddivisi = c.iddivisi  WHERE a.unit='$unit' and a.tgl_permintaan='$tgl' and c.idjabatan = '2'");
		if (mysqli_num_rows($query)) {
			$row2=mysqli_fetch_assoc($query);
        }		
		$name = $row2['nama'];
		$idjabatan = $row2['idjabatan'];
		
		$query2 = mysqli_query($koneksi, "UPDATE permintaan SET nama = '$name' , idjabatan= '$idjabatan' ,status='1' WHERE unit='$unit' and tgl_permintaan='$tgl' ");		

		if($query2) {
			header("location:index.php?p=datapesanan");
		} else {
			echo "ada yang salah" . mysqli_error($koneksi);
		}
	}

?>