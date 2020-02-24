<?php 
  
  include "../fungsi/koneksi.php";
  include "../fungsi/fungsi.php";
  session_start();
  ob_start();
    
?>
<!-- Setting CSS bagian header/ kop -->
<style type="text/css">
  table.page_header {width: 1020px; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
  table.page_footer {width: 1020px; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}
  
 
</style>
<!-- Setting Margin header/ kop -->
  <!-- Setting CSS Tabel data yang akan ditampilkan -->
  <style type="text/css">
  .tabel2 {
    border-collapse: collapse;
    margin-left: 145px;
    
  }
  .tabel2 th, .tabel2 td {
      padding: 5px 5px;
      border: 1px solid #000;

  }

   table.isi {
    margin: 0 170px;

  }

  .isi td {
    padding: 15px 15px;
  }

  div.kanan {
     position: absolute;
     bottom: 100px;
     right: 50px;
     
  }

  div.tengah {
     position: absolute;
     bottom: 100px;
     right: 330px;
     
  }

  div.kiri {
     position: absolute;
     bottom: 100px;
     left: 10px;     
  }

  </style>
  <table>
    <tr>
      <th rowspan="3"><img src="../gambar/logopemkot.png" style="width:100px;height:100px" /></th>
      <td align="center" style="width: 520px;"><font style="font-size: 18px"><b>PT.JASA RAHARJA (Persero) <br> Cabang Jambi</b></font>
      <br><br>Jl. Rambutan Ujung No. 1, Kecamatan Ilir Barat II, Palembang, Sumatera Selatan <br> Telp : (0711) 355089 | Fax : (0711) 355180</td>
	  <th rowspan="3"><img src="../gambar/logopdam.png" style="width:100px;height:80px" /></th>
    </tr>
  </table>
  <hr>
  <p align="center" style="font-weight: bold; font-size: 18px;"><u>BUKTI PERMINTAAN BARANG</u></p>
  <br><br>
  <h4 style="color: black; text-align: center;">Pengeluaran Permintaan Barang dari Unit Pelayanan : <?= $unit; ?></h4>
  <div class="isi" style="margin: 0 auto;">
   <table class="tabel2">
    <thead>
      <tr>
        <td style="text-align: center; "><b>No.</b></td>        
        <td style="text-align: center; "><b>Kode Barang</b></td>
        <td style="text-align: center; "><b>Nama Barang</b></td>
		<td style="text-align: center; "><b>Satuan</b></td> 
        <td style="text-align: center; "><b>Jumlah</b></td>                                        
      </tr>
    </thead>
    <tbody>
      <?php

       
       $query = mysqli_query($koneksi, "SELECT permintaan.keterangan, permintaan.kode_brg, unit, nama_brg, jumlah, satuan, tgl_permintaan FROM permintaan INNER JOIN stokbarang ON permintaan.kode_brg = stokbarang.kode_brg  WHERE unit= 'Teknik dan Humas' AND  status=4 AND tgl_permintaan='2020-02-12' "); 
      $i   = 1;
      while($data=mysqli_fetch_array($query))
      {
      ?>
      <tr>
        <td style="text-align: center;"><?php echo $i; ?></td>             
        <td style="text-align: center;"><?php echo $data['kode_brg']; ?></td>
        <td style="text-align: center;"><?php echo $data['nama_brg']; ?></td>
		<td style="text-align: center;"><?php echo $data['satuan']; ?></td>  
        <td style="text-align: center;"><?php echo $data['jumlah']; ?></td>                            
      </tr>
    <?php
    $i++;
    }
    ?>
    </tbody>
  </table>
  <?php 

  $query2 = mysqli_query($koneksi, "SELECT permintaan.keterangan FROM permintaan WHERE unit= 'Teknik dan Humas' AND  status=4 AND tgl_permintaan='2020-02-12' ");  
  $data2 = mysqli_fetch_assoc($query2);

  ?>

  <p>Pada hari ini tanggal : <b> <?=  tanggal_indo($tgl); ?></b> telah dikeluarkan serta serah terima barang berupa seperti yang tersebut di atas.</p>
  <p>Tukang yang mengambil barang ke Gudang : <?php echo $data2['keterangan']; ?></p>
  </div>
 
  
<!-- Memanggil fungsi bawaan HTML2PDF -->
<?php
$filename="mhxxs-".$tgl.".pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
//Copy dan paste langsung script dibawah ini,untuk mengetahui lebih jelas tentang fungsinya silahkan baca-baca tutorial tentang HTML2PDF
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.nl2br($content).'</page>';
include '../assets/html2pdf/html2pdf.class.php';
 try
 {
  $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(30, 0, 20, 0));
  $html2pdf->setDefaultFont('Arial');
  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
  $html2pdf->Output($filename);
 }
 catch(HTML2PDF_exception $e) { echo $e;exit; }
?>