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
<legend>Add Customer</legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
	 <div class="form-group">
           <label class="col-lg-2 control-label">Check In ID</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" >
                    </div>
					<div class="col-lg-2">
                        <a href="#" class="btn btn-primary" id="cari"><i class="glyphicon glyphicon-search"></i></a>
                    </div>
                </div>   
    <div class="form-group">
        <label class="col-lg-2 control-label">Customer Name</label>
        <div class="col-lg-5">
            <input type="text" name="namacustomer" class="form-control">
        </div>
    </div>
     <div class="form-group">
        <label class="col-lg-2 control-label">Customer Address</label>
        <div class="col-lg-5">
            <input type="text" name="alamatcustomer" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">BirthDate</label>
        <div class="col-lg-5">
            <input type="text" name="ttl" id="tanggal" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Gender</label>
        <div class="col-lg-5">
       <select name="jkcustomer" class="form-control" id="jkcustomer">
                            <option>L</option>
							 <option>P</option>
       </select>
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Customer Phone</label>
        <div class="col-lg-5">
            <input type="text" name="teleponcustomer" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Status Member</label>
        <div class="col-lg-5">
       <select name="statmember" class="form-control" id="statmember">
                            <option>Ya</option>
							 <option>Tidak</option>
       </select>
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">ID Number</label>
        <div class="col-lg-5">
            <input type="text" name="ktpcustomer" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">Job</label>
        <div class="col-lg-5">
            <input type="text" name="pekerjaancustomer" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Status</label>
        <div class="col-lg-5">
       <select name="statnikahcustomer" class="form-control" id="statnikahcustomer">
                            <option>Married</option>
							 <option>Single</option>
       </select>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Company Customer</label>
        <div class="col-lg-5">
            <input type="text" name="companycustomer" class="form-control">
        </div>
    </div>
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Save</button>
        <a href="<?php echo site_url('customer');?>" class="btn btn-default">Back to Menu</a>
    </div>
	
</form>
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
                <td>Check In ID</td>
                <td>Guest </td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($reserved as $tmp):?>
        <tr>
            <td><?php echo $tmp->id_checkin;?></td>
            <td><?php echo $tmp->nama_reservasi;?></td>
            <td><a href="#" class="tambah" no="<?php echo $tmp->id_checkin;?>"
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