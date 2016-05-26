<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('statuskamar/cari');?>" method="post">
        <div class="form-group">
            <label>Cari Kamar</label>
            <input type="text" class="form-control" placeholder="Search" name="cari">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Cari</button>
    </form>
</div>
<a href="<?php echo site_url('statuskamar/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
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
        <td><a href="<?php echo site_url('statuskamar/edit/'.$row->id_kamar);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
        
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