<legend><?php echo $title;?></legend>
<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('chef/cari');?>" method="post">
        <div class="form-group">
            <label>Search Chef :</label>
            <input type="text" class="form-control" placeholder="Search" name="cari">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Search</button>
    </form>
</div>
<a href="<?php echo site_url('chef/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> New</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>Chef ID</td>
            <td>Chef Name</td>
		 <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($chef as $row ): $no++;?>
    <tr>
        <td><?php echo $row->id_chef;?></td>
        <td><?php echo $row->nama_chef;?></td>
		
		<td><a href="<?php echo site_url('chef/detail_pinjam/'.$row->id_chef);?>">See Details</a></td>
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
                url:"<?php echo site_url('chef/hapus');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('chef/index/delete_success');?>";
                }
            });
        });
    });
    
</script>