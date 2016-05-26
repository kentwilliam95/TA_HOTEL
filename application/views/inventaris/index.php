<legend><?php echo $title;?></legend>
<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('inventaris/cari');?>" method="post">
        <div class="form-group">
            <label>Search Item</label>
            <input type="text" class="form-control" placeholder="Search" name="cari">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Search</button>
    </form>
</div>
<a href="<?php echo site_url('inventaris/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> New</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>Item ID</td>
			<td>Category</td>
            <td>Item Name</td>
			<td>Start Guarantee</td>
			<td>End Guarantee</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($inventaris as $row ): $no++;?>
    <tr>
        <td><?php echo $row->id_item;?></td>
		 <td><?php echo $row->id_kategoriinventaris;?></td>
        <td><?php echo $row->nama_item;?></td>
		<td><?php echo $row->start_guarantee;?></td>
		<td><?php echo $row->end_guarantee;?></td>
        <td><a href="<?php echo site_url('inventaris/edit/'.$row->id_item);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
        <td><a href="#" class="hapus" kode="<?php echo $row->id_item;?>"><i class="glyphicon glyphicon-trash"></i></a></td>
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
                url:"<?php echo site_url('inventaris/hapus');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('inventaris/index/delete_success');?>";
                }
            });
        });
    });
    
</script>