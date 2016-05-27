<script>
	$(document).ready(function(){
		
		$("#tambah").click(function(){
			$("#groupChoice").after('<div id="groupChoice"><div class="form-group"><label class="col-lg-2 control-label">Check In Date</label><div class="col-lg-5"><input type="text" name="tglcheckin" id="tanggal" class="form-control checkin"></div></div><div class="form-group"><label class="col-lg-2 control-label">Check Out Date</label><div class="col-lg-5"><input type="text" name="tglcheckout" id="tanggal2" class="form-control checkout"></div></div><div class="form-group"><label class="col-lg-2 control-label">Room Type</label> <div class="col-lg-5"><select name="idtipe" class="form-control tipekamar" id="idtipe"><?php foreach($tipekamar as $tipekamar):?><option value="<?php echo $tipekamar->nama_tipe;?>"><?php echo $tipekamar->nama_tipe;?></option><?php endforeach;?></select></div></div><div class="form-group"><label class="col-lg-2 control-label">Bed Type</label> <div class="col-lg-5"><select name="idbed" class="form-control tipebed" id="idbed"><?php foreach($anggota as $anggota):?><option value="<?php echo $anggota->nama_bed;?>"><?php echo $anggota->nama_bed;?></option><?php endforeach;?></select></div></div></div>');
		});
		$("body").on("click",".checkin",function(i){
			$(this).datepicker();
			//$(".checkin").datepicker();
			//alert("suk");
		});
		$("body").on("click",".checkout",function(i){
			$(this).datepicker("option", "dateFormat", "yy-mm-dd ");
			//$(".checkout").datepicker();
			//alert("suk");
		});
		$("#simpan").click(function(){
			var temp1 = [];
			$(".tipekamar").each(function(i){
				temp1[i] = $(this).val();
			});
			$("#tipekamarTemp").val(temp1);
			
			temp1 =[];
			$(".tipebed").each(function(i){
				temp1[i] = $(this).val();
			});
			$("#tipebedTemp").val(temp1);
			
			temp1 =[];
			$(".checkin").each(function(i){
				temp1[i] = $(this).val();
			});
			$("#checkinTemp").val(temp1);
			
			temp1 =[];
			$(".checkout").each(function(i){
				temp1[i] = $(this).val();
			});
			$("#checkoutTemp").val(temp1);
			$("#jumlahTemp").val($("#jumlah").val());
			$("#reservasiTemp").val($("#no").val());
			$("#namaTemp").val($("#nama").val());
			$("#tgl_reservasiTemp").val($("#tglreservasi").val());
		});
	})
</script>
<body>
<legend>Add Reservation</legend>
<div class="form-horizontal" action="#"/>
    <?php echo validation_errors(); echo $message;?>
    <div class="form-group">
           <label class="col-lg-2 control-label">Reservation ID</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" value="<?php echo $noauto;?>" readonly="readonly">
                    </div>
                </div>  
	  <div class="form-group">
                    <label class="col-lg-2 control-label">Reservation</label>
                    <div class="col-lg-5">
                        <input type="text" id="tglreservasi" name="tglreservasi" class="form-control" value="<?php echo $tgl_reservasi;?>" readonly="readonly">
                    </div>
                </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Customer Name</label>
        <div class="col-lg-5">
            <input id ="nama" type="text" name="namareservasi" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Guest</label>
        <div class="col-lg-5">
            <input id="jumlah" type="text" name="jumlah" class="form-control">
        </div>
		<button id="tambah" class="btn btn-primary addBtn"><i class="glyphicon glyphicon-plus "></i></button>
    </div>
	
	<div id="groupChoice">
	 <div class="form-group">
        <label class="col-lg-2 control-label">Check In Date</label>
        <div class="col-lg-5">
            <input type="text" name="tglcheckin"  class="form-control checkin">
        </div>
    </div>
	
	 <div class="form-group">
        <label class="col-lg-2 control-label">Check Out Date</label>
        <div class="col-lg-5">
            <input type="text" name="tglcheckout"  class="form-control checkout">
        </div>
    </div>
	
	
		<div class="form-group">
			<label class="col-lg-2 control-label">Room Type</label> 
			
			<div class="col-lg-5">
				<select name="idtipe" class="form-control tipekamar" id="idtipe">
								<?php foreach($tipekamar1 as $tipekamar1):?>
								<option value="<?php echo $tipekamar1->nama_tipe;?>"><?php echo $tipekamar1->nama_tipe;?></option>
								<?php endforeach;?>
							</select>
			</div>
		</div>
		 <div class="form-group">
			<label class="col-lg-2 control-label">Bed Type</label> 
			<div class="col-lg-5">
		  <select name="idbed" class="form-control tipebed" id="idbed">
		  
								<?php foreach($anggota1 as $anggota1):?>
								<option value="<?php echo $anggota1->nama_bed;?>"><?php echo $anggota1->nama_bed;?></option>
								<?php endforeach;?>
							</select>
			</div>
		</div>
		
	</div>
	 <?php echo form_open("reservasi/tambahData");?>
    <div class="form-group well">
	<input type="hidden" name ="checkinTemp" id="checkinTemp"></input>
	<input type="hidden" name="checkoutTemp" id="checkoutTemp"></input>
	<input type="hidden" name="tipekamarTemp" id="tipekamarTemp"></input>
	<input type="hidden" name="tipebedTemp" id="tipebedTemp"></input>
	<input type="hidden" name="reservasiTemp" id="reservasiTemp"></input>
	<input type="hidden" name="jumlahTemp" id="jumlahTemp"></input>
	<input type="hidden" name="namaTemp" id="namaTemp"></input>
	<input type="hidden" name="tgl_reservasiTemp" id="tgl_reservasiTemp"></input>
        <button id="simpan" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i>	Save</button>
        <a href="<?php echo site_url('reservasi');?>" class="btn btn-default">Back to Menu</a>
    </div>
	<?php echo form_close();?>
</div>
</body>