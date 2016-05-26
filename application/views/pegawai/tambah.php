<legend><?php echo $title;?></legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
	 <div class="form-group">
           <label class="col-lg-2 control-label">ID Pegawai</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" value="<?php echo $noauto;?>" readonly="readonly">
                    </div>
                </div>  
    <div class="form-group">
        <label class="col-lg-2 control-label">Nama Pegawai</label>
        <div class="col-lg-5">
            <input type="text" name="namapegawai" class="form-control">
        </div>
    </div>
     <div class="form-group">
        <label class="col-lg-2 control-label">Alamat Pegawai</label>
        <div class="col-lg-5">
            <input type="text" name="alamatpegawai" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Tanggal Lahir</label>
        <div class="col-lg-5">
            <input type="text" name="ttl" id="tanggal" class="form-control">
        </div>
    </div>
     <div class="form-group">
        <label class="col-lg-2 control-label">Telepon Pegawai</label>
        <div class="col-lg-5">
            <input type="text" name="teleponpegawai" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">Jenis Kelamin</label>
        <div class="col-lg-5">
       <select name="jkpegawai" class="form-control" id="jkpegawai">
                            <option>L</option>
							 <option>P</option>
       </select>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Jabatan</label>
        <div class="col-lg-5">
       <select name="jabatanpegawai" class="form-control" id="jabatanpegawai">
                            <option>Admin</option>
							<option>Manager</option>
							<option>Front Office</option>
							<option>Housekeeping</option>
							<option>Owner</option>
							<option>Food&Beverage</option>
							
       </select>
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Username</label>
        <div class="col-lg-5">
            <input type="text" name="username" class="form-control">
        </div>
    </div>
   <div class="form-group">
        <label class="col-lg-2 control-label">Password Pegawai</label>
        <div class="col-lg-5">
            <input type="text" name="passwordpegawai" class="form-control">
        </div>
    </div>
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('buku');?>" class="btn btn-default">Kembali</a>
    </div>
</form>