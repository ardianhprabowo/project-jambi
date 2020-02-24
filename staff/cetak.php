<html>

<head>
  <title>Report HTML2PDF</title>
</head>

<body>
  <?php
  include "../fungsi/koneksi.php";
  include "../fungsi/fungsi.php";
  $no = 0;
  $query = "select * from permintaan";
  //untuk menjalankan perinta sql
  $result = mysqli_query($koneksi, $query);
  //untuk mendapatkan jumlah bari dari table
  $num_results = $result->num_rows;
  //cek jika data tidak 0
  if ($num_results > 0) {
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>NIS</th>";
    echo "<th>NAMA</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
      $no++;
      //untuk mengektrak data
      extract($row);
      echo "<tr>";
      echo "<td>{$tgl_permintaan}</td>";
      echo "<td>{$nama}</td>";
      echo "</tr>";
    }
    echo "</table>";
  } else {
    //jika data kosong maka akan menampilkan data berikutnya
    echo "Data Kosong";
  }
  //menutup koneksi ke database
  mysqli_free_result($result);

  mysqli_close($koneksi);
  ?>
</body>

</html>