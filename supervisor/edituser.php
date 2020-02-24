<?php  
	include "../fungsi/koneksi.php";
    //mengambil id untuk edit user
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$query = mysqli_query($koneksi, "SELECT a.*, b.jabatan,c.divisi FROM user a JOIN jabatan b on a.idjabatan = b.idjabatan JOIN divisi c on a.iddivisi = c.iddivisi WHERE id_user = $id ");
		if (mysqli_num_rows($query)) {
			while($row2 = mysqli_fetch_assoc($query)):
?>

<section class="content">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Edit Data User</h3>
                </div>                
                <form method="post"  action="edituproses.php" class="form-horizontal">
                    <div class="box-body">
                     <div class="row">
                        <div class="col-md-2">
                            <a href="index.php?p=user" class="btn btn-primary"><i class="fa fa-backward"></i> Kembali</a> 
                        </div>
                        <br><br>
                    </div>     
                    	<input type="hidden" name="id" value="<?= $row2['id_user']; ?>">
                        <div class="form-group ">
                            <label for="nama" class="col-sm-offset-1 col-sm-3 control-label">Nama Lengkap</label>
                            <div class="col-sm-4">
                                <input type="text"  required value="<?= $row2['nama']; ?>" class="form-control" name="nama">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="username" class="col-sm-offset-1 col-sm-3 control-label">Username</label>
                            <div class="col-sm-4">
                                <input type="text"  required value="<?= $row2['username']; ?>" class="form-control" name="username">
                            </div>
                        </div>
                         <div class="form-group ">
                            <label for="cabang" class="col-sm-offset-1 col-sm-3 control-label">Cabang</label>
                            <div class="col-sm-4">
                                <input type="text" value="<?= $row2['cabang'];  ?>" required  class="form-control" name="cabang">
                            </div>
                        </div>                    
                        <div class="form-group ">
                            <label for="iddivisi" class="col-sm-offset-1 col-sm-3 control-label">Divisi</label>
                            <div class="col-sm-4">
                            <select class="form-control" name="iddivisi" required>
	                            <option value='<?= $row2['iddivisi'];  ?>'><?= $row2['divisi'];  ?></option>
                                <?php
		                                $divisi = mysqli_query($koneksi,"SELECT * FROM divisi");
	                                	while ($row = mysqli_fetch_array($divisi)) {
	                            		echo "<option value=$row[iddivisi]>$row[divisi]</option>";
                                        }
	                                ?>        
	                            </select>    
                            </div>
                        </div>         
                        <div class="form-group ">
                            <label for="kaunit" class="col-sm-offset-1 col-sm-3 control-label">KA Unit</label>
                            <div class="col-sm-4">
                                <input type="text" value="<?= $row2['kaunit'];  ?>" required  class="form-control" name="kaunit">
                            </div>
                        </div>                          
                        <div class="form-group ">
                            <label for="jabatan" class="col-sm-offset-1 col-sm-3 control-label">Jabatan</label>
                            <div class="col-sm-4">                          
                                <select class="form-control" name="idjabatan">
	                            <option value='<?= $row2['idjabatan'];  ?>'><?= $row2['jabatan'];  ?></option>
                                <?php
		                                $jabatan = mysqli_query($koneksi,"SELECT * FROM jabatan");
	                                	while ($row = mysqli_fetch_array($jabatan)) {
	                            		echo "<option value='$row[idjabatan]'>$row[jabatan]</option>";
                                        }
	                                ?>                         
	                            </select>        
                            </div>
                        </div>     
                        <div class="form-group">
                            <label for="jenis_brg" class="col-sm-offset-1 col-sm-3 control-label">Level</label>
                            <div class="col-sm-4">
                                <select id="jenis_brg" required class="form-control" name="level">
                                <option value="">--Pilih Level--</option>

                                    <option  <?php if($row2['level'] == "administrator") echo "selected"; ?>  value="administrator">Administrator</option>
                                    <option  <?php if($row2['level'] == "supervisor") echo "selected"; ?> value="supervisor">Supervisor</option>
                                    <option  <?php if($row2['level'] == "staff") echo "selected"; ?> value="staff">Staff</option>
                                    
                                </select>
                            </div>
                        </div>                         
                        <div class="form-group">
                            <input type="submit" name="update" class="btn btn-primary col-sm-offset-4 " value="Simpan" > 
                            &nbsp;
                            <input type="reset" class="btn btn-danger" value="Batal">                                                                              
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php endwhile; } }  ?>