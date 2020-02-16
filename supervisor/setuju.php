<?php  
	include "../fungsi/koneksi.php";
	

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$tanggal = date('Y-m-d');
		
		$query = mysqli_query($koneksi, "SELECT a.id_permintaan, c.nama , c.idjabatan FROM permintaan a INNER JOIN divisi b ON a.unit=b.divisi INNER JOIN user c on b.iddivisi = c.iddivisi  WHERE a.id_permintaan =$id and c.idjabatan = '2'");
		if (mysqli_num_rows($query)) {
			$row2=mysqli_fetch_assoc($query);
        }		
		$name = $row2['nama'];
		$idjabatan = $row2['idjabatan'];
		
		$query2 = mysqli_query($koneksi, "UPDATE permintaan SET nama = '$name' , idjabatan= '$idjabatan' ,status='1' WHERE id_permintaan='$id' ");		

		if($query2) {
			header("location:index.php?p=datapesanan");
		} else {
			echo "ada yang salah" . mysqli_error($koneksi);
		}
	}

?>