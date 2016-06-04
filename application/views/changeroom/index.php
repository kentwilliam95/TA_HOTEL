<head>
	<script>
		$("document").ready(function()
		{
			//alert(1);
			$("#cari2").click(function()
			{
				$("#myModal2").modal("show");
			});
			
			$("#submitData").click(function()
			{
				
				$("#tipebed").val($("#idbed").val());
				$("#tipekamar").val($("#idtipe").val());
				$("#idkamar").val($("#no1").val());
				$("#checkinId").val($("#no").val());
				alert($("#tipebed").val()+","+$("#tipekamar").val()+","+$("#idkamar").val()+","+$("#checkinId").val());
			});
			
			$(".tambah").live("click",function(){
			var id_useroom = $(this).attr("id_useroom");
            var kode=$(this).attr("checkinId");
			var checkinDate=$(this).attr("checkinDate");
			var checkoutDate=$(this).attr("checkoutDate");
			var tipekamar=$(this).attr("tipekamar");
			var tipebed=$(this).attr("tipebed");
			var namareservasi=$(this).attr("customerName");
			var roomId = $(this).attr("roomId");
            
            $("#no").val(kode);
			$("#tglcheckin").val(checkinDate);
			$("#tglcheckout").val(checkoutDate);
			$("#idtipe").val(tipekamar);
			$("#idbed").val(tipebed);
			$("#custname").val(namareservasi);
			$("#roomid").val(roomId);

			$("#kodeUseroom").val(kode);
			$("#id_useroom").val(id_useroom);
			
            
            $("#myModal2").modal("hide");
        })
		
		$(".tambah1").live("click",function()
		{
				
				var temp1 = $(this).attr("carikamar");
				//alert(temp1);
				$("#no1").val(temp1);
				
				$("#myModal3").modal("hide");
		});
		
		$("#nis").click(function(){
			var tipekamar1= $("#idtipe").val();
			var tipebed1 = $("#idbed").val();
			//alert(tipekamar1+","+tipebed1);
			checkKamar(tipekamar1,tipebed1);
            $("#myModal3").modal("show");
        })
		$("#cari23").click(function(){
            var cari22=$("#cari22").val();
            
            $.ajax({
                url:"<?php echo site_url('changeroom/pencarianbuku');?>",
                type:"POST",
                data:"cari22="+cari22,
                cache:false,
                success:function(html){
                    $("#tampilbuku").html(html);
					$("#xx").hide();
                }
            })
			//alert("x");
        })
		function checkKamar(tipekamar1,tipebed1)
		{
			$.ajax({
                url:"<?php echo site_url('changeroom/CariKamar')?>", 
				type:"POST",
				datatype:"json",
				data:{tipekamar: tipekamar1,tipebed: tipebed1},
				success: function(result)
				{
					//alert("aa");
					$("#isiTabel").html(result);
				},
				error:function(aaa)
				{
					alert(aaa);
				}
            });
		}
		
		});
	</script>
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
	<br>
	<br>
	<h4>Change Room</h4>
	<hr>
	<div class="form-group">
        <label class="col-lg-2 control-label">Tipe Kamar</label>
        <div class="col-lg-5">
            <select name="idtipe" class="form-control" id="idtipe">
                            <?php foreach($tipekamar as $tipekamar):?>
                            <option value="<?php echo $tipekamar->nama_tipe;?>"><?php echo $tipekamar->nama_tipe;?></option>
                            <?php endforeach;?>
                        </select>
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Tipe Bed</label>
        <div class="col-lg-5">
      <select name="idbed" class="form-control" id="idbed">
                            <?php foreach($anggota as $tipebed):?>
                            <option value="<?php echo $tipebed->nama_bed;?>"><?php echo $tipebed->nama_bed;?></option>
                            <?php endforeach;?>
                        </select>
        </div>
    </div>
	<div class="form-group">
           <label class="col-lg-2 control-label">New Room ID</label>
                    <div class="col-lg-5">
                        <input type="text" id="no1" name="no1" class="form-control" >
                    </div>
					<div class="col-lg-2">
                        <a href="#" class="btn btn-primary" id="nis"><i class="glyphicon glyphicon-search"></i></a>
                    </div>
                </div>  
	<?php echo form_open("changeroom/submit");?>
    <div class="form-group well">
	
	<input type="hidden" id="tipebed" name="tipebed" ></input>
	<input type="hidden" id="tipekamar" name="tipekamar" ></input>
	<input type="hidden" id="idkamar" name="idkamar" ></input>
	<input type="hidden" id="checkinId" name="checkinId"></input>
	<input type="hidden" id="id_useroom" name="id_useroom"></input>
	
        <button class="btn btn-primary" id="submitData"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
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
                    <input type="text" name="cari22" id="cari22" >
								 <button id="cari23" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                    </h4>
					
                  </div>
                  <div class="modal-body">
				
                       <div class="form-horizontal">
                          
                        </div>
                            <table class="table table-striped" id="xx">
        <thead>
            <tr>
                <td>ID Reservasi</td>
                <td>Nama </td>
                <td>Tanggal Check in</td>
				<td>Tanggal Check Out</td>
                <td>Room ID</td>
            </tr>
        </thead>
        <?php foreach($reserved as $tmp):?>
        <tr>
            <td><?php echo $tmp->id_reservasi;?></td>
            <td><?php echo $tmp->nama_reservasi;?></td>
            <td><?php echo $tmp->tgl_checkin;?></td>
			<td><?php echo $tmp->tgl_checkout;?></td>
			<td><?php echo $tmp->id_kamar;?></td>
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
			
			
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Search Room
                    
                    </h4>
					
                  </div>
                  <div class="modal-body">
				
                       <div class="form-horizontal">
                          
                        </div>
                            <table id ="isiTabel" class="table table-striped">
        <thead>
            <tr>
                <td>ID Kamar</td>
                <td>Tipe Kamar </td>
                <td>Tipe Bed</td>
            </tr>
        </thead>
		
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
 