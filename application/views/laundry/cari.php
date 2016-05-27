<legend><?php echo $title;?></legend>
<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('laundry/cari');?>" method="post">
        <div class="form-group">
            <label>Search Item</label>
            <input type="text" class="form-control" placeholder="Search" name="cari">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Search</button>
    </form>
</div>
<a href="<?php echo site_url('laundry/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Add</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
		    <td>Item ID</td>
            <td>Clothes Type</td>
			<td>Unit</td>
			<td>Kg/Pcs</td>
			<td>Price</td>
			<td>Laundry Type</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($laundry as $row ): $no++;?>
    <tr>
		<td><?php echo $row->id_laundry;?></td>
        <td><?php echo $row->nama_item;?></td>
        <td><?php echo $row->satuan;?></td>
		<td><?php echo $row->nama_satuan;?></td>
		<td>Rp.<?php echo $row->harga_laundry;?>,-</td>
	    <td><?php echo $row->keterangan;?></td>
        <td><a href="<?php echo site_url('laundry/edit/'.$row->id_laundry);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
        <td><a href="#" class="hapus" kode="<?php echo $row->id_laundry;?>"><i class="glyphicon glyphicon-trash"></i></a></td>
    </tr>
    <?php endforeach;?>
</Table>


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
                url:"<?php echo site_url('laundry/hapus');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('laundry/index/delete_success');?>";
                }
            });
        });
    });
</script>