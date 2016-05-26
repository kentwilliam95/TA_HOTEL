<legend><?php echo $title;?></legend>
<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('customer/cari');?>" method="post">
        <div class="form-group">
            <label>Cari Customer :</label>
            <input type="text" class="form-control" placeholder="nama customer" name="cari">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Cari</button>
    </form>
</div>
<a href="<?php echo site_url('customer/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>ID Customer</td>
            <td>Nama Customer</td>
			<td>Member</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($customer as $row ): $no++;?>
    <tr>
        <td><?php echo $row->id_customer;?></td>
        <td><?php echo $row->nama_customer;?></td>
		<td><?php echo $row->status_member;?></td>
		 <td><a href="<?php echo site_url('customer/detail_pinjam/'.$row->id_customer);?>">Lihat Detail</a></td>
        <td><a href="<?php echo site_url('customer/edit/'.$row->id_customer);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
        <td><a href="#" class="hapus" kode="<?php echo $row->id_customer;?>"><i class="glyphicon glyphicon-trash"></i></a></td>
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