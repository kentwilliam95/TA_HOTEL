<script>
	$(document).ready(function(){
		/*$("#cari").click(function()
		{
			$("#myModal3").modal("show");
		})
		
		$("#cari2").click(function()
		{
			$("#myModal2").modal("show");
		})*/
	});
</script>
<legend>Add Room</legend>
  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
	<div class="form-group">
        <label class="col-lg-2 control-label">Room Type</label>
        <div class="col-lg-7">
            <select name="idtipe" class="form-control" id="idtipe">
                            <?php foreach($tipekamar as $tipekamar):?>
                            <option value="<?php echo $tipekamar->nama_tipe;?>"><?php echo $tipekamar->nama_tipe;?></option>
                            <?php endforeach;?>
                        </select>
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Bed Type</label>
        <div class="col-lg-7">
      <select name="idbed" class="form-control" id="idbed">
                            <?php foreach($anggota as $anggota):?>
                            <option value="<?php echo $anggota->nama_bed;?>"><?php echo $anggota->nama_bed;?></option>
                            <?php endforeach;?>
                        </select>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Room ID</label>
        <div class="col-lg-5">
            <input type="text" name="idkamar" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Room View</label>
        <div class="col-lg-5">
            <input type="text" name="viewkamar" class="form-control">
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Image</label>
        <div class="col-lg-5">
            <input type="file" name="gambar" class="form-control">
        </div>
		
    </div>
            
                
	        
   
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Save</button>
        <a href="<?php echo site_url('kamar');?>" class="btn btn-default">Back to Menu</a>
    </div>
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