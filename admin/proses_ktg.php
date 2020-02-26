<?php

include "../fungsi/koneksi.php";

if (isset($_POST['simpan'])) {

    $id_jenis = $_POST['id_jenis'];
    $jenis_brg = $_POST['jenis_brg'];

    //die($stok);

    $query = "INSERT into jenis_barang (id_jenis, jenis_brg) VALUES 
										('$id_jenis', '$jenis_brg');

			";
    $hasil = mysqli_query($koneksi, $query);
    if ($hasil) {
        header("location:index.php?p=stokbarang");
    } else {
        die("ada kesalahan : " . mysqli_error($koneksi));
    }
}
