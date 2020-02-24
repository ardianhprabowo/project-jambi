<?php  
    include "../fungsi/koneksi.php";
    include "../fungsi/fungsi.php";

	if (isset($_GET['aksi']) && isset($_GET['tgl'])) {
		//die($id = $_GET['id']);
		$tgl = $_GET['tgl'];
		echo $tgl;

		if ($_GET['aksi'] == 'detil') {
			header("location:?p=detil&tgl=$tgl");
		} 
	}	
	$query = mysqli_query($koneksi, "SELECT tgl_permintaan, count(kode_brg),status  FROM permintaan WHERE unit= '$_SESSION[divisi]'  GROUP BY tgl_permintaan  ");	
  $query2 = mysqli_query($koneksi, "SELECT COUNT(id_permintaan) AS jml FROM permintaan where unit= '$_SESSION[divisi]' ");
  $data2 = mysqli_fetch_assoc($query2);

  $query3 = mysqli_query($koneksi, "SELECT SUM(stok) as jmlbrg FROM stokbarang");
  $data3 = mysqli_fetch_assoc($query3);
?>

<section class="content-header">
<h1 class="m-0 text-dark">
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </section>

<!-- Main content -->
    <section class="content">
    <div class="container-fluid">
    <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Data Permintaan</span>
                <span class="info-box-number">
                <?= $data2['jml']; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-boxes"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Stok Barang</span>
                <span class="info-box-number"><?= $data3['jmlbrg'];exit(); ?></span>
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
          
              <div class="info-box-content">
                <span class="info-box-text">Data User</span>
                <span class="info-box-number">1</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            
            <div class="info-box mb-3">            
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
              <a href="#" class="info-box-text" data-toggle="modal" data-target="#modal-lg">
                 Tata Tertib<i class="fa fa-arrow-circle-right"></i></a>
              </div>
              
            </div>
          </div>
        </div>
        <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tata Tertib Permintaan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <p>1. Unit Pelayanan menginput data permintaan barang di form permintaan barang.</p>
			    	<p>2. Unit Pelayanan menunggu permintaan di konfirmasi oleh Kepala Unit.</p>
				    <p>3. Setelah di konfirmasi, kemudian Unit Pelayanan mencetak BPP dan kemudian membawa BPP yang telah di sah kan oleh KA Unit Pelayanan ke Gudang Bagian Pengadaan untuk dilakukan proses pengeluaran barang.</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

        <!-- TABLE: LATEST ORDERS -->
        <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Permintaan Terbaru</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal Permintaan</th>
                      <th>Jumlah</th>
                      <th>Status</th>
                      <th>Detail</th>
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
                					    <td> <?= tanggal_indo($row['tgl_permintaan']); ?> </td>	
                                        <td> <?= $row['count(kode_brg)']; ?> </td>    
                                        <td> 
                                        <?php if($row['status'] == 0): ?>
                                          <span class="badge badge-warning">Menunggu Persetujuan</span>   
                                        <?php elseif ($row['status'] == 1): ?>
                                          <span class="badge badge-info">Di Setujui Oleh KA Unit, Menunggu Acc HC & Umum</span>
                                        <?php elseif ($row['status'] == 2): ?>
                                          <span class="badge badge-success">Menunggu Pengeluaran Barang</span>
                                         <?php elseif ($row['status'] == 3): ?>
                                          <span class="badge badge-danger">Data Permintaan Telah di Batalkan Oleh KA UNIT</span>
                                         <?php else: ?>
                                          <span class="badge badge-danger">Permintaan Selesai</span>
                                        <?php endif; ?>      
                                      </td>    
                						<td>                                                                                                                                                                                                          
											<a href="?p=datapesanan&aksi=detil&tgl=<?= $row['tgl_permintaan']; ?>"><span data-placement='top' data-toggle='tooltip' title='Detail Permintaan'><button    class="btn btn-info">Detail Permintaan</button></span></a>                  
                            </td>                            
                    </tr>
                    <?php $no++; endwhile; }else {echo "<tr><td colspan=9>Tidak ada permintaan Barang.</td></tr>";} ?>
							
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="index.php?p=formpesan" class="btn btn-sm btn-info float-left">Permintaan Baru</a>
                <a href="index.php?p=datapesanan" class="btn btn-sm btn-secondary float-right">Semua Data</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

</div>
  </div>
  