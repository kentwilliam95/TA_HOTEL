<head>
	<Script>
	$("document").ready(function(){
		$("#cari2").click(function(){
			$("#myModal2").modal("show");
		});
		
		$(".tambah").click(function()
		{
			var checkinId = $(this).attr("checkinId");
			var customerName = $(this).attr("customerName");
			var checkinDate = $(this).attr("checkinDate");
			var checkoutDate = $(this).attr("checkoutDate");
			var roomId = $(this).attr("roomId");
			
			$("#no").val(checkinId);
			$("#custname").val(customerName);
			$("#tglcheckin").val(checkinDate);
			$("#tglcheckout").val(checkoutDate);
			$("#roomid").val(roomId);
			
			$("#checkinID").val(checkinId);
			$("#roomID").val(roomId);
			
			$("#myModal2").modal("hide");
		});
	});
	</Script>
</head>

<legend><?php echo $title;?></legend>
<div class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
	
    <div class="form-group">
           <label class="col-lg-2 control-label">Check In ID</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" >
                    </div>
					<div class="col-lg-2">
                        <a href="#" class="btn btn-primary" id="cari2"><i class="glyphicon glyphicon-search"></i></a>
                    </div>
                </div>  
		 <div class="form-group">
                    <label class="col-lg-2 control-label">Customer Name</label>
                    <div class="col-lg-5">
                        <input type="text" id="custname" name="custname" class="form-control" > 
						
                    </div>
                </div>	
		<div class="form-group">
                    <label class="col-lg-2 control-label">Check In Date</label>
                    <div class="col-lg-5">
                        <input type="text" id="tglcheckin" name="tglcheckin" class="form-control" > 
						
                    </div>
                </div>		
		<div class="form-group">
                    <label class="col-lg-2 control-label">Check Out Date</label>
                    <div class="col-lg-5">
                        <input type="text" id="tglcheckout" name="tglcheckout" class="form-control" > 
						
                    </div>
                </div>
		<div class="form-group">
                    <label class="col-lg-2 control-label">Room ID</label>
                    <div class="col-lg-5">
                        <input type="text" id="roomid" name="roomid" class="form-control" > 
						
                    </div>
                </div>
	<?php echo form_open("checkout/submitData");?>
    <div class="form-group well">
	
	<input type="hidden" id="roomID" name="roomID" ></input>
	<input type="hidden" id="checkinID" name="checkinID" ></input>
	
    
    <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Proceed Check Out</button>
        <a href="<?php echo site_url('reservasi');?>" class="btn btn-default">Kembali</a>
    </div>
	<?php echo form_close();?>
</div>

<!-- Modal -->
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Cari Reservasi
                    <input type="text" name="carimenu" id="carimenu" >
								 <button id="carimenu2" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                    </h4>
					
                  </div>
                  <div class="modal-body">
				
                       <div class="form-horizontal">
                          
                        </div>
                            <table class="table table-striped">
        <thead>
            <tr>
                <td>ID Reservasi</td>
                <td>Nama </td>
                <td>Tanggal Check in</td>
				<td>Tanggal Check Out</td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($reserved as $tmp):?>
        <tr>
            <td><?php echo $tmp->id_reservasi;?></td>
            <td><?php echo $tmp->nama_reservasi;?></td>
            <td><?php echo $tmp->tgl_checkin;?></td>
			<td><?php echo $tmp->tgl_checkout;?></td>
            <td><a href="#" class="tambah" no="<?php echo $tmp->id_reservasi;?>"
            checkinId = "<?php echo $tmp->id_checkin;?>"
            customerName="<?php echo $tmp->nama_reservasi;?>"
			checkinDate="<?php echo $tmp->tgl_checkin;?>"
			checkoutDate="<?php echo $tmp->tgl_checkout;?>"
			roomId="<?php echo $tmp->id_kamar;?>"
			tipekamar="<?php echo $tmp->id_tipekamar;?>"
			tipebed="<?php echo $tmp->id_bed;?>"
			id_useroom="<?php echo $tmp->id_useroom;?>"
			>
			<i class="glyphicon glyphicon-plus"></i></a></td>
        </tr>
        <?php endforeach;?>
    </table>
                        </div>
                        
                        <div id="tampilbuku"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="konfirmasi">Hapus</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
			