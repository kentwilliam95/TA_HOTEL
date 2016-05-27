<legend>Master Promo</legend>
<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('promo/cari');?>" method="post">
        <div class="form-group">
            <label>Search Promo :</label>
            <input type="text" class="form-control" placeholder="nama customer" name="cari">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Search</button>
    </form>
</div>
<a href="<?php echo site_url('promo/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> New</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>Promo ID</td>
            <td>Promo Name</td>
			<td>Start Date</td>
			<td>End Date</td>
			<td>Discount Value</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($promo as $row ): $no++;?>
    <tr>
        <td><?php echo $row->id_promo;?></td>
        <td><?php echo $row->nama_promo;?></td>
		<td><?php echo $row->tglawal_promo;?></td>
		<td><?php echo $row->tglakhir_promo;?></td>
		<td><?php echo $row->disc_value;?></td>
        <td><a href="<?php echo site_url('promo/edit/'.$row->id_promo);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
        <td><a href="#" class="hapus" kode="<?php echo $row->id_promo;?>"><i class="glyphicon glyphicon-trash"></i></a></td>
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
                url:"<?php echo site_url('promo/hapus');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('promo/index/delete_success');?>";
                }
            });
        });
    });
    
</script>