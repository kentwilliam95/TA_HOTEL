<legend><?php echo $title;?></legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
    <div class="form-group">
           <label class="col-lg-2 control-label">ID Item</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" value="<?php echo $noauto;?>" readonly="readonly">
                    </div>
                </div>  
	<div class="form-group">
        <label class="col-lg-2 control-label">Nama Item</label>
        <div class="col-lg-5">
            <input type="text" name="namaitem" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Satuan</label>
        <div class="col-lg-5">
            <input type="text" name="satuan" class="form-control">
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Kg/Pcs</label>
      <div class="col-lg-5">
       <select name="namasatuan" class="form-control" id="namasatuan">
                            <option>Kg</option>
							<option>Pcs</option>
       </select>
        </div>
    </div>
		<div class="form-group">
        <label class="col-lg-2 control-label">Harga</label>
        <div class="col-lg-5">
            <input type="text" name="hargalaundry" class="form-control">
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Keterangan</label>
        <div class="col-lg-5">
       <select name="keterangan" class="form-control" id="keterangan">
                            <option>Laundry</option>
							<option>Dry Cleaning</option>
       </select>
        </div>
    </div>
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('laundry');?>" class="btn btn-default">Kembali</a>
    </div>
</form>