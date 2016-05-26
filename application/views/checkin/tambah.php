<legend><?php echo $title;?></legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
    <div class="form-group">
           <label class="col-lg-2 control-label">ID Reservasi</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" value="<?php echo $noauto;?>" readonly="readonly">
                    </div>
                </div>  
	  <div class="form-group">
                    <label class="col-lg-2 control-label">Tgl Reservasi</label>
                    <div class="col-lg-7">
                        <input type="text" id="tglreservasi" name="tglreservasi" class="form-control" value="<?php echo $tgl_reservasi;?>" readonly="readonly">
                    </div>
                </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Nama Customer</label>
        <div class="col-lg-5">
            <input type="text" name="namareservasi" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Jumlah</label>
        <div class="col-lg-5">
            <input type="text" name="jumlah" class="form-control">
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Tanggal Check In</label>
        <div class="col-lg-5">
            <input type="text" name="tglcheckin" id="tanggal" class="form-control">
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Tanggal Check Out</label>
        <div class="col-lg-5">
            <input type="text" name="tglcheckout" id="tanggal2" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Tipe Kamar</label>
        <div class="col-lg-7">
            <select name="idtipe" class="form-control" id="idtipe">
                            <?php foreach($tipekamar as $tipekamar):?>
                            <option value="<?php echo $tipekamar->nama_tipe;?>"><?php echo $tipekamar->nama_tipe;?></option>
                            <?php endforeach;?>
                        </select>
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Tipe Bed</label>
        <div class="col-lg-7">
      <select name="idbed" class="form-control" id="idbed">
                            <?php foreach($anggota as $anggota):?>
                            <option value="<?php echo $anggota->nama_bed;?>"><?php echo $anggota->nama_bed;?></option>
                            <?php endforeach;?>
                        </select>
        </div>
    </div>

    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('reservasi');?>" class="btn btn-default">Kembali</a>
    </div>
</form>