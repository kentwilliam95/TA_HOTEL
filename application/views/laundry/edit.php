<legend><?php echo $title;?></legend>
<?php echo validation_errors();?>
<?php echo $message;?>

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
	 <div class="form-group">
           <label class="col-lg-2 control-label">Item ID</label>
                    <div class="col-lg-5">
                        <input type="text" name="kode" class="form-control" value="<?php echo $laundry['id_laundry'];?>" readonly="readonly">
                    </div>
                </div>  
	 <div class="form-group">
           <label class="col-lg-2 control-label">Clothes Type</label>
                    <div class="col-lg-5">
                        <input type="text" name="namaitem" class="form-control" value="<?php echo $laundry['nama_item'];?>" >
                    </div>
                </div>  
	<div class="form-group">
           <label class="col-lg-2 control-label">Unit</label>
                    <div class="col-lg-5">
                        <input type="text" name="satuan" class="form-control" value="<?php echo $laundry['satuan'];?>" >
                    </div>
                </div>  
	<div class="form-group">
        <label class="col-lg-2 control-label">Kg/Pcs</label>
      <div class="col-lg-5">
       <select name="namasatuan" class="form-control" id="namasatuan">
				<option value="<?php echo $laundry['nama_satuan'];?>"><?php echo $laundry['nama_satuan'];?></option>
                            <option>Kg</option>
							<option>Pcs</option>
       </select>
        </div>
    </div>
	<div class="form-group">
           <label class="col-lg-2 control-label">Price</label>
                    <div class="col-lg-5">
                        <input type="text" name="hargalaundry" class="form-control" value="<?php echo $laundry['harga_laundry'];?>" >
                    </div>
                </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Laundry Type</label>
      <div class="col-lg-5">
       <select name="keterangan" class="form-control" id="keterangan">
				<option value="<?php echo $laundry['keterangan'];?>"><?php echo $laundry['keterangan'];?></option>
                            <option>Laundry</option>
							<option>Dry Cleaning</option>
       </select>
        </div>
    </div>
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Update</button>
        <a href="<?php echo site_url('laundry');?>" class="btn btn-default">Kembali</a>
    </div>
</form>