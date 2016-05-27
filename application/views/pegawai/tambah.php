<legend>Add Employee</legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
	 <div class="form-group">
           <label class="col-lg-2 control-label">Employee ID</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" value="<?php echo $noauto;?>" readonly="readonly">
                    </div>
                </div>  
    <div class="form-group">
        <label class="col-lg-2 control-label">Employee Name</label>
        <div class="col-lg-5">
            <input type="text" name="namapegawai" class="form-control">
        </div>
    </div>
     <div class="form-group">
        <label class="col-lg-2 control-label">Employee Address</label>
        <div class="col-lg-5">
            <input type="text" name="alamatpegawai" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">BirthDate</label>
        <div class="col-lg-5">
            <input type="text" name="ttl" id="tanggal" class="form-control">
        </div>
    </div>
     <div class="form-group">
        <label class="col-lg-2 control-label">Phone</label>
        <div class="col-lg-5">
            <input type="text" name="teleponpegawai" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">Gender</label>
        <div class="col-lg-5">
       <select name="jkpegawai" class="form-control" id="jkpegawai">
                            <option>L</option>
							 <option>P</option>
       </select>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">JobDesc</label>
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
	<hr>
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
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Save</button>
        <a href="<?php echo site_url('pegawai');?>" class="btn btn-default">Back to Menu</a>
    </div>
</form>