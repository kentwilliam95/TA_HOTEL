
<legend><?php echo $title;?></legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
    <?php echo validation_errors(); echo $message;?>
		 <div class="form-group">
           <label class="col-lg-2 control-label">ID Menu</label>
                    <div class="col-lg-5">
                        <input type="text" name="kode" class="form-control" value="<?php echo $menu['id_menu'];?>" readonly="readonly">
                    </div>
                </div>   
    <div class="form-group">
        <label class="col-lg-2 control-label">Nama Menu</label>
        <div class="col-lg-5">
            <input type="text" name="namamenu" class="form-control" value="<?php echo $menu['nama_menu'];?>">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Image</label>
        <div class="col-lg-10">
            <img src="<?php echo base_url('assets/img/'.$menu['gambar_menu']);?>" height="200px" width="200px">
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-lg-2 control-label"></label>
        <div class="col-lg-5">
            <input type="file" name="gambarmenu" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Harga Menu</label>
        <div class="col-lg-5">
            <input type="text" name="hargamenu" class="form-control" value="<?php echo $menu['harga_menu'];?>">
        </div>
    </div>
    
    
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('menu');?>" class="btn btn-default">Kembali</a>
    </div>
</form>