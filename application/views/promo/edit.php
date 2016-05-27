<legend><?php echo $title;?></legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
	<div class="form-group">
        <label class="col-lg-2 control-label">Promo ID</label>
        <div class="col-lg-5">
            <input type="text" name="kode" class="form-control" value="<?php echo $promo['id_promo'];?>">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Promo Name</label>
        <div class="col-lg-5">
            <input type="text" name="namapromo" class="form-control" value="<?php echo $promo['nama_promo'];?>">
        </div>
    </div>
   <div class="form-group">
        <label class="col-lg-2 control-label">Start Date</label>
        <div class="col-lg-5">
            <input type="text" name="tglawalpromo" id="tanggal" class="form-control" value="<?php echo $promo['tglawal_promo'];?>">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">End Date</label>
        <div class="col-lg-5">
            <input type="text" name="tglakhirpromo" id="tanggal2" class="form-control" value="<?php echo $promo['tglakhir_promo'];?>">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Picture</label>
        <div class="col-lg-5">
             <img src="<?php echo base_url('assets/img/'.$promo['gambar_promo']);?>" height="200px" width="200px">
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label"></label>
        <div class="col-lg-5">
            <input type="file" name="gambarpromo" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Description</label>
        <div class="col-lg-5">
            <textarea name="keterangan"><?php echo $promo['keterangan'];?></textarea>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Status</label>
        <div class="col-lg-5">
       <select name="statuspromo" class="form-control">
                <option value="<?php echo $promo['status_promo'];?>"><?php echo $promo['status_promo'];?></option>
				<option value="L">Berlaku</option>
                <option value="P">Expired</option>
            </select>
        </div>
    </div>
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('promo');?>" class="btn btn-default">Kembali</a>
    </div>
</form>