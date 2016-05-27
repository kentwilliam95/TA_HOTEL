<legend>Detail Kamar</legend>
<div class="col-md-6">
    <div class="form-horizontal">
    <div class="form-group">
        <label class="col-lg-5">ID Kamar</label>
        <div class="col-lg-5">
            : <?php echo $pinjam['id_kamar'];?>
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
	<div class="form-group">
        <label class="col-lg-5">View Kamar</label>
        <div class="col-lg-5">
            : <?php echo $pinjam['view_kamar'];?>
        </div>
    </div>
	

			
        <a href="<?php echo site_url('kamar');?>" class="btn btn-default">Kembali</a>
   
    </div>
</div>

