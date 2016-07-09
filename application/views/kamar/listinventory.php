<legend><?php echo $title;?></legend>
<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('anggota/cari');?>" method="post">
       
       
    </form>
</div>

<Table class="table table-striped">
    <thead>
        <tr>
            <td>ID Item</td>
			<td>Nama Item</td>
            <td>Jumlah</td>
			
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($inventaris as $row ): $no++;?>
    <tr>
        <td><?php echo $row->id_item;?></td>
		<td><?php echo $row->nama_item;?></td>
        <td><?php echo $row->jumlah_item;?></td>

        <td><a href="#" class="hapus" kode="<?php echo $row->id_item;?>"><i class="glyphicon glyphicon-trash"></i></a></td>
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