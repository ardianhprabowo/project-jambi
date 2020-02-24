<?php  
    include "../fungsi/koneksi.php";
    include "../fungsi/fungsi.php";
    
    if (isset($_GET['tgl']) && isset($_GET['unit'])) {
        $tgl = $_GET['tgl'];
        $unit = $_GET['unit'];

        $query = mysqli_query($koneksi, "SELECT permintaan.tgl_permintaan, permintaan.id_permintaan, permintaan.kode_brg, nama_brg, jumlah, satuan, status FROM permintaan INNER JOIN 
        stokbarang ON permintaan.kode_brg = stokbarang.kode_brg  WHERE tgl_permintaan='$tgl' AND unit='$unit'");
               
    }

    if (isset($_GET['aksi'])) {
            if ($_GET['aksi'] == 'edit')
            header("location:?p=editpesan");        
    }
    
?>
<section class="content">
<!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-sm-12">
             <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Konfirmasi Permintaan Unit <?php echo $unit; ?></h3>
                </div>                
                <div class="box-body">                   
                    <a href="index.php?p=history" style="margin:10px;" class="btn btn-success"><i class='fa fa-backward'>  Kembali</i></a>
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead  > 
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>                                             
                                    <th>Nama Barang</th>
									<th>Satuan</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>                                                                       
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php 
                                        $no =1 ;
                                        if (mysqli_num_rows($query)) {
                                            while($row=mysqli_fetch_assoc($query)):

                                     ?>
                                        <td> <?= $no; ?> </td>                                      
                                        <td> <?= $row['kode_brg']; ?> </td>    
                                        <td> <?= $row['nama_brg']; ?> </td>
										<td> <?= $row['satuan']; ?> </td>										
                                        <td> <?= $row['jumlah']; ?> </td>                                                                                     
                                        <td > <?php
                                               if ($row['status'] == 0){
                                                echo '<span class=text-warning>Menunggu Persetujuan</span>';
                                            } elseif ($row['status'] == 1) {
                                                echo '<span class=text-primary>Telah Disetujui KA Unit</span>';
                                            } elseif ($row['status'] == 2) {
                                                echo '<span class=text-primary>Telah Disetujui HC & Umum</span>';
                                            } elseif ($row['status'] == 3) {
                                                echo '<span class=text-primary>Telah Dibatalkan</span>';
                                            }else {
                                                echo '<span class=text-danger>Permintaan Selesai di Proses</span>';
                                            }
                                               ?> 
                                         </td>  
                                        <td>         
                                        <?php if($row['status'] == 0): ?>
                                            <p> Data Permintaan belum di Setujui Oleh KA Unit </p>
                                        <?php elseif ($row['status'] == 1): ?>
                                            <p> Menunggu Persetujuan HC & Umum </p>
                                        <?php elseif ($row['status'] == 2): ?>
                                            <p> Menunggu Persetujuan Pengeluaran Barang </p>
                                         <?php elseif ($row['status'] == 3): ?>
                                         <p> Data Permintaan Telah di Batalkan Oleh KA UNIT</p>
                                        <?php else: ?>
                                        <p> Tidak Ada</p>
                                        <?php endif; ?>                                                                                                                                                                                
                                        </td>                                                         
                            </tr>
                            
                            <?php $no++; endwhile; }else {echo "<tr><td colspan=9>Tidak ada permintaan Barang.</td></tr>";} ?>
                            </tbody>
                        </table>
                    </div>                  
                </div>
            </div>
        </div>
    </div>
</section>