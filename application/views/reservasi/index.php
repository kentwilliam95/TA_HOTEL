<legend>Room Reservation</legend>
<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('reservasi/cari');?>" method="post">
      
    </form>
</div>
<a href="<?php echo site_url('reservasi/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> New</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
		    <td>Reservation ID</td>
            <td>Reservation Date</td>
			<td>Check In Date</td>
			<td>Check Out Date</td>
			
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($reservasi as $row ): $no++;?>
    <tr>
		<td><?php echo $row->id_reservasi;?></td>
        <td><?php echo $row->tgl_reservasi;?></td>
        <td><?php echo $row->tgl_checkin;?></td>
		<td><?php echo $row->tgl_checkout;?></td>
		 <td><a href="<?php echo site_url('reservasi/detail_pinjam/'.$row->id_reservasi);?>">See Detail</a></td>
        <td><a href="<?php echo site_url('reservasi/edit/'.$row->id_reservasi);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
        <td><a href="#" class="hapus" kode="<?php echo $row->id_reservasi;?>"><i class="glyphicon glyphicon-trash"></i></a></td>
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
                url:"<?php echo site_url('reservasi/hapus');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('reservasi/index/delete_success');?>";
                }
            });
        });
    });
</script>