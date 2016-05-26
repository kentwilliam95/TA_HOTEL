<legend><?php echo $title;?></legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
    <div class="form-group">
        <label class="col-lg-2 control-label">ID Kategori</label>
        <div class="col-lg-5">
            <input type="text" name="kode" class="form-control" value="<?php echo $kategoriinventaris['id_kategoriinventaris'];?>" readonly="readonly">
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-lg-2 control-label">Nama Kategori</label>
        <div class="col-lg-5">
            <input type="text" name="namakategori" class="form-control" value="<?php echo $kategoriinventaris['nama_kategori'];?>">
        </div>
    </div>
    </div>
    
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('kategoriinventaris');?>" class="btn btn-default">Kembali</a>
    </div>
</form>