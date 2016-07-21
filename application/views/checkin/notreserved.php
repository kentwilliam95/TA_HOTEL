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
            
            $.ajax
			({
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
			var tipekamar1= $("#tipekamar").val();
			var tipebed1 = $("#tipebed").val();
			
			checkKamar(tipekamar1,tipebed1);
            $("#myModal2").modal("show");
        })
		function checkKamar(tipekamar1,tipebed1)
		{
			$.ajax({
                url:"<?php echo site_url('checkin/CariKamar')?>", 
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
            var kode=$(this).attr("carikamar");
     
            
            $("#carikamar").val(kode);
        
	
            
            $("#myModal2").modal("hide");
        })
        
    })
</script>
<legend><?php echo $title;?></legend>
<a href="<?php echo site_url('checkin/index');?>" class="btn btn-primary"> Reserved</a>
<a href="<?php echo site_url('checkin/notreserved');?>" class="btn btn-primary"> Not Reserved</a>
<br>
<br>
<?php echo form_open("checkin/simpan2")?>
<div class="form-horizontal" />
    <?php echo validation_errors(); echo $message;?>
		  <div class="form-group">
                    <label class="col-lg-2 control-label">Check In ID</label>
                    <div class="col-lg-5">
                        <input type="text" id="nomer" name="nomer" value="<?php echo $noauto;?>" readonly="readonly"class="form-control" >
                    </div>
                </div>
		    <div class="form-group">
                    <label class="col-lg-2 control-label">Check In Date</label>
                    <div class="col-lg-5">
                        <input type="text" id="tglsajian" name="tglsajian" value="<?php echo $tglsajian;?>" readonly="readonly"class="form-control" >
                    </div>
                </div>
	<br>			
	<h4>Reservation Info</h4>
	<hr>
	</hr>
  
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
                        <input type="text" id="tanggal" name="tglcheckin" class="form-control" >
                    </div>
                </div>
	   <div class="form-group">
                    <label class="col-lg-2 control-label">Check Out Date</label>
                    <div class="col-lg-5">
                        <input type="text" id="tanggal2" name="tglcheckout" class="form-control" >
                    </div>
                </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Room Type</label>
         <div class="col-lg-5">
            <select name="tipekamar" class="form-control" id="tipekamar">
                            <?php foreach($tipekamar as $tipekamar):?>
                            <option value="<?php echo $tipekamar->nama_tipe;?>"><?php echo $tipekamar->nama_tipe;?></option>
                            <?php endforeach;?>
                        </select>
        </div>
    </div>
	 
	 <div class="form-group">
        <label class="col-lg-2 control-label">Bed Type</label>
         <div class="col-lg-5">
            <select name="tipebed" class="form-control" id="tipebed">
                            <?php foreach($tipebed as $tipebed):?>
                            <option value="<?php echo $tipebed->nama_bed;?>"><?php echo $tipebed->nama_bed;?></option>
                            <?php endforeach;?>
                        </select>
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Room ID</label>
        <div class="col-lg-5">
            <input type="text" name="carikamar" id="carikamar" class="form-control">
        </div>
			<div class="col-lg-2">
                <a href="#" class="btn btn-primary" id="cari"><i class="glyphicon glyphicon-search"></i></a>
            </div>
    </div>
	
    <div class="form-group well">
        <button name="Simpan" class="btn btn-primary" value="asd"><i class="glyphicon glyphicon-hdd"></i> Save</button>
       
    </div>
</div>
<?php echo form_close()?>
 <!-- Modal -->
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <td>Room ID</td>
                <td>Room Type </td>
                <td>Bed Type</td>
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
 