<legend><?php echo $title;?></legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
    <div class="form-group">
           <label class="col-lg-2 control-label">ID</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" value="<?php echo $noauto;?>" readonly="readonly">
                    </div>
                </div>  
	    <div class="form-group">
        <label class="col-lg-2 control-label">Tipe Kamar</label>
        <div class="col-lg-7">
            <select name="tipekamar" class="form-control" id="tipekamar">
                            <?php foreach($tipekamar as $tipekamar):?>
                            <option value="<?php echo $tipekamar->nama_tipe;?>"><?php echo $tipekamar->nama_tipe;?></option>
                            <?php endforeach;?>
                        </select>
        </div>
    </div>
	  <div class="form-group">
           <label class="col-lg-2 control-label">Jenis Harga</label>
                    <div class="col-lg-5">
                        <input type="text" name="jenisharga" class="form-control">
                    </div>
                </div>
		<div class="form-group">
        <label class="col-lg-2 control-label">Tanggal Awal</label>
        <div class="col-lg-5">
            <input type="text" name="tglawalharga" id="tanggal" class="form-control">
        </div>
    </div>
		<div class="form-group">
        <label class="col-lg-2 control-label">Tanggal Akhir</label>
        <div class="col-lg-5">
            <input type="text" name="tglakhirharga" id="tanggal2" class="form-control">
        </div>
    </div>
	   <div class="form-group">
           <label class="col-lg-2 control-label">Harga</label>
                    <div class="col-lg-5">
                        <input type="text" name="harga" class="form-control">
                    </div>
                </div>  
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('laundry');?>" class="btn btn-default">Kembali</a>
    </div>
</form>