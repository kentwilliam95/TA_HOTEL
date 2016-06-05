<legend><?php echo $title;?></legend>
<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('kategoriinventaris/cari');?>" method="post">
        <div class="form-group">
           
        </div>

    </form>
</div>
<a href="<?php echo site_url('categoryexpenses/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> New</a>
<hr>

<Table class="table table-striped">
    <thead>
        <tr>
            <td>Category ID</td>
            <td>Category Name</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($categoryexpenses as $row ): $no++;?>
    <tr>
      
       
        <td><?php echo $row->id_kategoripengeluaran;?></td>
        <td><?php echo $row->nama_kategoripengeluaran;?></td>
        
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
                url:"<?php echo site_url('kategoriinventaris/hapus');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('kategoriinventaris/index/delete_success');?>";
                }
            });
        });
    });
    
</script>