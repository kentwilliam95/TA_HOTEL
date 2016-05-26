<script>
    $(function(){
        
        function loadData(args) {
            //code
            $("#tampil").load("<?php echo site_url('kamar/tampil');?>");
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
                url:"<?php echo site_url('kamar/cariAnggota');?>",
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
                    url:"<?php echo site_url('kamar/tambah');?>",
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
        
       
        
        $(".hapus").live("click",function(){
            var kode=$(this).attr("idmenu");
            
            $.ajax({
                url:"<?php echo site_url('kamar/hapus');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    loadData();
                }
            });
        });
        var selectedSearch = 0;
        $(".panel").on("click",".srcBtn",function(){
			//alert($(this).val());
            selectedSearch = $(this).val();
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
                url:"<?php echo site_url('kamar/pencarianbuku');?>",
                type:"POST",
                data:"caribuku="+caribuku,
                cache:false,
                success:function(html){
                    $("#tampilbuku").html(html);
                }
            })
        })
        
        $(".tambah").live("click",function(){
            var kode=$(this).attr("iditem");
            var judul=$(this).attr("namaitem");
     
            //alert("#iditem"+selectedSearch);
            $("#iditem"+selectedSearch).val(kode);
            $("#namaitem"+selectedSearch).val(judul);
	
            
            $("#myModal2").modal("hide");
        })
		var maxField=1;
		
		$(".panel").on("click",".addBtn",function(i)
		{
			maxField += 1;
			$("#asdasdasd").after($('<br><br><div class="form-inline"><div class="form-group"><label>Kode Item</label><input type="text" class="form-control iditem" placeholder="Kode Menu" id="iditem'+maxField+'"></div><br><br><div class="form-group"><label>Nama Item</label><input type="text" class="form-control namaitem" placeholder="Nama Menu" id="namaitem'+maxField+'"></div><br><br><div class="form-group"><label>Jumlah</label><input type="text" class="form-control jumlahItem" placeholder="Jumlah" id="jumlah"></div><div class="form-group"><label class="sr-only">tambah</label><button id="tambah" class="btn btn-primary"><i class="glyphicon glyphicon-plus addBtn"></i></button></div><div class="form-group" id="asdasdasd"><div ><label class="sr-only">Pengarang</label><button value='+maxField+' id="cari" class="btn btn-default srcBtn"><i class="glyphicon glyphicon-search"></i></button></div></div></div>'));
		});
		
        $("#simpan").click(function()
		{
			var arr=[];
			$(".iditem").each(function(i)
			{
				arr[i] = $(this).val();
			});
			$("#kodeItem").val(arr);
			arr=[];
			$(".namaitem").each(function(i)
			{
				arr[i]=$(this).val();
			});
			$("#namaItem").val(arr);
			arr=[];
			$(".jumlahItem").each(function(i)
			{
				arr[i]=$(this).val();
			});
			$("#jumlahItem1").val(arr);
			arr=[];
			$("#idkamar").val($("#nomer").val());
			/*alert($("#kodeItem").val()+"|"+$("#namaItem").val()+"|"+$("#jumlahItem1").val());*/
		});
    })
</script>

<legend><?php echo $title;?></legend>
<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-horizontal" action="<?php echo site_url('restaurant/simpan');?>" method="post">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-lg-4 control-label">ID Kamar</label>
                    <div class="col-lg-7">
                        <input type="text" id="nomer" name="nomer" class="form-control" readonly="readonly" value='<?php echo $this->uri->segment(3);?>'></input>
                    </div>
                </div>
                
          
            </div>
        </form>
    </div>
</div>

<div class="panel panel-success">
    <div class="panel-heading">
        Tambah Inventaris
    </div>
	
   
    <div class="panel-body">
	<input type="hidden" id="hidVal"></input>
        <div class="form-inline">
            <div class="form-group">
                <label>Kode Item</label>
                <input type="text" class="form-control iditem" placeholder="Kode Menu" id="iditem1">
            </div>
			<br>
			<br>
            <div class="form-group">
                <label>Nama Item</label>
                <input type="text" class="form-control namaitem" placeholder="Nama Menu" id="namaitem1">
            </div>
			<br>
			<br>
			 <div class="form-group">
                <label>Jumlah</label>
                <input type="text" class="form-control jumlahItem" placeholder="Jumlah" id="jumlah1">
            </div>
            <div class="form-group">
                <label class="sr-only">tambah</label>
                <button id="tambah" class="btn btn-primary addBtn"><i class="glyphicon glyphicon-plus "></i></button>
            </div>
			<div class="form-group" id="asdasdasd">
				<div >
					<label class="sr-only">Pengarang</label>
					<button value="1" id="cari" class="btn btn-default srcBtn"><i class="glyphicon glyphicon-search"></i></button>
				</div>
			</div>
        </div>
    </div>
    
    <div id="tampil"></div>
    <?php echo form_open("kamar/tambahDatabase");?>
    <div class="panel-footer">
	<input type="hidden" name="arrki" id="kodeItem"></input>
	<input type="hidden" name="arrni" id="namaItem"></input>
	<input type="hidden" name="arrji" id="jumlahItem1"></input>
	<input type="hidden" name="idkamar" id="idkamar"></input>
        <button id="simpan" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
    </div>
	<?php echo form_close();?>
</div>


 <!-- Modal -->
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <td>Nama Item</td>
                <td>Start Guarantee</td>
				<td>End Guarantee</td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($inventory as $tmp):?>
        <tr>
            <td><?php echo $tmp->id_item;?></td>
            <td><?php echo $tmp->nama_item;?></td>
            <td><?php echo $tmp->start_guarantee;?></td>
			<td><?php echo $tmp->end_guarantee;?></td>
            <td><a href="#" class="tambah" iditem="<?php echo $tmp->id_item;?>"
            
            namaitem="<?php echo $tmp->nama_item;?>"><i class="glyphicon glyphicon-plus"></i></a></td>
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