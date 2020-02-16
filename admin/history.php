<?php  
    include "../fungsi/koneksi.php";
    include "../fungsi/fungsi.php";
    $query = mysqli_query($koneksi, "SELECT distinct(unit), tgl_permintaan, status FROM permintaan");    
?>
<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-sm-12">
             <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">History Permintaan Barang</h3>
                </div>                
				
                <div class="box-body"> 
                    <div class="table-responsive">
                        <table id="datapesanan" class="table text-center">
                            <thead  > 
                                <tr>
                                    <th>No</th> 
									<th>Tanggal Permintaan</th>
                                    <th>Divisi</th>
                                    <th width="20%" class="text-center">Permintaan Details</th>
                                    <th>Status</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php 
                                        $no =1 ;
                                        if (mysqli_num_rows($query)) {
                                            while($row2=mysqli_fetch_assoc($query)):

                                     ?>
                                        <td> <?= $no; ?> </td>       
										<td> <?= tanggal_indo($row2['tgl_permintaan']); ?> </td> 					
                                        <td> <?= $row2['unit']; ?> </td>   
                                        <td ><a href="?p=detilhistory&unit=<?= $row2['unit'];?>&tgl=<?= $row2['tgl_permintaan']; ?>"><span data-placement='top' data-toggle='tooltip' title='Detail Permintaan'><button    class="btn btn-info">Detail Permintaan</button></span></a>  </td>                                  
                                        <td> <?php
                                                if ($row2['status'] == 0){
                                                    echo '<span class=text-warning>Menunggu Persetujuan</span>';
                                                } elseif ($row2['status'] == 1) {
                                                    echo '<span class=text-primary>Telah Disetujui KA Unit</span>';
                                                } elseif ($row2['status'] == 2) {
                                                    echo '<span class=text-primary>Telah Disetujui HC & Umum</span>';
                                                } elseif ($row2['status'] == 3) {
                                                    echo '<span class=text-primary>Telah Dibatalkan</span>';
                                                }else {
                                                    echo '<span class=text-danger>Permintaan Selesai di Proses</span>';
                                                }
                                               ?> 
										</td>                                                                                            
                            </tr>
                            <?php $no++; endwhile; }else {echo "<tr><td colspan=9>Tidak ada permintaan barang.</td></tr>";} ?>
                            </tbody>
                        </table>
                    </div>                  
                </div>
            </div>
        </div>
    </div>
</section>