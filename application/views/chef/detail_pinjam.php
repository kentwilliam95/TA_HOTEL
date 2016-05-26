<legend>Detail chef</legend>
<div class="col-md-6">
    <div class="form-horizontal">
    <div class="form-group">
        <label class="col-lg-5">ID chef</label>
        <div class="col-lg-5">
            : <?php echo $pinjam['id_chef'];?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-lg-5">Nama chef</label>
        <div class="col-lg-5">
            : <?php echo $pinjam['nama_chef'];?>
        </div>
    </div>
    

	<div class="form-group">
        <label class="col-lg-5">TTL</label>
        <div class="col-lg-5">
            : <?php echo $pinjam['ttl_chef'];?>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-5">Alamat</label>
        <div class="col-lg-5">
            : <?php echo $pinjam['alamat_chef'];?>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-5">Telepon</label>
        <div class="col-lg-5">
            : <?php echo $pinjam['telepon_chef'];?>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-5">Jenis Kelamin</label>
        <div class="col-lg-5">
            : <?php echo $pinjam['jk_chef'];?>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-5">Skill</label>
        <div class="col-lg-5">
            : <?php echo $pinjam['skill_chef'];?>
        </div>
    </div>

	
        <a href="<?php echo site_url('chef');?>" class="btn btn-default">Kembali</a>
   
    </div>
</div>

