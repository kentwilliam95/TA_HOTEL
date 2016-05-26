<legend><?php echo $title;?></legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
	<div class="form-group">
           <label class="col-lg-2 control-label">ID Chef</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" value="<?php echo $noauto;?>" readonly="readonly">
                    </div>
                </div>  
    <div class="form-group">
        <label class="col-lg-2 control-label">Nama Chef</label>
        <div class="col-lg-5">
            <input type="text" name="namachef" class="form-control">
        </div>
    </div>
     <div class="form-group">
        <label class="col-lg-2 control-label">Alamat Chef</label>
        <div class="col-lg-5">
            <input type="text" name="alamatchef" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Tanggal Lahir</label>
        <div class="col-lg-5">
            <input type="text" name="ttl" id="tanggal" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Jenis Kelamin</label>
        <div class="col-lg-5">
       <select name="jkchef" class="form-control" id="jkcustomer">
                            <option>L</option>
							 <option>P</option>
       </select>
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Telepon Chef</label>
        <div class="col-lg-5">
            <input type="text" name="teleponchef" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Skill</label>
        <div class="col-lg-10">
            <textarea name="skillchef"></textarea>
        </div>
    </div>
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('chef');?>" class="btn btn-default">Kembali</a>
    </div>
	
</form>