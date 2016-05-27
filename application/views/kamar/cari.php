<style>
ul.tsc_pagination { margin:4px 0; padding:0px; height:100%; overflow:hidden; font:12px 'Tahoma'; list-style-type:none; }
ul.tsc_pagination li { float:left; margin:0px; padding:0px; margin-left:5px; }
ul.tsc_pagination li a { color:black; display:block; text-decoration:none; padding:7px 10px 7px 10px; }
ul.tsc_paginationA li a { color:#FFFFFF; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; } 
ul.tsc_paginationA01 li a { color:#474747; border:solid 1px #B6B6B6; padding:6px 9px 6px 9px; background:#E6E6E6; background:-moz-linear-gradient(top, #FFFFFF 1px, #F3F3F3 1px, #E6E6E6); background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #FFFFFF), color-stop(0.02, #F3F3F3), color-stop(1, #E6E6E6)); }
ul.tsc_paginationA01 li:hover a,
ul.tsc_paginationA01 li.current a { background:#FFFFFF; }
</style>
<legend><?php echo $title;?></legend>
<div class="nav navbar-nav navbar-right">
	<form class="navbar-form navbar-left" role="search" action="<?php echo site_url('kamar/cari');?>" method="post">
        <div class="form-group">
            <label>Search Room ID</label>
            <input type="text" class="form-control" placeholder="Search" name="cari">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i>Search</button>
    </form>
</div>
<a href="<?php echo site_url('kamar/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> New</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>Room Type</td>
            <td>Bed Type</td>
			<td>Room ID</td>
			<td>Picture</td>
			
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($kamar as $row ): $no++;?>
    <tr>
        <td><?php echo $row->id_tipekamar;?></td>
        <td><?php echo $row->id_bed;?></td>
		<td><?php echo $row->id_kamar;?></td>
		<td><img src="<?php echo base_url('assets/img/'.$row->gambar_kamar);?>" height="50px" width="50px"></td>
		<td><a href="<?php echo site_url('kamar/detail_pinjam/'.$row->id_kamar);?>">See Detail</a></td>
		<td><a href="<?php echo site_url('kamar/addinventory/'.$row->id_kamar);?>">Add Inventory</a></td>
		<td><a href="<?php echo site_url('kamar/listinventory/'.$row->id_kamar);?>">List Inventory</a></td>
        <td><a href="<?php echo site_url('kamar/edit/'.$row->id_kamar);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
        <td><a href="#" class="hapus" kode="<?php echo $row->id_kamar;?>"><i class="glyphicon glyphicon-trash"></i></a></td>
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