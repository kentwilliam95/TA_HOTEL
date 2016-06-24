<legend><?php echo $title;?></legend>
<?php echo validation_errors();?>
<?php echo $message;?>

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
	 <div class="form-group">
           <label class="col-lg-2 control-label">ID Bed</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" value="<?php echo $idBaru;?>" readonly="readonly">
                    </div>
                </div>         
    <div class="form-group">
        <label class="col-lg-2 control-label">Nama Bed</label>
        <div class="col-lg-5">
            <input type="text" name="namabed" class="form-control">
        </div>
    </div>
    
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('anggota');?>" class="btn btn-default">Kembali</a>
    </div>
</form>