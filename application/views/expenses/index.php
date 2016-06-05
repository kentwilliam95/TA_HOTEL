<legend><?php echo $title;?></legend>
<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('expenses/cari');?>" method="post">
        <div class="form-group">
            
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Search</button>
    </form>
</div>
<a href="<?php echo site_url('expenses/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> New</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>Category</td>
            <td>Date</td>
			  <td>Nominal</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($expenses as $row ): $no++;?>
    <tr>
      
       
        <td><?php echo $row->id_kategoripengeluaran;?></td>
        <td><?php echo $row->tanggal;?></td>
         <td><?php echo $row->nominal;?></td>
    </tr>
    <?php endforeach;?>
</Table>
<?php echo $pagination;?>

<script>
    $(function(){
        $(".hapus").click(function(){
            var kode=$(this).attr("kode");
            
            $("#idhapus").val(kode);
            $("#myModal").modal("show");
        });
        
        $("#konfirmasi").click(function(){
            var kode=$("#idhapus").val();
            
            $.ajax({
                url:"<?php echo site_url('kategorifb/hapus');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('kategorifb/index/delete_success');?>";
                }
            });
        });
    });
    
</script>