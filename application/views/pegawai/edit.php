<legend>Edit Employee</legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
    <div class="form-group">
        <label class="col-lg-2 control-label">Employee ID</label>
        <div class="col-lg-5">
            <input type="text" name="kode" class="form-control" value="<?php echo $pegawai['id_pegawai'];?>" readonly="readonly">
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-lg-2 control-label">Employee Name</label>
        <div class="col-lg-5">
            <input type="text" name="namapegawai" class="form-control" value="<?php echo $pegawai['nama_pegawai'];?>">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Address</label>
        <div class="col-lg-5">
            <input type="text" name="alamatpegawai" class="form-control" value="<?php echo $pegawai['alamat_pegawai'];?>">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">BirthDate</label>
        <div class="col-lg-5">
            <input type="text" name="ttl" id="tanggal" class="form-control" value="<?php echo $pegawai['ttl_pegawai'];?>">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Phone</label>
        <div class="col-lg-5">
            <input type="text" name="teleponpegawai" class="form-control" value="<?php echo $pegawai['telepon_pegawai'];?>">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Gender</label>
        <div class="col-lg-5">
       <select name="jkpegawai" class="form-control">
                <option value="<?php echo $pegawai['jk_pegawai'];?>"><?php echo $pegawai['jk_pegawai'];?></option>
				<option value="L">L</option>
                <option value="P">P</option>
            </select>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Job</label>
        <div class="col-lg-5">
       <select name="jabatanpegawai" class="form-control">
                <option value="<?php echo $pegawai['jabatan_pegawai'];?>"><?php echo $pegawai['jabatan_pegawai'];?></option>
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
        <label class="col-lg-2 control-label">Phone</label>
        <div class="col-lg-5">
            <input type="text" name="teleponpegawai" class="form-control" value="<?php echo $pegawai['telepon_pegawai'];?>">
        </div>
    </div>
	
	<hr>
	<div class="form-group">
        <label class="col-lg-2 control-label">Username</label>
        <div class="col-lg-5">
            <input type="text" name="username" class="form-control" value="<?php echo $pegawai['username'];?>">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Password</label>
        <div class="col-lg-5">
            <input type="text" name="password" class="form-control" value="<?php echo $pegawai['password_pegawai'];?>">
        </div>
    </div>
   <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Save</button>
        <a href="<?php echo site_url('pegawai');?>" class="btn btn-default">Back to Menu</a>
    </div>
    
</form>