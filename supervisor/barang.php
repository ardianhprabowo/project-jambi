<?php  
    include "../fungsi/koneksi.php";
	include "../fungsi/fungsi.php";
    
    if (isset($_GET['aksi']) && isset($_GET['id'])) {
        //die($id = $_GET['id']);
        $id = $_GET['id'];
        echo $id;

        if ($_GET['aksi'] == 'edit') {
            header("location:?p=edit&id=$id");
        } else if ($_GET['aksi'] == 'hapus') {
            header("location:?p=hapus&id=$id");
        } 
    }
	
    if(isset($_GET['id_jenis'])){
        $id_jenis = $_GET['id_jenis'];
        $query = mysqli_query($koneksi, "SELECT * FROM stokbarang WHERE id_jenis='$id_jenis' ");    
    } else {
        $query = mysqli_query($koneksi, "SELECT * FROM stokbarang");        
    }
	
	

?>
<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-sm-12">
			 <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Data Stok Barang</h3>
                </div>                
                <div class="box-body">              
                <div class="row">
                <div class="col-sm-3">
                            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
                                <div class="form-group">
                                    <select class="form-control" name="id_jenis" onchange="window.location='index.php?p=barang&id_jenis='+this.value">
                                    <option value="">Pilih Filter</option>
                                        <?php
                                        //Perintah sql untuk menampilkan semua data pada tabel barang
                                        $sql = "SELECT * FROM jenis_barang ";
                                        $hasil = mysqli_query($koneksi, $sql);
                                        $no = 0;
                                        while ($data = mysqli_fetch_array($hasil)) {
                                            $no++;
                                        ?>
                                            <option value="<?php echo $data['id_jenis']; ?>"><?php echo $data['jenis_brg']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </form>
                            <?php
                         if(isset($_GET["id_jenis"])){
                         $jenisid=$_GET["id_jenis"];   
                         echo "Data Hasil Filter ";   

                                }
                            ?>
                        </div>
                        <div class="col-sm-2">
                            <a href="index.php?p=barang" class="btn btn-info"><i class="fa fa-search"></i> Reset</a>
                        </div>                   
                	<div class="table-responsive">
                		<table class="table table-bordered table-hover text-center" id="material">
                			<thead  > 
	                			<tr>
	                				<th>No</th>	      
									<th>Tanggal Masuk</th>
                                    <th>Kode Barang</th>        				
	                				<th>Nama Barang</th>
									<th>Satuan</th>	 
                                    <th>Stok</th>              				
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
										<td> <?= tanggal_indo($row['tgl_masuk']); ?> </td>
                                        <td> <?= $row['kode_brg']; ?> </td>          					
                						<td> <?= $row['nama_brg']; ?> </td>
										<td> <?= $row['satuan']; ?> </td>
                                        <td> <?= $row['sisa']; ?> </td>       				
                				</tr>
                			<?php $no++; endwhile; } ?>
                			</tbody>
                		</table>                        
                	</div>                	
                </div>
                </div>
            </div>
		</div>
	</div>
</section>
<script>
    $(function(){
        $("#material").DataTable({
             "language": {
            "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
            "sEmptyTable": "Tidak ada data di database"
            }
        });
    });
</script> 