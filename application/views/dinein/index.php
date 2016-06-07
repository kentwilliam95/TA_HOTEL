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
        
          $("#cari23").click(function(){
            var cari22=$("#cari22").val();
            
            $.ajax({
                url:"<?php echo site_url('dinein/pencarianbuku');?>",
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
            var kode=$(this).attr("idmenu");
            var judul=$(this).attr("namamenu");
			var judul2=$(this).attr("harga");
     
            
            $("#idmenu").val(kode);
            $("#namamenu").val(judul);
			$("#harga").val(judul2);
	
            
            $("#myModal2").modal("hide");
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
                <input type="text" class="form-control" placeholder="Kode Item" id="qty">
            </div>
			<br>
			<br>
            <div class="form-group">
                <label>Subtotal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" class="form-control" placeholder="Kode Item" id="subtotal">
            </div>
         
			   
        </div>
    </div>
    <div class="panel panel-success">
    <div class="panel-heading">
		Payment
    </div>
	
   
    <div class="panel-body">
        <div class="form-inline">
			<div class="form-group">
                <label>Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" class="form-control" placeholder="Item Name" id="namamenu" >
            </div>
			<br>
			<br>
		
            <div class="form-group">
			
                <label>Card No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" class="form-control" placeholder="Item ID" id="paymentamount">
            </div>
			 
			<br>
			<br>
            <div class="form-group">
                <label>Payment Amount &nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" class="form-control" placeholder="Item Name" id="namamenu" >
            </div>
			<br>
			<br>
			  <div class="form-group">
                <label>Change &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" class="form-control" placeholder="Price" id="harga" readonly="readonly">
            </div>
			<br>
			<br>
		
         
			   
        </div>
    </div>
	<?php echo form_open("dinein/simpan")?>
   <div class="panel-footer">

	<input type="hidden" value="" name="idMenu" id="idMenu" >
	<input type="hidden" value="" name="jumlah" id="jumlah" >
	<input type="hidden" value="" name="subtotal" id="subtotal1" >
    
   
		<button id="simpan" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Add</button>
        <button id="simpan" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Proceed</button>
		<button id="simpan" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Save</button>
    </div>
</div>




 <!-- Modal -->
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Cari Menu
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
                <td>ID Menu</td>
                <td>Nama Menu</td>
				<td>Harga</td>
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
                    <h4 class="modal-title">Cari Menu
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
                <td>Kode Item</td>
                <td>Nama Menu</td>
                <td>Harga</td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($menu as $tmp):?>
        <tr>
            <td><?php echo $tmp->id_menu;?></td>
            <td><?php echo $tmp->nama_menu;?></td>
            <td><?php echo $tmp->harga_menu;?></td>
            <td><a href="#" class="tambah" idmenu="<?php echo $tmp->id_menu;?>"
            
            namamenu="<?php echo $tmp->nama_menu;?>"><i class="glyphicon glyphicon-plus"></i></a></td>
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