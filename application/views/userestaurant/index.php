<script>
    $(function(){
        
        function loadData(args) {
            //code
            $("#tampil").load("<?php echo site_url('restaurant/tampil');?>");
			kosong();
        }
        loadData();
        
        function kosong(args) {
            //code
            $("#kode").val('');
            $("#judul").val('');
            $("#pengarang").val('');
        }
        
        $("#nis").click(function(){
            var nis=$("#nis").val();
            
            $.ajax({
                url:"<?php echo site_url('restaurant/cariAnggota');?>",
                type:"POST",
                data:"nis="+nis,
                cache:false,
                success:function(html){
                    $("#nama").val(html);
                }
            })
        })
        
      
         $("#tambah").click(function(){
			var nomer=$("#nomer").val();
            var idmenu=$("#idmenu").val();
			var tglsajian=$("#tglsajian").val();
			var namamenu=$("#namamenu").val();
			var idchef=$("#idchef").val();
            var idkategorifb=$("#idkategorifb").val();
			var status=$("#status").val();
            
           if (idmenu=="") {
                //code
                alert("Kode Buku Masih Kosong");
                return false;
            }else if (namamenu=="") {
                //code
                alert("Data tidak ditemukan");
                return false
            }else{
                $.ajax({
                    url:"<?php echo site_url('restaurant/tambah');?>",
                    type:"POST",
                    data:"idmenu="+idmenu+"&namamenu="+namamenu+"&idchef="+idchef+"&idkategorifb="+idkategorifb+"&status="+status+"&nomer="+nomer+"&tglsajian="+tglsajian,
                    cache:false,
                    success:function(html){
                        loadData();
                        kosong();
                    }
                })    
            }
  
        })
        
        $("#simpan").click(function(){
            var idmenu=$("#idmenu").val();
			var nomer=$("#nomer").val();
			var tglsajian=$("#tglsajian").val();
			var namamenu=$("#namamenu").val();
			var idchef=$("#idchef").val();
            var idkategorifb=$("#idkategorifb").val();
			var status=$("#status").val();
            
            if (idmenu=="") {
                alert("Pilih Nis Siswa");
                return false;
            }else{
                $.ajax({
                    url:"<?php echo site_url('restaurant/sukses');?>",
                    type:"POST",
                    data:"idmenu="+idmenu+"&namamenu="+namamenu+"&idchef="+idchef+"&idkategorifb="+idkategorifb+"&status="+status+"&nomer="+nomer+"&tglsajian="+tglsajian,
					cache:false,
                    success:function(html){
						alert(tglsajian);
                        alert("Transaksi restaurant berhasil");
                        location.reload();
                    }
                })
            }
        })
        
        $(".hapus").live("click",function(){
            var kode=$(this).attr("idmenu");
            
            $.ajax({
                url:"<?php echo site_url('restaurant/hapus');?>",
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
		$("#carimenu2").click(function(){
			 var carimenu=$("#carimenu").val();
			 alert(carimenu);
			 $("#myModal3").modal("show");
        })
        
        $("#caribuku").keyup(function(){
            var caribuku=$("#caribuku").val();
            
            $.ajax({
                url:"<?php echo site_url('restaurant/pencarianbuku');?>",
                type:"POST",
                data:"caribuku="+caribuku,
                cache:false,
                success:function(html){
                    $("#tampilbuku").html(html);
                }
            })
        })
        
        $(".tambah").live("click",function(){
            var kode=$(this).attr("idmenu");
            var judul=$(this).attr("namamenu");
			var judul2=$(this).attr("harga");
     
            
            $("#idmenu").val(kode);
            $("#namamenu").val(judul);
			$("#harga").val(judul2);
	
            
            $("#myModal2").modal("hide");
        })
		
		$("#cari2").click(function(){
            $("#myModal3").modal("show");
        })
		$(".tambah1").live("click",function(){
            var kode=$(this).attr("idmenu");

            $("#nomer").val(kode);
			$("#myModal3").modal("hide");
        })
		$("#qty").change(function()
		{
			var temp = parseInt($("#qty").val());
			temp = temp * parseInt($("#harga").val());
			$("#subtotal").val(temp);
		})
        $("#simpan").click(function(){
			$("#idCheckin").val($("#nomer").val());
			$("#idMenu").val($("#idmenu").val());
			$("#jumlah").val($("#qty").val());
			$("#subtotal1").val($("#subtotal").val());
			
		});
    })
</script>

<legend><?php echo $title;?></legend>
<div class="panel panel-default">
    <div class="panel-body">
      
               
                    <label class="col-lg-4 control-label">Checkin ID</label>
                    <div class="col-lg-5">
                        <input type="text" id="nomer" name="nomer" class="form-control" value="<?php echo $noauto;?>" readonly="readonly">
                  
					</div>
					<div class="col-lg-2">
                        <a href="#" class="btn btn-primary" id="cari2"><i class="glyphicon glyphicon-search"></i></a>
                    </div>
			<br>
                <br>
				<br>
			
                <div class="form-group">
                    <label class="col-lg-4 control-label">Services Date</label>
                    <div class="col-lg-5">
                        <input type="text" id="tglsajian" name="tglsajian" class="form-control" value="<?php echo $tglsajian;?>" >
                    </div>
					
                </div>
               
    </div>
</div>

<div class="panel panel-success">
    <div class="panel-heading">
        Restaurant Menu
    </div>
	
   
    <div class="panel-body">
        <div class="form-inline">
		
		
            <div class="form-group">
                <label>Menu ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" class="form-control" placeholder="Item ID" id="idmenu" readonly="readonly">
            </div>
			   <div class="form-group">
              
                <button id="cari" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
            </div>
			<br>
			<br>
            <div class="form-group">
                <label>Menu Name &nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" class="form-control" placeholder="Item Name" id="namamenu" readonly="readonly">
            </div>
			<br>
			<br>
			  <div class="form-group">
                <label>Price &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" class="form-control" placeholder="Price" id="harga" readonly="readonly">
            </div>
			<br>
			<br>
			<div class="form-group">
                <label>Qty &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" class="form-control" placeholder="jumlah" id="qty">
            </div>
			<br>
			<br>
            <div class="form-group">
                <label>Subtotal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input disabled="true" type="text" class="form-control" id="subtotal">
            </div>
         
			   
        </div>
    </div>
    
  
    <?php echo form_open("userestaurant/simpan")?>
    <div class="panel-footer">
	<input type="hidden" value="" name="idCheckin" id="idCheckin" >
	<input type="hidden" value="" name="idMenu" id="idMenu" >
	<input type="hidden" value="" name="jumlah" id="jumlah" >
	<input type="hidden" value="" name="subtotal" id="subtotal1" >
	
		<button id="simpan" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Save</button>
    </div>
	<?php echo form_close()?>
</div>




 <!-- Modal -->
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Search Menu
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
                <td>Menu ID</td>
                <td>Menu Name</td>
				<td>Price</td>
            </tr>
        </thead>
        <?php foreach($buku as $tmp):?>
        <tr>
            <td><?php echo $tmp->id_menu;?></td>
            <td><?php echo $tmp->nama_menu;?></td>
			  <td><?php echo $tmp->harga_menu;?></td>
            <td><a href="#" class="tambah" idmenu="<?php echo $tmp->id_menu;?>"
        
            namamenu="<?php echo $tmp->nama_menu;?>"  harga="<?php echo $tmp->harga_menu;?>"><i class="glyphicon glyphicon-plus"></i></a>
			
			</td>
			
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
                    <h4 class="modal-title">Search Room 
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
                <td>Check In ID</td>
				<td>Room Number</td>
                <td>Name</td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($idCheckin as $tmp):?>
        <tr>
            <td><?php echo $tmp->id_checkin;?></td>
			<td><?php echo $tmp->id_kamar;?></td>
			<td><?php echo $tmp->nama_reservasi;?></td>
            <td><a href="#" class="tambah1" idmenu="<?php echo $tmp->id_checkin;?>"><i class="glyphicon glyphicon-plus"></i></a></td>
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