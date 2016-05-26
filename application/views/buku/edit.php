<legend><?php echo $title;?></legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
    <div class="form-group">
        <label class="col-lg-2 control-label">ID Tipe Kamar</label>
        <div class="col-lg-5">
            <input type="text" name="kode" class="form-control" value="<?php echo $buku['id_tipekamar'];?>" readonly="readonly">
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-lg-2 control-label">Nama Tipe Kamar</label>
        <div class="col-lg-5">
            <input type="text" name="namatipe" class="form-control" value="<?php echo $buku['nama_tipe'];?>">
        </div>
    </div>
    </div>
    
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('buku');?>" class="btn btn-default">Kembali</a>
    </div>
</form>