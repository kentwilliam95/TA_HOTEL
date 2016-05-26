<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('kamar/cari');?>" method="post">
        <div class="form-group">
            <label>Cari Kamar</label>
            <input type="text" class="form-control" placeholder="Search" name="cari">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Cari</button>
    </form>
</div>
<a href="<?php echo site_url('kamar/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>Tipe Kamar</td>
            <td>Tipe Bed</td>
			<td>ID Kamar</td>
			<td>Gambar</td>
			
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($kamar as $row ): $no++;?>
    <tr>
        <td><?php echo $row->id_tipekamar;?></td>
        <td><?php echo $row->id_bed;?></td>
		<td><?php echo $row->id_kamar;?></td>
		<td><img src="<?php echo base_url('assets/img/'.$row->gambar_kamar);?>" height="50px" width="50px"></td>
		<td><a href="<?php echo site_url('kamar/detail_pinjam/'.$row->id_kamar);?>">Lihat Detail</a></td>
		<td><a href="<?php echo site_url('kamar/addinventory/'.$row->id_kamar);?>">Add Inventory</a></td>
		<td><a href="<?php echo site_url('kamar/listinventory/'.$row->id_kamar);?>">List Inventory</a></td>
        <td><a href="<?php echo site_url('kamar/edit/'.$row->id_kamar);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
        <td><a href="#" class="hapus" kode="<?php echo $row->id_kamar;?>"><i class="glyphicon glyphicon-trash"></i></a></td>
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



