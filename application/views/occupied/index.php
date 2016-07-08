<style>
	.peach
	{
		background-color: #FFE5B4;
	}
	.fallLeaf
	{
		background-color:#FFCBA4;
	}
	.colour1
	{
		background-color:#E2A76F;
	}
</style>

<legend><?php echo $title;?></legend>
<div class="nav navbar-nav navbar-right">
    <title>Occupied Room</title>
	<form class="navbar-form navbar-left" role="search" action="<?php echo site_url('occupied/cari');?>" method="post">
     <div class="form-group">
            <label>Search Room</label>
            <input type="text" class="form-control" placeholder="Search" name="cari">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Search</button>
    </form>
</div>
<?php echo $message;?>
<Table class="table">
    <thead>
        <tr>
            <td>Room ID</td>
            <td>Room Type</td>
			<td>Bed Type</td>
			<td>Status</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($statuskamar as $row ): $no++;
	if($row->Status== "OCCUPIED")
	{
	?>
    <tr class="peach">
        <td><?php echo $row->id_kamar;?></td>
        <td><?php echo $row->id_tipekamar;?></td>
		<td><?php echo $row->id_bed;?></td>
		<td><?php echo $row->Status;?></td>
        <td><a href="<?php echo site_url('occupied/edit/'.$row->id_kamar);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
    </tr>
	<?php }
	else if($row->Status == "VACANT READY"){?>
	<tr class="colour1">
		<td><?php echo $row->id_kamar;?></td>
        <td><?php echo $row->id_tipekamar;?></td>
		<td><?php echo $row->id_bed;?></td>
		<td><?php echo $row->Status;?></td>
        <td><a href="<?php echo site_url('occupied/edit/'.$row->id_kamar);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
    </tr>
	<?php }else if($row->Status == "VACANT DIRTY"){?>
	<tr class="fallLeaf">
        <td><?php echo $row->id_kamar;?></td>
        <td><?php echo $row->id_tipekamar;?></td>
		<td><?php echo $row->id_bed;?></td>
		<td><?php echo $row->Status;?></td>
        <td><a href="<?php echo site_url('occupied/edit/'.$row->id_kamar);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
    </tr>
	<?php }?>
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