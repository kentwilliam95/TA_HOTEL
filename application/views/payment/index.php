<head>
	<script>
		$("document").ready(function()
		{
			var LU;
			var RU;
			$("#buttonSubmit").click(function()
			{
				$("#checkinID").val($("#no").val());
				$("#exchange").val($("#Exchange").val());
				
				if($("#Exchange").val() == "")
				{
					alert("Exchange kosong");
				}
				else if(parseInt($("#Exchange").val()) < 0)
				{
					alert("Transaksi Gagal Exchange tidak boleh minus");
				}
				else
				{
					alert("Transaksi Berhasil");
				}
			})
			$("#searchBTN").click(function()
			{
				$("#myModal2").modal("show");
			});
			$(".tambah").live("click",function()
			{
				var checkinID = $(this).attr("checkinId");
				var customerName = $(this).attr("customerName");
				var checkinDate = $(this).attr("checkinDate");
				var checkoutDate = $(this).attr("checkoutDate");
				var roomId = $(this).attr("roomId");
				var accountType = $(this).attr("accountType");
				var paymentType = $(this).attr("paymentType");
				var creditCard = $(this).attr("creditCard");
				var Amount = $(this).attr("Amount");
				var promo = $(this).attr("promo");
				var discount = $(this).attr("discount");
				var earlyDeposit = $(this).attr("earlyDeposit");
				var change = $(this).attr("change");
				
				$("#no").val(checkinID);
				$("#custname").val(customerName);
				$("#tglcheckin").val(checkinDate);
				$("#tglcheckout").val(checkoutDate);
				$("#roomid").val(roomId);
				$("#tipeAkun").val(accountType);
				$("#tipePembayaran").val(paymentType);
				$("#noCredit").val(creditCard);
				$("#jumlah").val(Amount);
				$("#namaPromo").val(promo);
				$("#disc_value").val(discount);
				$("#earlyDeposit").val(earlyDeposit);
				$("#changeValue").val(change);
				$("#id_kamar").val(roomId);
				$("#afterDiscount").val(Amount-(Amount*discount/100));
				$("#tanggal").val(checkoutDate);
				hitungLaundry(checkinID);
				hitungRestaurant(checkinID);
				
				$("#LaundryUsage").val(LU);
				$("#RestaurantUsage").val(RU);
				$("#TotalUsage").val((parseInt(LU)+parseInt(RU)));
				var TATBP = parseInt($("#TotalUsage").val())+parseInt($("#changeValue").val());
				$("#TATBP").val(TATBP);
				$("#myModal2").modal("hide");
			});
			function hitungLaundry(checkinID)
			{
				var temp;
				
				$.ajax
				({
						url:"<?php echo site_url("payment/hitungLaundry")?>",
						type:"POST",
						async:false,
						data:{checkinId:checkinID},
						success:function(result)
						{
							LU = result;
						}
				})
				
				
			}
			function hitungRestaurant(checkinID)
			{
				$.ajax
				({
						url:"<?php echo site_url("payment/hitungRestaurant")?>",
						type:"POST",
						async:false,
						datatype:"text",
						data:{checkinId:checkinID},
						success:function(result)
						{
							RU = result;
						}
				})
			}
			$("#PAID").change(function()
			{
				var hasil = -1*parseInt($("#TATBP").val())+parseInt($("#PAID").val());
				
				$("#Exchange").val(hasil);
			});
			$("#cari23").click(function(){
            var cari22=$("#cari22").val();
            
            $.ajax({
                url:"<?php echo site_url('payment/pencarianbuku');?>",
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
		})
	</script>
	
</head>

<legend><?php echo $title;?></legend>
<div class="form-horizontal" />
    <?php echo validation_errors(); echo $message;?>
	<h4>Early Deposit</h4>
	<hr>
    <div class="form-group">
           <label class="col-lg-2 control-label">Check In ID</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" >
                    </div>
					<div class="col-lg-2">
                        <a href="#" class="btn btn-primary" id="searchBTN"><i class="glyphicon glyphicon-search"></i></a>
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
	  <div class="form-group">
        <label class="col-lg-2 control-label">Account Type</label>
        <div class="col-lg-5">
                        <input type="text" id="tipeAkun" name="roomid" class="form-control" > 
						
                    </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Payment Type</label>
        < <div class="col-lg-5">
                        <input type="text" id="tipePembayaran" name="roomid" class="form-control" > 
						
                    </div>
    </div>
	  <div class="form-group">
                    <label class="col-lg-2 control-label">Credit Card</label>
                    <div class="col-lg-5">
                        <input type="text" id="noCredit" name="tglreservasi" class="form-control" > 
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
		
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Discount</label>
        <div class="col-lg-5">
            <input type="text" name="disc_value" id="disc_value" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">After Discount</label>
        <div class="col-lg-5">
            <input type="text" name="tglcheckout" id="afterDiscount" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Early Deposit</label>
        <div class="col-lg-5">
            <input type="text" name="tglcheckout" id="earlyDeposit" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Change</label>
        <div class="col-lg-5">
            <input type="text" name="tglcheckout" id="changeValue" class="form-control">
        </div>
    </div>
	<br>
	<h4>Additional Usage</h4>
	<hr>
	<div class="form-group">
        <label class="col-lg-2 control-label">Laundry Usage</label>
        <div class="col-lg-5">
            <input type="text" value="" name="tglcheckout" id="LaundryUsage" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Restaurant Usage</label>
        <div class="col-lg-5">
            <input type="text" value="" name="tglcheckout" id="RestaurantUsage" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Total Additional Usage</label>
        <div class="col-lg-5">
            <input type="text" name="tglcheckout" id="TotalUsage" class="form-control">
        </div>
    </div>
	<br>
	<h4>Grandtotal</h4>
	<hr>
	<div class="form-group">
        <label class="col-lg-2 control-label">Total Amount to be Paid</label>
        <div class="col-lg-5">
            <input type="text" name="tglcheckout" id="TATBP" class="form-control">
        </div>
    </div>
		<div class="form-group">
        <label class="col-lg-2 control-label">Paid</label>
        <div class="col-lg-5">
            <input type="text" name="tglcheckout" id="PAID" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Exchange</label>
        <div class="col-lg-5">
            <input type="text" name="tglcheckout" id="Exchange" class="form-control">
        </div>
    </div>
	<?php echo form_open("payment/SubmitData");?>
    <div class="form-group well">
	<input type="hidden" name="tanggal" id="tanggal"/>
	<input type="hidden" name="checkinID" id="checkinID" />
	<input type="hidden" name="exchange" id="exchange" />
	<input type="hidden" name="id_kamar" id="id_kamar" />
        <button name="buttonSubmit" id="buttonSubmit" class="btn btn-primary" value="true"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
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
                    <h4 class="modal-title">Search Room
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
                <td>Reservation ID</td>
                <td>Name </td>
                <td>Check in Date</td>
				  <td>Check Out Date</td>
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
            <td><a href="#" class="tambah" 
			no="<?php echo $tmp->id_reservasi;?>"
            checkinId = "<?php echo $tmp->id_checkin;?>"
            customerName="<?php echo $tmp->nama_reservasi;?>"
			checkinDate="<?php echo $tmp->tgl_checkin;?>"
			checkoutDate="<?php echo $tmp->tgl_checkout;?>"
			roomId="<?php echo $tmp->id_kamar;?>"
			accountType="<?php echo $tmp->akun_bayar?>"
			paymentType="<?php echo $tmp->jenis_pembayaran?>"
			creditCard="<?php echo $tmp->no_debit?>"
			Amount="<?php echo $tmp->jumlah?>"
			promo="<?php echo $tmp->nama_promo?>"
			discount="<?php echo $tmp->disc_value?>"
			earlyDeposit="<?php echo $tmp->terbayar?>"
			change="<?php echo $tmp->sisa?>"
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
			
