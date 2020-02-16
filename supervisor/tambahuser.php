<?php  

    include_once "../fungsi/koneksi.php";

    if(isset($_POST['simpan'])) {
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $level = $_POST['level'];
        $cabang = $_POST['cabang'];
        $kaunit = $_POST['kaunit'];
        $iddivisi = $_POST['iddivisi'];
        $idjabatan = $_POST['idjabatan'];

        $query = mysqli_query($koneksi, "INSERT INTO user (nama,username,password,level,cabang,kaunit,iddivisi,idjabatan) VALUES ('$nama','$username', '$password', '$level','$cabang','$kaunit','$iddivisi','$idjabatan') ");        
        if ($query) {
            header("location:index.php?p=user");
        } else {
            echo 'gagal : ' . mysqli_error($koneksi);
        }
    }
    ?>

<section class="content">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Tambah Data User</h3>
                </div>
                <form method="post"  action="" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group ">
                            <label for="nama" class="col-sm-offset-1 col-sm-3 control-label">Nama Lengkap</label>
                            <div class="col-sm-4">
                                <input  required type="text"  class="form-control" name="nama">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="username" class="col-sm-offset-1 col-sm-3 control-label">Username</label>
                            <div class="col-sm-4">
                                <input  required type="text"  class="form-control" name="username">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="paswword"class="col-sm-offset-1 col-sm-3 control-label">Password</label>
                            <div class="col-sm-4">
                                <input required type="password" class="form-control" name="password">
                            </div>
                        </div>    
                        <div class="form-group ">                           
                            <label for="divisi" class="col-sm-offset-1 col-sm-3 control-label">Divisi</label>
                            <div class="col-sm-4">
                            <select class="form-control" name="iddivisi">
	                            <option value='' disabled selected>- Pilih -</option>
	                                <?php
		                                $divisi = mysqli_query($koneksi,"SELECT * FROM divisi");
	                                	while ($row = mysqli_fetch_array($divisi)) {
	                            		echo "<option value='$row[iddivisi]'>$row[divisi]</option>";
                                        }
	                                ?>                                  
	                            </select>                          
                            </div>
                        </div>               
                        <div class="form-group ">
                            <label for="cabang" class="col-sm-offset-1 col-sm-3 control-label">Cabang</label>
                            <div class="col-sm-4">
                                <input  required type="text"  class="form-control" name="cabang">
                            </div>
                        </div>
                        
                        <div class="form-group ">                           
                            <label for="jabatan" class="col-sm-offset-1 col-sm-3 control-label">Jabatan</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="idjabatan">
	                            <option value='' disabled selected>- Pilih -</option>
	                                <?php
		                                $jabatan = mysqli_query($koneksi,"SELECT * FROM jabatan");
	                                	while ($row = mysqli_fetch_array($jabatan)) {
	                            		echo "<option value='$row[idjabatan]'>$row[jabatan]</option>";
                                        }
	                                ?>                                  
	                            </select>                               
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="kaunit" class="col-sm-offset-1 col-sm-3 control-label">KA UNIT</label>
                            <div class="col-sm-4">
                                <input  required type="text"  class="form-control" name="kaunit">
                            </div>
                        </div>
                        <div class="form-group">
                            <label id="tes"for="nama_brg" class="col-sm-offset-1 col-sm-3 control-label">Level</label>
                            <div class="col-sm-4">
                                <select required name="level" class="form-control">
                                    <option >--Pilih Level--</option>
                                    <option value="administrator">Administrator</option>
                                    <option value="staff">Staff</option>
                                    <option value="supervisor">Supervisor</option>
                                </select>
                            </div>
                        </div>      
                        <div class="form-group">
                            <input type="submit" name="simpan" class="btn btn-primary col-sm-offset-4 " value="Simpan" > 
                            &nbsp;
                            <input type="reset" class="btn btn-danger" value="Batal">                                                                              
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
