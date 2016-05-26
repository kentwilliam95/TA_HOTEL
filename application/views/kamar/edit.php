<script>
    $(function(){
             $("#no").keypress(function(){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            
            if(keycode == '56'){
                var no=$("#no").val();
                
                $.ajax({
                    url:"<?php echo site_url('kamar/cari_by_nis');?>",
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
                            
                            $("#tampil").load("<?php echo site_url('kamar/tampil');?>","no="+no);    
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
                        url:"<?php echo site_url('kamar/simpan');?>",
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
                    url:"<?php echo site_url('kamar/simpan');?>",
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
         $("#cari2").click(function(){
            $("#myModal3").modal("show");
        })
        $("#carinis").keyup(function(){
            var nis=$("#carinis").val();
            
            $.ajax({
                url:"<?php echo site_url('kamar/cari_by_nis');?>",
                type:"POST",
                data:"nis="+nis,
                cache:false,
                success:function(html){
                    $("#tampilnis").html(html);
                }
            })
        })

        $(".tambah").live("click",function(){
            var no=$(this).attr("no");
            
            $("#no").val(no);
            $("#myModal2").modal("hide");
            $("#no").focus();
        })
		$(".tambah2").live("click",function(){
            var pegawai2=$(this).attr("pegawai2");
            
            $("#pegawai2").val(pegawai2);
            $("#myModal3").modal("hide");
            $("#pegawai2").focus();
        })
    })
</script>
	<legend><?php echo $title;?></legend>
  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
	<div class="form-group">
        <label class="col-lg-2 control-label">Tipe Kamar</label>
        <div class="col-lg-7">
            <select name="idtipe" class="form-control" id="idtipe" value="<?php echo $kamar['id_tipekamar'];?>">
                            <?php foreach($tipekamar as $tipekamar):?>
                            <option value="<?php echo $tipekamar->nama_tipe;?>"><?php echo $tipekamar->nama_tipe;?></option>
                            <?php endforeach;?>
                        </select>
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Tipe Bed</label>
        <div class="col-lg-7">
      <select name="idbed" class="form-control" id="idbed" value="<?php echo $kamar['id_bed'];?>">
                            <?php foreach($anggota as $anggota):?>
                            <option value="<?php echo $anggota->nama_bed;?>"><?php echo $anggota->nama_bed;?></option>
                            <?php endforeach;?>
                        </select>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">ID Kamar</label>
        <div class="col-lg-5">
            <input type="text" name="idkamar" class="form-control" value="<?php echo $kamar['id_kamar'];?>" readonly="readonly">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">View Kamar</label>
        <div class="col-lg-5">
            <input type="text" name="viewkamar" class="form-control" value="<?php echo $kamar['view_kamar'];?>">
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Gambar</label>
        <div class="col-lg-5">
             <img src="<?php echo base_url('assets/img/'.$kamar['gambar_kamar']);?>" height="200px" width="200px">
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label"></label>
        <div class="col-lg-5">
            <input type="file" name="gambarkamar" class="form-control"value="<?php echo $kamar['gambar_kamar'];?>" >
        </div>
    </div>
    </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Pegawai</label>
                    <div class="col-lg-5">
                        <input type="text" name="no" id="no" class="form-control" value="<?php echo $kamar['id_pegawai'];?>">
                    </div>
                    
                    <div class="col-lg-2">
                        <a href="#" class="btn btn-primary" id="cari"><i class="glyphicon glyphicon-search"></i></a>
                    </div>
			<div>
			</div>
			<div>
			</div>
			 <label class="col-lg-2 control-label">Managed By</label>
                     <div class="col-lg-5">
						<input type="text" name="pegawai2" id="pegawai2" class="form-control" value="<?php echo $kamar['pegawai2'];?>" >
					</div>
                    
                    <div class="col-lg-2">
                        <a href="#" class="btn btn-primary" id="cari2"><i class="glyphicon glyphicon-search"></i></a>
                    </div>	
        
    </div>        
	    <br>
		<br>
	
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('kamar');?>" class="btn btn-default">Kembali</a>
		
</form>
<!-- Modal -->
            <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Data Pegawai</h4>
                  </div>
                  <div class="modal-body">
                        <div class="form-horizontal">
                            <table class="table table-striped">
        <thead>
            <tr>
                <td>ID Pegawai</td>
                <td>Nama Pegawai</td>
                <td>Jabatan</td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($pegawai2 as $tmp):?>
        <tr>
            <td><?php echo $tmp->id_pegawai;?></td>
            <td><?php echo $tmp->nama_pegawai;?></td>
            <td><?php echo $tmp->jabatan_pegawai;?></td>
			 <td><a href="#" class="tambah2" pegawai2="<?php echo $tmp->nama_pegawai;?>">
            <i class="glyphicon glyphicon-plus"></i>
        </a></td>
			</tr>
        <?php endforeach;?>
    </table>
                        </div>
                        
                        <div id="tampilnis"></div>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->



 <!-- Modal -->
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Data Pegawai</h4>
                  </div>
                  <div class="modal-body">
                        <div class="form-horizontal">
                            <table class="table table-striped">
        <thead>
            <tr>
                <td>ID Pegawai</td>
                <td>Nama Pegawai</td>
                <td>Jabatan</td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($pegawai as $tmp):?>
        <tr>
            <td><?php echo $tmp->id_pegawai;?></td>
            <td><?php echo $tmp->nama_pegawai;?></td>
            <td><?php echo $tmp->jabatan_pegawai;?></td>
			 <td><a href="#" class="tambah" no="<?php echo $tmp->nama_pegawai;?>">
            <i class="glyphicon glyphicon-plus"></i>
        </a></td>
			</tr>
        <?php endforeach;?>
    </table>
                        </div>
                        
                        <div id="tampilnis"></div>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->