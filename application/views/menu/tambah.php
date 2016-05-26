<legend><?php echo $title;?></legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
		 <div class="form-group">
           <label class="col-lg-2 control-label">ID Menu</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" value="<?php echo $noauto;?>" readonly="readonly">
                    </div>
                </div>   
    <div class="form-group">
        <label class="col-lg-2 control-label">Nama Menu</label>
        <div class="col-lg-5">
            <input type="text" name="namamenu" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Gambar</label>
        <div class="col-lg-5">
            <input type="file" name="gambar" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Harga Menu</label>
        <div class="col-lg-5">
            <input type="text" name="hargamenu" class="form-control">
        </div>
    </div>
    
   
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('buku');?>" class="btn btn-default">Kembali</a>
    </div>
</form>