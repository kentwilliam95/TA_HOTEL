<legend>Add Laundry</legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
    <div class="form-group">
           <label class="col-lg-2 control-label">Item ID</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" value="<?php echo $noauto;?>" readonly="readonly">
                    </div>
                </div>  
	<div class="form-group">
        <label class="col-lg-2 control-label">Clothes Type</label>
        <div class="col-lg-5">
            <input type="text" name="namaitem" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Unit</label>
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
        <label class="col-lg-2 control-label">Price</label>
        <div class="col-lg-5">
            <input type="text" name="hargalaundry" class="form-control">
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Laundry Type</label>
        <div class="col-lg-5">
       <select name="keterangan" class="form-control" id="keterangan">
                            <option>Laundry</option>
							<option>Dry Cleaning</option>
       </select>
        </div>
    </div>
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Save</button>
        <a href="<?php echo site_url('laundry');?>" class="btn btn-default">Back to Menu</a>
    </div>
</form>