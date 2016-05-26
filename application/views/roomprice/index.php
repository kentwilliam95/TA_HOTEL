<legend><?php echo $title;?></legend>
<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('roomprice/cari');?>" method="post">
        
    </form>
</div>
<a href="<?php echo site_url('roomprice/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> New</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>Room Type</td>
			<td>Start Date</td>
			<td>End Date</td>
			<td>Transit</td>
			<td>Weekday</td>
			<td>Weekend</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($roomprice as $row ): $no++;?>
    <tr>
		<td><?php echo $row->id_tipekamar;?></td>
        <td><?php echo $row->tgl_awalharga;?></td>
		<td><?php echo $row->tgl_akhirharga;?></td>
		<td>Rp.<?php echo $row->transit;?>,-</td>
		<td>Rp.<?php echo $row->weekday;?>,-</td>
		<td>Rp.<?php echo $row->weekend;?>,-</td>
        <td><a href="<?php echo site_url('roomprice/edit/'.$row->id_price);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
        <td><a href="#" class="hapus" kode="<?php echo $row->id_price;?>"><i class="glyphicon glyphicon-trash"></i></a></td>
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
                url:"<?php echo site_url('roomprice/hapus');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('roomprice/index/delete_success');?>";
                }
            });
        });
    });
</script>