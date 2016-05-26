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
        
		var maxField=1;
         $(".panel").on("click",".addBtn",function(){
			maxField += 1;
			$('.asd').after($('<br><div class="form-inline"><div class="form-group"><label>Kode Menu</label>&nbsp;<input type="text" class="form-control Codes" placeholder="Kode Menu" id="idmenu'+maxField+'"></div><div class="form-group"><label class="sr-only">Nama Menu</label>&nbsp;<input type="text" class="form-control MenuNames" placeholder="Nama Menu" id="namamenu'+maxField+'"></div><div class="form-group"><label class="sr-only">Pengarang</label>&nbsp;<button id="tambah" class="btn btn-primary addBtn"><i class="glyphicon glyphicon-plus"></i></button></div><div class="form-group"><label class="sr-only">Pengarang</label>&nbsp;<button id="cari" value='+maxField+' class="btn btn-default srcBtn"><i class="glyphicon glyphicon-search"></i></button></div></div>'));
        })
        var selectedIndex = 0;
		$(".panel").on("click",".srcBtn",function()
		{
			//alert($(this).val());
			selectedIndex = $(this).val();
			 $("#myModal2").modal("show");
		});
		
		$("#carimenu2").click(function(){
			 var carimenu=$("#carimenu").val();
			 //alert(carimenu);
			 $("#myModal3").modal("show");
        })
        $("#simpan").click(function()
		{
			var arr=[];
			$('.MenuNames').each(function(i)
			{
				arr[i] = $(this).val();
			});
			//alert(arr);
			$("#MenuNamesInput").val(arr);
			arr=[];
			$('.Codes').each(function(i)
			{
				arr[i] = $(this).val();
			});
			//alert(arr);
			$("#CodesInput").val(arr);
			
			$("#idh").val($("#nomer").val());
			$("#tglh").val($("#tglsajian").val());
			$("#kategorih").val($("#idkategorifb").val());
			$("#chefh").val($("#rid").val());
			$("#statush").val($("#status").val());
			alert($("#rid").val());
			//alert($("#idh").val()+","+$("#tglh").val()+","+$("#kategorih").val()+","+$("#chefh").val()+","+$("#statush").val());
			//alert($("#CodesInput").val());
			//alert($("#MenuNamesInput").val());
		});
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
     
            //alert("#idmenu"+selectedIndex);
            $("#idmenu"+selectedIndex).val(kode);
            $("#namamenu"+selectedIndex).val(judul);
	
            
            $("#myModal2").modal("hide");
        })
        
    })
</script>

<legend><?php echo $title;?></legend>
<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-horizontal" action="<?php echo site_url('restaurant/simpan');?>" method="post">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-lg-4 control-label">ID</label>
                    <div class="col-lg-7">
                        <input type="text" id="nomer" name="nomer" class="form-control" value="<?php echo $noauto;?>" readonly="readonly">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-lg-4 control-label">Tgl Penyajian</label>
                    <div class="col-lg-7">
                        <input type="text" id="tglsajian" name="tglsajian" class="form-control" value="<?php echo $tglsajian;?>" readonly="readonly">
                    </div>
                </div>
                
               
          
            </div>
        </form>
    </div>
</div>

<div class="panel panel-success">
    <div class="panel-heading">
        Daftar Menu
    </div>
	<br>
	
    <div class="form-group">
        <label class="col-lg-2 control-label">Chef</label>
        <div class="col-lg-5">
            <select name="idchef" class="form-control" id="idchef">
                            <?php foreach($chef as $chef):?>
                            <option id="rid" value="<?php echo $chef->id_chef;?>"><?php echo $chef->nama_chef;?></option>
                            <?php endforeach;?>
                        </select>
        </div>
    </div>
	<br>
	<br>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Kategori</label>
        <div class="col-lg-5">
      <select name="idkategorifb" class="form-control" id="idkategorifb">
                            <?php foreach($kategorifb as $kategorifb):?>
                            <option value="<?php echo $kategorifb->nama_kategorifb;?>"><?php echo $kategorifb->nama_kategorifb;?></option>
                            <?php endforeach;?>
                        </select>
        </div>
    </div>
	<br>
	<br>
	<div class="form-group">
        <label class="col-lg-2 control-label">Status</label>
        <div class="col-lg-5">
       <select name="status" class="form-control" id="status">
                            <option>Qualified</option>
							 <option>Not Yet Qualified</option>
       </select>
        </div>
    </div>
    <div class="panel-body daftarmenu">
        <div class="asd form-inline">
		<br>
		<br>
		<label>Daftar Menu</label>
		<br>
		<br>
            <div class="form-group">
                <label>Kode Menu</label>
                <input type="text" class="form-control Codes" placeholder="Kode Menu" id="idmenu1">
            </div>
            <div class="form-group">
                <label class="sr-only">Nama Menu</label>
                <input type="text" class="form-control MenuNames" placeholder="Nama Menu" id="namamenu1">
            </div>
            <div class="form-group">
                <label class="sr-only">Pengarang</label>
                <button id="tambah1" class="btn btn-primary addBtn"><i class="glyphicon glyphicon-plus"></i></button>
            </div>
            <div class="form-group">
                <label class="sr-only">Pengarang</label>
                <button id="cari" value="1" class="srcBtn btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
    </div>
    
    <div id="tampil"></div>
    <?php echo form_open("restaurant/insertTabel");?>
    <div class="panel-footer">
	<input name="CodesInput" type="hidden" id="CodesInput"></input>
	<input name="MenuNamesInput" type="hidden" id="MenuNamesInput"></input>
	
	<input name="chefh" type="hidden" id="chefh"></input>
	<input name="kategorih" type="hidden" id="kategorih"></input>
	<input name="statush" type="hidden" id="statush"></input>
	<input name="idh" type="hidden" id="idh"></input>
	<input name="tglh" type="hidden" id="tglh"></input>
	
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
                <td>Kode Menu</td>
                <td>Nama Menu</td>
                <td>Harga</td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($buku as $tmp):?>
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
                <td>Kode Menu</td>
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