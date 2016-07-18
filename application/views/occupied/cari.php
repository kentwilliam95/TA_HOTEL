<style>
	.peach
	{
		background-color:#ff99ff;
	}
	.colour1
	{
		background-color:#b3b3ff;
	}
	.colour2
	{
		background-color: #ff8000;
	}
	.colour3
	{
		background-color: #DA70D6	;
	}
	.colour4
	{
		background-color: #ff8080	;
	}
	.colour5
	{
		background-color: #FFD700;
	}
	.colour6
	{
		background-color: #90EE90;
	}
	.colour8
	{
		background-color: #FFF8DC;
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
		<?php }else if($row->Status == "VACANT CLEAN"){?>
	<tr class="colour2">
		<td><?php echo $row->id_kamar;?></td>
        <td><?php echo $row->id_tipekamar;?></td>
		<td><?php echo $row->id_bed;?></td>
		<td><?php echo $row->Status;?></td>
        <td><a href="<?php echo site_url('occupied/edit/'.$row->id_kamar);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
    </tr>
	<?php }
	else if($row->Status == "OCCUPIED CLEAN"){?>
	<tr class="colour3">
		<td><?php echo $row->id_kamar;?></td>
        <td><?php echo $row->id_tipekamar;?></td>
		<td><?php echo $row->id_bed;?></td>
		<td><?php echo $row->Status;?></td>
        <td><a href="<?php echo site_url('occupied/edit/'.$row->id_kamar);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
    </tr>
	<?php }
	else if($row->Status == "OCCUPIED DIRTY"){?>
	<tr class="colour4">
		<td><?php echo $row->id_kamar;?></td>
        <td><?php echo $row->id_tipekamar;?></td>
		<td><?php echo $row->id_bed;?></td>
		<td><?php echo $row->Status;?></td>
        <td><a href="<?php echo site_url('occupied/edit/'.$row->id_kamar);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
    </tr>
	<?php }
	else if($row->Status == "OUT OF ORDER"){?>
	<tr class="colour5">
		<td><?php echo $row->id_kamar;?></td>
        <td><?php echo $row->id_tipekamar;?></td>
		<td><?php echo $row->id_bed;?></td>
		<td><?php echo $row->Status;?></td>
        <td><a href="<?php echo site_url('occupied/edit/'.$row->id_kamar);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
    </tr>
	<?php }
	else if($row->Status == "BLOCKED"){?>
	<tr class="colour6">
		<td><?php echo $row->id_kamar;?></td>
        <td><?php echo $row->id_tipekamar;?></td>
		<td><?php echo $row->id_bed;?></td>
		<td><?php echo $row->Status;?></td>
        <td><a href="<?php echo site_url('occupied/edit/'.$row->id_kamar);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
    </tr>
	<?php }else if($row->Status == "VACANT DIRTY"){?>
	<tr class="colour1">
		<td><?php echo $row->id_kamar;?></td>
        <td><?php echo $row->id_tipekamar;?></td>
		<td><?php echo $row->id_bed;?></td>
		<td><?php echo $row->Status;?></td>
        <td><a href="<?php echo site_url('occupied/edit/'.$row->id_kamar);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
    </tr>
    <?php }else if($row->Status == "VACANT READY"){?>
	<tr class="colour8">
		<td><?php echo $row->id_kamar;?></td>
        <td><?php echo $row->id_tipekamar;?></td>
		<td><?php echo $row->id_bed;?></td>
		<td><?php echo $row->Status;?></td>
        <td><a href="<?php echo site_url('occupied/edit/'.$row->id_kamar);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
    </tr>
	<?php }endforeach;?>
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