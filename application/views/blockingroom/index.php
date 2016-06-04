<script>
    $(function(){
        
        function loadData(args) {
            //code
            $("#tampil").load("<?php echo site_url('checkin/tampil');?>");
			kosong();
        }
        loadData();
        
        function kosong(args) {
            //code
            $("#kode").val('');
            $("#judul").val('');
            $("#pengarang").val('');
        }
        
      
         $("#tambah").click(function(){
			var no=$("#no").val();
            var tglcheckin=$("#tanggal").val();
			var tglcheckout=$("#tanggal2").val();
			var tglreservasi=$("#tglreservasi").val();
			var namareservasi=$("#namareservasi").val();
            var jumlah=$("#jumlah").val();
			var tipekamar=$("#tipekamar").val();
			var tipebed=$("#tipebed").val();
            
           if (no=="") {
                //code
                alert("Kode Buku Masih Kosong");
                return false;
            }else if (namareservasi=="") {
                //code
                alert("Data tidak ditemukan");
                return false
            }else{
                $.ajax({
                    url:"<?php echo site_url('checkin/tambah');?>",
                    type:"POST",
                    data:"no="+no+"&tglcheckin="+tglcheckin+"&tglcheckout="+tglcheckout+"&tglreservasi="+tglreservasi+"&namareservasi="+namareservasi+"&jumlah="+jumlah+"&tipekamar="+tipekamar+"&tipebed="+tipebed,
                    cache:false,
                    success:function(html){
                        loadData();
                        kosong();
                    }
                })    
            }
  
        })
        
       
        $(".hapus").live("click",function(){
            var kode=$(this).attr("idmenu");
            
            $.ajax({
                url:"<?php echo site_url('checkin/hapus');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    loadData();
                }
            });
        });
        
        $("#cari").click(function(){
            $("#myModal2").modal("show");
        })
         
        $("#cari2").click(function(){
            $("#myModal3").modal("show");
        })
         $("#cari23").click(function(){
            var cari22=$("#cari22").val();
            
            $.ajax({
                url:"<?php echo site_url('blockingroom/pencarianbuku');?>",
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
        
       $(".tambah").live("click",function(){
            var kode=$(this).attr("no");
            var judul=$(this).attr("tglreservasi");
			var judul2=$(this).attr("tglcheckin");
			var judul3=$(this).attr("tglcheckout");
			var judul4=$(this).attr("jumlah");
			var judul5=$(this).attr("tipekamar");
			var judul6=$(this).attr("tipebed");
			var judul7=$(this).attr("namareservasi");
     
            $("#no").val(kode);
            $("#tglreservasi").val(judul);
			$("#tglcheckin").val(judul2);
			$("#tglcheckout").val(judul3);
			$("#jumlah").val(judul4);
			$("#tipekamar").val(judul5);
			$("#tipebed").val(judul6);
			$("#namareservasi").val(judul7);
			$("#id_useroom").val($(this).attr("id_useroom"));
            
            $("#myModal2").modal("hide");
        })
         $(".tambah2").live("click",function(){
            var kode=$(this).attr("carikamar");
     
            
            $("#carikamar").val(kode);
        
	
            
            $("#myModal3").modal("hide");
        })

        
    })
	function simpan()
	{
		
	}
</script>
<legend><?php echo $title;?></legend>
<?php echo form_open("blockingroom/simpan")?>
<div class="form-horizontal" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
	<input type="hidden" value="" name="id_useroom" id="id_useroom">				
	<h4>Search Reservation</h4>
	<hr>
	</hr>
    <div class="form-group">
           <label class="col-lg-2 control-label">Reservation ID</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" >
                    </div>
					<div class="col-lg-2">
                        <a href="#" class="btn btn-primary" id="cari"><i class="glyphicon glyphicon-search"></i></a>
                    </div>
                </div>  
	  <div class="form-group">
                    <label class="col-lg-2 control-label">Reservation Date</label>
                    <div class="col-lg-5">
                        <input type="text" id="tglreservasi" name="tglreservasi" class="form-control" >
                    </div>
                </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Customer Name</label>
        <div class="col-lg-5">
            <input type="text" name="namareservasi" id="namareservasi" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Guest</label>
        <div class="col-lg-5">
            <input type="text" name="jumlah" id="jumlah" class="form-control">
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
        <label class="col-lg-2 control-label">Room Type</label>
         <div class="col-lg-5">
            <input type="text" name="tipekamar" id="tipekamar" class="form-control">
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Bed Type</label>
        <div class="col-lg-5">
            <input type="text" name="tipebed" id="tipebed" class="form-control">
        </div>
    </div>
 
    <div class="form-group well">
       <button name ="Simpan1" value = "ButtonClicked" onclick="simpan()" class="btn btn-primary"><i  class="glyphicon glyphicon-hdd"></i> Save</button>
     
    </div>
</div>
<?php echo form_close()?>
<!-- Modal -->
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Search Guest
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
                <td>Customer Name</td>
                <td>Check in Date</td>
				<td>Check Out Date</td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($reserved as $tmp){?>
        <tr>
            <td><?php echo $tmp->id_reservasi;?></td>
            <td><?php echo $tmp->nama_reservasi;?></td>
            <td><?php echo $tmp->tgl_checkin;?></td>
			<td><?php echo $tmp->tgl_checkout;?></td>
			
            <td><a href="#" class="tambah" no="<?php echo $tmp->id_reservasi;?>"
            
            tglreservasi="<?php echo $tmp->tgl_reservasi;?>"
			tglcheckin="<?php echo $tmp->tgl_checkin;?>"
			tglcheckout="<?php echo $tmp->tgl_checkout;?>"
			namareservasi="<?php echo $tmp->nama_reservasi;?>"
			jumlah="<?php echo $tmp->passengers;?>"
			tipekamar="<?php echo $tmp->id_tipekamar;?>"
			tipebed="<?php echo $tmp->id_bed;?>"
			id_useroom="<?php echo $tmp->id_useroom;?>"
			>
			<i class="glyphicon glyphicon-plus "></i></a></td>
        </tr>
        <?php };?>
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
 
 