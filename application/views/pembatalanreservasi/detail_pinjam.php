<legend>Detail Reservasi</legend>
<div class="col-md-6">
    <div class="form-horizontal">
    <div class="form-group">
        <label class="col-lg-5">ID Reservasi</label>
        <div class="col-lg-5">
            : <?php echo $pinjam['id_reservasi'];?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-lg-5">Nama Customer</label>
        <div class="col-lg-5">
            : <?php echo $pinjam['nama_reservasi'];?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-lg-5">Tanggal Reservasi</label>
        <div class="col-lg-5">
            : <?php echo $pinjam['tgl_reservasi'];?>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-5">Tanggal Check In</label>
        <div class="col-lg-5">
            : <?php echo $pinjam['tgl_checkin'];?>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-5">Tanggal Check Out</label>
        <div class="col-lg-5">
            : <?php echo $pinjam['tgl_checkout'];?>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-5">Passengers</label>
        <div class="col-lg-5">
            : <?php echo $pinjam['passengers'];?>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-5">Tipe Kamar</label>
        <div class="col-lg-5">
            : <?php echo $pinjam['id_tipekamar'];?>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-5">Tipe Bed</label>
        <div class="col-lg-5">
            : <?php echo $pinjam['id_bed'];?>
        </div>
    </div>
	
        <a href="<?php echo site_url('reservasi');?>" class="btn btn-default">Kembali</a>
   
    </div>
</div>

