<legend><?php echo $title;?></legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
	<div class="form-group">
           <label class="col-lg-2 control-label">Promo ID</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" value="<?php echo $noauto;?>" readonly="readonly">
                    </div>
                </div>  
    <div class="form-group">
        <label class="col-lg-2 control-label">Promo Name</label>
        <div class="col-lg-5">
            <input type="text" name="namapromo" class="form-control">
        </div>
    </div>
     <div class="form-group">
        <label class="col-lg-2 control-label">Start Date</label>
        <div class="col-lg-5">
            <input type="text" name="tglawalpromo" id="tanggal" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">End Date</label>
        <div class="col-lg-5">
            <input type="text" name="tglakhirpromo" id="tanggal2" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Picture</label>
        <div class="col-lg-5">
            <input type="file" name="gambar" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Description</label>
        <div class="col-lg-10">
            <textarea name="keterangan"></textarea>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Disc Value</label>
        <div class="col-lg-10">
           <input type="text" name="discvalue" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Status</label>
        <div class="col-lg-5">
       <select name="statuspromo" class="form-control" id="statuspromo">
                            <option>Berlaku</option>
							 <option>Expired</option>
       </select>
        </div>
    </div>
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('promo');?>" class="btn btn-default">Kembali</a>
    </div>
	
</form>