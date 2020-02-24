<?php ob_start();
include "../fungsi/fungsi.php";
?>
<!-- Setting CSS bagian header/ kop -->
<style type="text/css">
    table.page_header {
        width: 1020px;
        border: none;
        background-color: #3C8DBC;
        color: #fff;
        border-bottom: solid 1mm #AAAADD;
        padding: 2mm
    }

    table.page_footer {
        width: 1020px;
        border: none;
        background-color: #3C8DBC;
        border-top: solid 1mm #AAAADD;
        padding: 2mm
    }

    h1 {
        color: #000033
    }

    h2 {
        color: #000055
    }

    h3 {
        color: #000077
    }
</style>
<!-- Setting Margin header/ kop -->
<!-- Setting CSS Tabel data yang akan ditampilkan -->
<style type="text/css">
    .tabel2 {
        border-collapse: collapse;
        margin-left: 20px;
        caption-side: top;
    }

    .tabel2 th,
    .tabel2 td {
        padding: 5px 5px;
        border: 1px solid #959595;
        border-left: #fff;
        border-right: #fff;
        border-top: 1px black solid;
        border-bottom: 1px black solid;
    }

    div.kanan {
        width: 300px;
        float: right;
        margin-left: 250px;
        margin-top: -140px;
    }

    div.kiri {
        width: 300px;
        float: left;
        margin-left: 20px;
        display: inline;
    }
</style>
<table>
    <tr>
        <th rowspan="3"><img src="../gambar/logo.png" style="width:100px;height:100px" /></th>
        <td style="width: 520px;">
            <font style="font-size: 18px"><b>JASA RAHARJA<br> CABANG JAMBI</b></font>
            <br><br>Jl.Alamat <br> Telp : | Fax :
        </td>
    </tr>
</table>
<hr>
<table>
    <tr>
        <td style="width: 300px">Dari : <b>Teknik dan Humas</b></td>
        <td style="width: 200px">No Dokumen : .....</td>
        <td>Tanggal Terbit : <?php
                                $bulan = array(
                                    '01' => 'JANUARI',
                                    '02' => 'FEBRUARI',
                                    '03' => 'MARET',
                                    '04' => 'APRIL',
                                    '05' => 'MEI',
                                    '06' => 'JUNI',
                                    '07' => 'JULI',
                                    '08' => 'AGUSTUS',
                                    '09' => 'SEPTEMBER',
                                    '10' => 'OKTOBER',
                                    '11' => 'NOVEMBER',
                                    '12' => 'DESEMBER',
                                );
                                echo date('d') . ' ' . (strtolower($bulan[date('m')])) . ' ' . date('Y')  ?></td>
    </tr>
    <tr>
        <td>Kepada : <b>Unit SDM & UMUM</b></td>
        <td>Revisi : .....</td>
    </tr>
</table>
<p align="center" style="font-weight: bold; font-size: 18px;"><u>BUKTI PERMINTAAN BARANG<br>BULAN : <?php echo ($bulan[date('m')]) ?></u></p>
<u>Mohon Dikirim : </u>
<p></p>
<table class="tabel2">
    <thead>
        <tr>
            <td style="text-align: center; "><b>No.</b></td>
            <td style="text-align: center; "><b>Jenis Barang</b></td>
            <td style="text-align: center; "><b>Satuan</b></td>
            <td style="text-align: center; "><b>Jumlah</b></td>
            <td style="text-align: center; "><b>Keterangan</b></td>
        </tr>
    </thead>
    <tbody>
        <?php
        include "../fungsi/koneksi.php";
        $query = mysqli_query($koneksi, "SELECT permintaan.kode_brg, nama_brg, satuan, jumlah, keterangan FROM permintaan INNER JOIN stokbarang ON permintaan.kode_brg = stokbarang.kode_brg  ");
        $i   = 1;
        while ($data = mysqli_fetch_array($query)) {
        ?>
            <tr align="center">
                <td style="text-align: center; width=15px;"><?php echo $i; ?></td>
                <td style="text-align: center; width=220px;"><?php echo $data['nama_brg']; ?></td>
                <td style="text-align: center; width=70px;"><?php echo $data['satuan']; ?></td>
                <td style="text-align: center; width=50px;"><?php echo $data['jumlah']; ?></td>
                <td style="text-align: center; width=250px;"><?php echo $data['keterangan']; ?></td>
            </tr>
        <?php
            $i++;
        }
        ?>
    </tbody>
</table>

<!-- <div class="kiri">
    <p>Mengetahui :<br>HC & UMUM</p>
    <br>
    <br>
    <br>
</div>

<div class="kanan">
    <p>Mengetahui :<br>KA UNIT </p>
    <br>
    <br>
    <br>
</div> -->

<table>
    <tr>
        <td style="width: 590px"></td>
        <td style="width: 400px">Jambi, <?php echo date('d') . ' ' . (strtolower($bulan[date('m')])) . ' ' . date('Y') ?></td>
    </tr>
</table>
<table>
    <tr>
        <td style="width: 200px; text-align: center">Mengetahui<br>Kepala Cabang</td>
        <td style="width: 300px; text-align: center">Mengetahui<br>Ka. Perw/Ka. Unit SDM & Umum</td>
        <td style="text-align: center">Yang Mengajukan<br>Kepala Unit Teknik dan Humas</td>
    </tr>
    <tr>
        <td style="height: 180px; text-align: center">
            <hr>
        </td>
        <td style="text-align: center"><u>Syafaat Rahman</u></td>
        <td style="text-align: center"><u>Budi Purwanto</u></td>
    </tr>
</table>

<!-- Memanggil fungsi bawaan HTML2PDF -->
<?php
$content = ob_get_clean();
include '../assets/html2pdf/html2pdf.class.php';
try {
    $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8', array(10, 10, 4, 10));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->Output('laporan_pengeluaran_barang.pdf');
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>