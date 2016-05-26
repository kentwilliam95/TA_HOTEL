<legend><?php echo $title;?></legend>
<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('menu/cari');?>" method="post">
        <div class="form-group">
            <label>Search Menu</label>
            <input type="text" class="form-control" placeholder="Search" name="cari">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Search</button>
    </form>
</div>
<a href="<?php echo site_url('menu/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> New</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>Menu ID</td>
            <td>Menu</td>
			   <td>Picture</td>
			      <td>Price</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($menu as $row ): $no++;?>
    <tr>
        <td><?php echo $row->id_menu;?></td>
        <td><?php echo $row->nama_menu;?></td>
		<td><img src="<?php echo base_url('assets/img/'.$row->gambar_menu);?>" height="50px" width="50px"></td>
		<td>Rp.<?php echo $row->harga_menu;?>,-</td>
        <td><a href="<?php echo site_url('menu/edit/'.$row->id_menu);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
        <td><a href="#" class="hapus" kode="<?php echo $row->id_menu;?>"><i class="glyphicon glyphicon-trash"></i></a></td>
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
                url:"<?php echo site_url('menu/hapus');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('menu/index/delete_success');?>";
                }
            });
        });
    });
    
</script>