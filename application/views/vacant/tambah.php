<script>
    $(function(){
             $("#no").keypress(function(){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            
            if(keycode == '56'){
                var no=$("#no").val();
                
                $.ajax({
                    url:"<?php echo site_url('statuskamar/cari_by_nis');?>",
                    type:"POST",
                    data:"no="+no,
                    cache:false,
                    success:function(msg){
                        if (msg=="") {
                            alert("data tidak ditemukan");
                        }else{
                            data=msg.split("|");
                            $("#nis").val(data[0]);
                            $("#pinjam").val(data[1]);
                            $("#kembali").val(data[2]);
                            $("#nama").val(data[3]);
                            
                            $("#denda").attr("disabled",false);
                            $("#denda").focus();
                            
                            $("#tampil").load("<?php echo site_url('statuskamar/tampil');?>","no="+no);    
                        }
                    }
                })
            }
        })
        
        $("#simpan").click(function(){
            var no=$("#no").val();
            var nis=$("#nis").val();
            var denda=$("#denda").val();
            var nominal=parseInt($("#nominal").val());
            var no=$("#no").val();
            
            if (no=="" || nis=="") {
                alert("Pilih ID Transaksi");
                $("#no").focus();
                return false;
            }
            else if (denda=="Y") {
                if (nominal=="") {
                    alert ("Masukkan Nominal Denda");
                    $("#nominal").focus();
                    return false;
                }else{
                    $.ajax({
                        url:"<?php echo site_url('statuskamar/simpan');?>",
                        type:"POST",
                        data:"no="+no+"&denda="+denda+"&nominal="+nominal,
                        cache:false,
                        success:function(html){
                            alert("Data Berhasil disimpan");
                            location.reload();
                        }
                    })
                }
            }else{
                $.ajax({
                    url:"<?php echo site_url('statuskamar/simpan');?>",
                    type:"POST",
                    data:"no="+no+"&denda="+denda+"&nominal="+nominal,
                    cache:false,
                    success:function(html){
                        alert("Data Berhasil disimpan");
                        location.reload();
                    }
                })
            }
        })
        
        $("#cari").click(function(){
            $("#myModal2").modal("show");
        })
        
        $("#carinis").keyup(function(){
            var nis=$("#carinis").val();
            
            $.ajax({
                url:"<?php echo site_url('statuskamar/cari_by_nis');?>",
                type:"POST",
                data:"nis="+nis,
                cache:false,
                success:function(html){
                    $("#tampilnis").html(html);
                }
            })
        })

        $(".tambahkan").live("click",function(){
            var no=$(this).attr("no");
            
            $("#no").val(no);
            $("#myModal2").modal("hide");
            $("#no").focus();
        })
    })
</script>
	<legend><?php echo $title;?></legend>
  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
                <div class="form-group">
                    <label class="col-lg-2 control-label">ID Kamar</label>
                    <div class="col-lg-5">
                        <input type="text" name="no" id="no" class="form-control">
                    </div>
                    
                    <div class="col-lg-2">
                        <a href="#" class="btn btn-primary" id="cari"><i class="glyphicon glyphicon-search"></i></a>
                    </div>
					<br>
					<br>
					
					<br>
                
	<div class="form-group">
        <label class="col-lg-2 control-label">Tanggal Awal</label>
        <div class="col-lg-5">
            <input type="text" name="tglawal" id="tanggal" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Tanggal Akhir</label>
        <div class="col-lg-5">
            <input type="text" name="tglakhir" id="tanggal2" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Status</label>
        <div class="col-lg-7">
       <select name="statuskamar" class="form-control" id="statuskamar">
                            <option value="Occupied">Occupied</option>
							<option value="Occupied Clean">Occupied Clean</option>
							<option value="Occupied Dirty">Occupied Dirty</option>
						    <option value="Vacant Clean">Vacant Clean</option>
						    <option value="Vacant Ready">Vacant Ready</option>
							<option value="Vacant Dirty">Vacant Dirty</option>
							<option value="Out Of Order">Out of Order</option>
							<option value="Blocked">Blocked</option>
                            
                        </select>
        </div>
    </div>
           
   
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('kamar');?>" class="btn btn-default">Kembali</a>
    </div>
</form>



 <!-- Modal -->
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Data Kamar</h4>
                  </div>
                  <div class="modal-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-lg-5">Cari Kamar</label>
                                <div class="col-lg-5">
                                    <input type="text" id="carinis" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <div id="tampilnis"></div>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->