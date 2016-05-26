<legend><?php echo $title;?></legend>
<div class="nav navbar-nav navbar-right">
    <title>Vacant Room</title>
	<form class="navbar-form navbar-left" role="search" action="<?php echo site_url('vacant/cari');?>" method="post">
        <div class="form-group">
            <label>Cari Kamar</label>
            <input type="text" class="form-control" placeholder="Search" name="cari">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Cari</button>
    </form>
</div>
<a href="<?php echo site_url('vacant/standardvacant');?>" class="btn btn-primary"> Standard Room</a>
<a href="<?php echo site_url('vacant/superiorvacant');?>" class="btn btn-primary"> Superior Room</a>
<a href="<?php echo site_url('vacant/deluxevacant');?>" class="btn btn-primary"> Deluxe Room</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>ID Kamar</td>
            <td>Tanggal Awal</td>
			<td>Tanggal Akhir</td>
			<td>Status</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($statuskamar as $row ): $no++;?>
    <tr>
        <td><?php echo $row->id_kamar;?></td>
        <td><?php echo $row->tgl_statusawal;?></td>
		<td><?php echo $row->tgl_statusakhir;?></td>
		<td><?php echo $row->status;?></td>
        <td><a href="<?php echo site_url('vacant/edit/'.$row->id_kamar);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
        
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
                url:"<?php echo site_url('kamar/hapus');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('kamar/index/delete_success');?>";
                }
            });
        });
    });
</script>