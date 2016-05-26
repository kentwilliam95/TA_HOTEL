<legend><?php echo $title;?></legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
		 <div class="form-group">
		 	<div class="form-group">
        <label class="col-lg-2 control-label">Kategori</label>
        <div class="col-lg-7">
            <select name="idkategori" class="form-control" id="idkategori">
                            <?php foreach($kategori as $kategori):?>
                            <option value="<?php echo $kategori->nama_kategori;?>"><?php echo $kategori->nama_kategori;?></option>
                            <?php endforeach;?>
                        </select>
        </div>
    </div>
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
        <label class="col-lg-2 control-label">Start Guarantee</label>
        <div class="col-lg-5">
            <input type="text" name="startguarantee" id="tanggal" class="form-control">
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">End Guarantee</label>
        <div class="col-lg-5">
            <input type="text" name="endguarantee" id="tanggal2" class="form-control">
        </div>
    </div>
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('inventaris');?>" class="btn btn-default">Kembali</a>
    </div>
</form>