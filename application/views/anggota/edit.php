<legend><?php echo $title;?></legend>
<?php echo validation_errors();?>
<?php echo $message;?>

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-lg-2 control-label">Bed ID</label>
        <div class="col-lg-5">
            <input type="text" name="kode" class="form-control" value="<?php echo $anggota['id_bed'];?>" readonly="readonly">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">Bed Type</label>
        <div class="col-lg-5">
            <input type="text" name="namabed" class="form-control" value="<?php echo $anggota['nama_bed'];?>">
        </div>
    </div>
    
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Update</button>
        <a href="<?php echo site_url('anggota');?>" class="btn btn-default">Kembali</a>
    </div>
</form>