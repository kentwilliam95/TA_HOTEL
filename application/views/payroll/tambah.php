<script>
    $(function(){
        

        
        $("#cari").click(function(){
            $("#myModal2").modal("show");
			
        })
       
        $(".tambah").live("click",function(){
            var kode=$(this).attr("idpegawai");
           
     
            
            $("#idpegawai").val(kode);
            
	
            
            $("#myModal2").modal("hide");
        })
		   
      $("#overtime").change(function(){
		  var temp =parseInt($("#overtime").val());
		  $("#overtime1").val(temp);
		  temp = temp+ parseInt($("#gajipokok").val())+ parseInt($("#bonus").val())- parseInt($("#substraction").val());
		  $("#totalgaji").val(temp);
		  $("#totalgaji1").val(temp);
	  });
        
    })
	

</script>
<legend><?php echo $title;?></legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
	  
				 <div class="form-group">
           <label class="col-lg-2 control-label">Salary Date</label>
                    <div class="col-lg-5">
                       <input type="text" id="tglpenggajian" name="tglpenggajian" class="form-control" value="<?php echo $tgl_penggajian;?>" readonly="readonly">
                    </div>
                </div>  
			<div class="form-group">
           <label class="col-lg-2 control-label">Employee ID</label>
                    <div class="col-lg-5">
                        <input type="text" id="idpegawai" name="idpegawai" class="form-control" >
                    </div>
					<div class="col-lg-2">
                        <a href="#" class="btn btn-primary" id="cari"><i class="glyphicon glyphicon-search"></i></a>
                    </div>
                </div>  
    		 <div class="form-group">
           <label class="col-lg-2 control-label">Basic Salary</label>
                    <div class="col-lg-5">
                        <input type="text" id="gajipokok" name="gajipokok" class="form-control"  >
                    </div>
                </div>   
   		 <div class="form-group">
           <label class="col-lg-2 control-label">Bonus</label>
                    <div class="col-lg-5">
                        <input type="text" id="bonus" name="bonus" class="form-control">
                    </div>
                </div>  
		<div class="form-group">
           <label class="col-lg-2 control-label">Substraction</label>
                    <div class="col-lg-5">
                        <input type="text" id="substraction" name="substraction" class="form-control">
                    </div>
                </div> 
		<div class="form-group">
           <label class="col-lg-2 control-label">Substraction Desc</label>
                    <div class="col-lg-5">
                        <input type="text" id="description" name="description" class="form-control">
                    </div>
                </div> 
				<div class="form-group">
           <label class="col-lg-2 control-label">Overtime</label>
                    <div class="col-lg-5">
                        <input type="text" id="overtime" name="overtime" class="form-control">
                    </div>
                </div> 
				<div class="form-group">
           <label class="col-lg-2 control-label">Total</label>
                    <div class="col-lg-5">
                        <input type="text" id="totalgaji" name="totalgaji" class="form-control">
                    </div>
                </div> 
	 <?php echo form_open("payroll/simpan");?>
	<input type="hidden" name="overtime" id="overtime1"></input>
	<input type="hidden" name="totalgaji" id="totalgaji1"></input>
	
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('payroll');?>" class="btn btn-default">Kembali</a>
    </div>
</form>
<!-- Modal -->
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Search Employee
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
                <td>Employee ID</td>
                <td>Name </td>
                <td>JobDesc</td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($kategori as $tmp):?>
        <tr>
            <td><?php echo $tmp->id_pegawai;?></td>
            <td><?php echo $tmp->nama_pegawai;?></td>
            <td><?php echo $tmp->jabatan_pegawai;?></td>
			
            <td><a href="#" class="tambah" idpegawai="<?php echo $tmp->id_pegawai;?>"
            
           
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