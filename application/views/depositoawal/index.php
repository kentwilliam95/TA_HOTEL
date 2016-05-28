<head>
	<script>
	$("document").ready(function(){
		$("#checkinBtn").click(function()
		{
			$("#myModal2").modal("show");
		});
		$("#jumlah").change(function()
		{
			//alert($("#jumlah").val());
			var j = parseInt($("#jumlah").val()) -(parseInt($("#discValue").val())/100* parseInt($("#jumlah").val()));
			alert(j);
			$("#afterDiscount").val(j);
		});
		$("#jumlahDeposit").change(function(){
			var display = 0;
			display = parseInt($("#afterDiscount").val()) - parseInt($("#jumlahDeposit").val());
			$("#sisaUang").val(display);
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
			$("#tipekamar").val($(this).attr("tipekamar"));
			$("#checkinID").val(checkinId);
			$("#roomID").val(roomId);
			
			$("#myModal2").modal("hide");
			betweenDate(checkinDate,checkoutDate);
		});
		function betweenDate( date1, date2)
		{
			
			
			var start= date1.split('-');
			var to = date2.split('-');
		    var dateStart = new Date(start[0],start[1]-1,start[2]);
			var dateStop = new Date(to[0],to[1]-1,to[2]);
			
			dateStart.setDate(dateStart.getDate() + 1);
			
			var dd1 = dateStart.getDate();
			var mm1= dateStart.getMonth()+1;
			var yyyy1 = dateStart.getFullYear();
			
			var dd2 =  dateStop.getDate();
			var mm2 = dateStop.getMonth()+1;
			var yyyy2= dateStop.getFullYear();
			
			var hasil=[];
			var looping = true;
			
			while(looping)
			{
				if(dd1 == dd2 && mm1 == mm2 && yyyy1 == yyyy2)
				{
					looping = false;
				}
				hasil.push(dateStart.getDay());
				dateStart.setDate(dateStart.getDate()+1);
				dd1 = dateStart.getDate();
				mm1 = dateStart.getMonth()+1;
				yyyy1 = dateStart.getFullYear();
			}
			
			var tprice;
			var price=[];
			var totalHarga=0;
			$.ajax({
				url:"<?php echo site_url('depositoawal/getPrice')?>",
				type:'POST',
				datatype:'text',
				data:{id_tipekamar:$("#tipekamar").val()},
				success:function(result)
				{
					tprice = result;
					price = tprice.split(',');
					//fungsi dibahaw ini untuk menghitung Amount to be paid
					for(datum in hasil)
					{
						if(datum == "0")
						{
							totalHarga = totalHarga + parseInt(price[1]);
						}
						if(datum=="1")
						{
							totalHarga = totalHarga + parseInt(price[1]);
						}
						if(datum=="2")
						{
							totalHarga = totalHarga + parseInt(price[1])
						}
						if(datum=="3")
						{
							totalHarga = totalHarga + parseInt(price[1]);
						}
						if(datum=="4")
						{
							totalHarga = totalHarga + parseInt(price[1]);
						}
						if(datum=="5")
						{
							totalHarga = totalHarga + parseInt(price[2]);
						}
						if(datum=="6")
						{
							totalHarga = totalHarga + parseInt(price[2]);
						}
						
					}
					//selesai For in 
					$("#jumlah").val(totalHarga);
				}
				
			});
			
			
		}
		$("#promoBtn").click(function()
		{
			$("#myModal3").modal("show");
		});
		
		$(".tambah1").live("click",function()
		{
			var discValue = $(this).attr("discValue");
			$("#namaPromo").val($(this).attr("namaPromo"));
			$("#discValue").val(discValue);
			$("#idPromo").val($(this).attr("idPromo"));
			var hasil = $("#jumlah").val()-($("#jumlah").val() * (discValue/100));
			$("#myModal3").modal("hide");
			$("#afterDiscount").val(hasil);
		});
		
		$("#submitData").click(function()
		{
			$("#checkinID").val($("#no").val());
			$("#nomorKredit1").val($("#nomorKredit").val());
			$("#tipeAkun1").val($("#tipeAkun").val());
			$("#jumlahUang").val($("#jumlah").val());
			$("#terbayar").val($("#jumlahDeposit").val());
			$("#sisaUang1").val($("#sisaUang").val());
			$("#tipeBayar1").val($("#tipeBayar").val());
			
		});
	});
	
	</script>
</head>

<legend><?php echo $title;?></legend>
<div class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
	<input type="hidden" id="tipekamar"></input>
    <div class="form-group">
           <label class="col-lg-2 control-label">Check In ID</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" >
                    </div>
					<div class="col-lg-2">
                        <a href="#" class="btn btn-primary" id="checkinBtn"><i class="glyphicon glyphicon-search"></i></a>
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
	  <h4>Early Deposit</h4>
	  <hr>
	  </hr>
	  <div class="form-group">
        <label class="col-lg-2 control-label">Account Type</label>
        <div class="col-lg-5">
       <select name="statmember" class="form-control" id="tipeAkun">
                         <option>Private</option>
							<option>Corporate</option>
       </select>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Payment Type</label>
        <div class="col-lg-5">
       <select name="statmember" class="form-control" id="tipeBayar">
                         <option>Cash</option>
							 <option>Credit</option>
       </select>
        </div>
    </div>
	  <div class="form-group">
                    <label class="col-lg-2 control-label">Credit Card</label>
                    <div class="col-lg-5">
                        <input type="text" id="nomorKredit" name="tglreservasi" class="form-control" > 
						*isilah jika ada
                    </div>
                </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Amount to be Paid</label>
        <div class="col-lg-5">
            <input type="text" name="jumlah" id="jumlah" class="form-control">
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Promo</label>
        <div class="col-lg-5">
            <input type="text" name="namaPromo" id="namaPromo" class="form-control">
        </div>
		<div class="col-lg-2">
                        <a href="#" class="btn btn-primary" id="promoBtn"><i class="glyphicon glyphicon-search"></i></a>
                    </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Discount</label>
        <div class="col-lg-5">
            <input type="text" name="tglcheckout" id="discValue" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">After Discount</label>
        <div class="col-lg-5">
            <input type="text" name="afterDiscount" id="afterDiscount" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Early Deposit</label>
        <div class="col-lg-5">
            <input type="text"  id="jumlahDeposit" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Change</label>
        <div class="col-lg-5">
            <input type="text" id="sisaUang" class="form-control">
        </div>
    </div>
	<?php echo form_open("depositoawal/submitData");?>
    <div class="form-group well">
	
	<input type="hidden" id="checkinID" name="checkinID" ></input>
	<input type="hidden" id="jumlahUang" name="jumlahUang" ></input>
	<input type="hidden" id="terbayar" name="terbayar" ></input>
	<input type="hidden" id="sisaUang1" name="sisaUang1" ></input>
	
	<input type="hidden" id="tipeBayar1" name="tipeBayar1" ></input>
	<input type="hidden" id="tipeAkun1" name="tipeAkun1" ></input>
	<input type="hidden" id="nomorKredit1" name="nomorKredit1" ></input>
	<input type="hidden" id="idPromo" name="idPromo" ></input>
	
        <button id="submitData" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
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
                    <h4 class="modal-title">Search Guest
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
                <td>Reservation ID</td>
                <td>Reservation Name</td>
                <td>Check In Date</td>
				<td>Check Out Date</td>
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
			
<!-- Modal -->
            <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Search Promo
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
                <td>Promo ID</td>
                <td>Promo Name </td>
				<td>Disc Value</td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($promo as $pro):?>
        <tr>
            <td><?php echo $pro->id_promo;?></td>
            <td><?php echo $pro->nama_promo;?></td>
            <td><?php echo $pro->disc_value;?>%</td>
            <td><a href="#" class="tambah1" 
            discValue="<?php echo $pro->disc_value?>"
			namaPromo="<?php echo $pro->nama_promo?>"
			idPromo="<?php echo $pro->id_promo?>"
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