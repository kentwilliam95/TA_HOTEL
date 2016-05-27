<legend><?php echo $title;?></legend>
<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('kategorifb/cari');?>" method="post">
       
    </form>
</div>
<a href="<?php echo site_url('kategorifb/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> New</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>Category ID</td>
            <td>Category Name</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($kategorifb as $row ): $no++;?>
    <tr>
        <td><?php echo $row->id_kategorifb;?></td>
        <td><?php echo $row->nama_kategorifb;?></td>
        <td><a href="<?php echo site_url('kategorifb/edit/'.$row->id_kategorifb);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
        <td><a href="#" class="hapus" kode="<?php echo $row->id_kategorifb;?>"><i class="glyphicon glyphicon-trash"></i></a></td>
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