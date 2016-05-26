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
        
        $("#nis").click(function(){
            var nis=$("#nis").val();
            
            $.ajax({
                url:"<?php echo site_url('checkin/cariAnggota');?>",
                type:"POST",
                data:"nis="+nis,
                cache:false,
                success:function(html){
                    $("#nama").val(html);
                }
            })
        })
        
      
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
        
        $("#caribuku").keyup(function(){
            var caribuku=$("#caribuku").val();
            
            $.ajax({
                url:"<?php echo site_url('checkin/pencarianbuku');?>",
                type:"POST",
                data:"caribuku="+caribuku,
                cache:false,
                success:function(html){
                    $("#tampilbuku").html(html);
                }
            })
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
			var judul8=$(this).attr("idkamar");
     
            
            $("#no").val(kode);
            $("#tglreservasi").val(judul);
			$("#tglcheckin").val(judul2);
			$("#tglcheckout").val(judul3);
			$("#jumlah").val(judul4);
			$("#tipekamar").val(judul5);
			$("#tipebed").val(judul6);
			$("#namareservasi").val(judul7);
			$("#idkamar").val(judul8);
	
            
            $("#myModal2").modal("hide");
        })
        
    })
</script>
<legend><?php echo $title;?></legend>
<a href="<?php echo site_url('checkin/index');?>" class="btn btn-primary"> Reserved</a>
<a href="<?php echo site_url('checkin/notreserved');?>" class="btn btn-primary"> Not Reserved</a>
<br>
<br>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
		  <div class="form-group">
                    <label class="col-lg-2 control-label">ID Check In</label>
                    <div class="col-lg-5">
                        <input type="text" id="nomer" name="nomer" value="<?php echo $noauto;?>" readonly="readonly"class="form-control" >
                    </div>
                </div>
		    <div class="form-group">
                    <label class="col-lg-2 control-label">Tanggal</label>
                    <div class="col-lg-5">
                        <input type="text" id="tglsajian" name="tglsajian" value="<?php echo $tglsajian;?>" readonly="readonly"class="form-control" >
                    </div>
                </div>
	<br>			
	<h4>Reservasi</h4>
	<hr>
	</hr>
    <div class="form-group">
           <label class="col-lg-2 control-label">ID Reservasi</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" >
                    </div>
					<div class="col-lg-2">
                        <a href="#" class="btn btn-primary" id="cari"><i class="glyphicon glyphicon-search"></i></a>
                    </div>
                </div>  
	  <div class="form-group">
                    <label class="col-lg-2 control-label">Tgl Reservasi</label>
                    <div class="col-lg-5">
                        <input type="text" id="tglreservasi" name="tglreservasi" class="form-control" >
                    </div>
                </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Nama Customer</label>
        <div class="col-lg-5">
            <input type="text" name="namareservasi" id="namareservasi" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Jumlah</label>
        <div class="col-lg-5">
            <input type="text" name="jumlah" id="jumlah" class="form-control">
        </div>
    </div>
	  <div class="form-group">
                    <label class="col-lg-2 control-label">Tgl Reservasi</label>
                    <div class="col-lg-5">
                        <input type="text" id="tglcheckin" name="tglcheckin" class="form-control" >
                    </div>
                </div>
	   <div class="form-group">
                    <label class="col-lg-2 control-label">Tgl Reservasi</label>
                    <div class="col-lg-5">
                        <input type="text" id="tglcheckout" name="tglcheckin" class="form-control" >
                    </div>
                </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Tipe Kamar</label>
         <div class="col-lg-5">
            <input type="text" name="tipekamar" id="tipekamar" class="form-control">
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Tipe Bed</label>
        <div class="col-lg-5">
            <input type="text" name="tipebed" id="tipebed" class="form-control">
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">ID Kamar</label>
        <div class="col-lg-5">
            <input type="text" name="idkamar" id="idkamar" class="form-control">
        </div>
			<div class="col-lg-2">
                        <a href="#" class="btn btn-primary" id="cari"><i class="glyphicon glyphicon-search"></i></a>
                    </div>
    </div>
	
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('reservasi');?>" class="btn btn-default">Kembali</a>
    </div>
</form>
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
				<td>ID Kamar</td>
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
            
            tglreservasi="<?php echo $tmp->tgl_reservasi;?>"
			tglcheckin="<?php echo $tmp->tgl_checkin;?>"
			tglcheckout="<?php echo $tmp->tgl_checkout;?>"
			namareservasi="<?php echo $tmp->nama_reservasi;?>"
			jumlah="<?php echo $tmp->passengers;?>"
			tipekamar="<?php echo $tmp->id_tipekamar;?>"
			tipebed="<?php echo $tmp->id_bed;?>"
			idkamar="<?php echo $tmp->id_kamar;?>"
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
 