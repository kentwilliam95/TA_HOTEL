<script>
	$(document).ready(function(){
		
		$("#tambah").click(function(){
			$("#groupChoice").after('<div id="groupChoice"><div class="form-group"><label class="col-lg-2 control-label">Tanggal Check In</label><div class="col-lg-5"><input type="text" name="tglcheckin" id="tanggal" class="form-control checkin"></div></div><div class="form-group"><label class="col-lg-2 control-label">Tanggal Check Out</label><div class="col-lg-5"><input type="text" name="tglcheckout" id="tanggal2" class="form-control checkout"></div></div><div class="form-group"><label class="col-lg-2 control-label">Tipe Kamar</label> <div class="col-lg-5"><select name="idtipe" class="form-control tipekamar" id="idtipe"><?php foreach($tipekamar as $tipekamar):?><option value="<?php echo $tipekamar->nama_tipe;?>"><?php echo $tipekamar->nama_tipe;?></option><?php endforeach;?></select></div></div><div class="form-group"><label class="col-lg-2 control-label">Tipe Bed</label> <div class="col-lg-5"><select name="idbed" class="form-control tipebed" id="idbed"><?php foreach($anggota as $anggota):?><option value="<?php echo $anggota->nama_bed;?>"><?php echo $anggota->nama_bed;?></option><?php endforeach;?></select></div></div></div>');
		});

		$("body").on("click",".tglexpenses",function(i){
			$(this).datepicker("option", "dateFormat", "yy-mm-dd ");
			//$(".checkout").datepicker();
			//alert("suk");
		});

	
	})
</script>

<legend><?php echo $title;?></legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
		 
				 <div class="form-group">
           <label class="col-lg-2 control-label">Date</label>
                    <div class="col-lg-5">
                        <input type="text" id="tanggal" name="tanggal" class="form-control" value="<?php echo $tgl_pengeluaran;?>" readonly="readonly">
                    </div>
                </div>  
    <div class="form-group">
        <label class="col-lg-2 control-label">Category</label>
        <div class="col-lg-5">
				<select name="no2" class="form-control tipekamar" id="no2">
								<?php foreach($kategori as $kategori):?>
								<option value="<?php echo $kategori->nama_kategoripengeluaran;?>"><?php echo $kategori->nama_kategoripengeluaran;?></option>
								<?php endforeach;?>
							</select>
			</div>
    </div>
    		 <div class="form-group">
           <label class="col-lg-2 control-label">Nominal</label>
                    <div class="col-lg-5">
                        <input type="text" id="nominal" name="nominal" class="form-control"  >
                    </div>
                </div>   
   		 <div class="form-group">
           <label class="col-lg-2 control-label">Description</label>
                    <div class="col-lg-5">
                        <input type="text" id="desc" name="desc" class="form-control">
                    </div>
                </div>   
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Save</button>
        <a href="<?php echo site_url('expenses');?>" class="btn btn-default">Back to Menu</a>
    </div>
</form>