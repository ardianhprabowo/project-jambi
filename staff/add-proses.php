<?php  

	include "../fungsi/koneksi.php";

	if(isset($_POST['simpan'])) {

		$unit = $_POST['unit'];
		$kode_brg = $_POST['kode_brg'];
		$jumlah = $_POST['jumlah'];		
		$tgl_pemesanan = date('Y-m-d');
		$id_jenis = $_POST['id_jenis'];
		$keterangan = $_POST['keterangan'];
		

		$query = "INSERT into sementara (unit, kode_brg, id_jenis,  jumlah, tgl_permintaan, keterangan ) VALUES 
										('$unit', '$kode_brg', '$id_jenis', '$jumlah', '$tgl_pemesanan', '$keterangan')

			";
		$hasil = mysqli_query($koneksi, $query);
		if ($hasil) {
			header("location:index.php?p=formpesan");
		} else {
			die("ada kesalahan : " . mysqli_error($koneksi));
		}
	}
?>