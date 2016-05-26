<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('chef/cari');?>" method="post">
        <div class="form-group">
            <label>Cari Chef :</label>
            <input type="text" class="form-control" placeholder="Search" name="cari">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Cari</button>
    </form>
</div>
<a href="<?php echo site_url('chef/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>ID Chef</td>
            <td>Nama Chef</td>
			<td>Alamat Chef</td>
			<td>Jenis Kelamin</td>
			<td>Telepon Chef</td>
			<td>TTL</td>
			<td>Skill</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($chef as $row ): $no++;?>
    <tr>
        <td><?php echo $row->id_chef;?></td>
        <td><?php echo $row->nama_chef;?></td>
		<td><?php echo $row->alamat_chef;?></td>
		<td><?php echo $row->jk_chef;?></td>
		<td><?php echo $row->telepon_chef;?></td>
		<td><?php echo $row->ttl_chef;?></td>
		<td><?php echo $row->skill_chef;?></td>
        <td><a href="<?php echo site_url('chef/edit/'.$row->id_chef);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
        <td><a href="#" class="hapus" kode="<?php echo $row->id_chef;?>"><i class="glyphicon glyphicon-trash"></i></a></td>
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
                url:"<?php echo site_url('customer/hapus');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('customer/index/delete_success');?>";
                }
            });
        });
    });
    
</script>