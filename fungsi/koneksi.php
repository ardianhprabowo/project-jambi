<?php  

$host = "localhost";
$username = "root";
$password = "ayub1420";
$database = "efactory_db";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
	echo "Koneksi gagal " . mysqli_connect_error();
}
