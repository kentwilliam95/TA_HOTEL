<legend><?php echo $title;?></legend>
<?php echo validation_errors();?>
<?php echo $message;?>

<?php echo form_open("roomprice/newEdit");?>
<div class="form-horizontal">
	 <div class="form-group">
           <label class="col-lg-2 control-label">ID</label>
                    <div class="col-lg-5">
                        <input type="text" name="kode" class="form-control" value="<?php echo $roomprice['id_price'];?>" readonly="readonly">
                    </div>
                </div>  
	<div class="form-group">
        <label class="col-lg-2 control-label">Tipe Kamar</label>
      <div class="col-lg-5">
				
                           <select name="tipekamar" class="form-control" id="tipekamar">
						   <option value="<?php echo $roomprice['id_tipekamar'];?>"><?php echo $roomprice['id_tipekamar'];?></option>
                            <?php foreach($tipekamar as $tipekamar):?>
                            <option value="<?php echo $tipekamar->nama_tipe;?>"><?php echo $tipekamar->nama_tipe;?></option>
                            <?php endforeach;?>
                        </select>
        </div>
    </div>
	 <div class="form-group">
           <label class="col-lg-2 control-label">Jenis Harga</label>
                    <div class="col-lg-5">
                        <input type="text" name="jenisharga" class="form-control" value="<?php echo $roomprice['jenis_harga'];?>">
                    </div>
                </div>
		<div class="form-group">
        <label class="col-lg-2 control-label">Tanggal Awal</label>
        <div class="col-lg-5">
            <input type="text" name="tglawalharga" id="tanggal" class="form-control" value="<?php echo $roomprice['tgl_awalharga'];?>">
        </div>
    </div>
		<div class="form-group">
        <label class="col-lg-2 control-label">Tanggal Akhir</label>
        <div class="col-lg-5">
            <input type="text" name="tglakhirharga" id="tanggal2" class="form-control" value="<?php echo $roomprice['tgl_akhirharga'];?>">
        </div>
    </div>
	   <div class="form-group">
           <label class="col-lg-2 control-label">Transit</label>
                    <div class="col-lg-5">
                        <input type="text" name="transit" class="form-control" value="<?php echo $roomprice['transit'];?>">
                    </div>
       </div>  
	<div class="form-group">
           <label class="col-lg-2 control-label">Weekday</label>
                    <div class="col-lg-5">
                        <input type="text" name="weekday" class="form-control" value="<?php echo $roomprice['weekday'];?>">
                    </div>
       </div>  
	<div class="form-group">
           <label class="col-lg-2 control-label">Weekend</label>
                    <div class="col-lg-5">
                        <input type="text" name="weekend" class="form-control" value="<?php echo $roomprice['weekend'];?>">
                    </div>
       </div>  

    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Update</button>
        <a href="<?php echo site_url('roomprice');?>" class="btn btn-default">Kembali</a>
    </div>
</div>
<?php echo form_close();?>