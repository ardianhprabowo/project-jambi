
<?php  
    include "../fungsi/koneksi.php";

    if (isset($_GET['id'])) {
        //die($id = $_GET['id']);
        $id = $_GET['id'];
        $tanggal = date('Y-m-d');

        if ($_GET['konfirmasi'] == 'edit') {
            header("location:?p=edit&id=$id");
        } else if ($_GET['aksi'] == 'hapus') {
            header("location:?p=hapus&id=$id");
        } 
    }
    $query2 = mysqli_query($koneksi, "SELECT * FROM permintaan WHERE id_permintaan='$id'");
		
	$row2 = mysqli_fetch_assoc($query2);

	$query3 = mysqli_query($koneksi, "INSERT INTO pengeluaran (unit, kode_brg, jumlah, tgl_keluar)
										VALUES ('$row2[unit]', '$row2[kode_brg]', '$row2[jumlah]', '$tanggal' ) ");
    
    $query1 = mysqli_query($koneksi, "UPDATE permintaan SET status = '3' WHERE id_permintaan='$id' ");	
    if($query3) {
        header("location:index.php?p=datapesanan");
    } else {
        echo "ada yang salah" . mysqli_error($koneksi);
    }
?>
