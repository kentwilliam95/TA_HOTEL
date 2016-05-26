<legend><?php echo $title;?></legend>
<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('expenses/cari');?>" method="post">
        <div class="form-group">
            <label>Search Category</label>
            <input type="text" class="form-control" placeholder="Search" name="cari">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Search</button>
    </form>
</div>
<a href="<?php echo site_url('expenses/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> New</a>
<hr>
<?php echo $message;?>


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
                url:"<?php echo site_url('kategorifb/hapus');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('kategorifb/index/delete_success');?>";
                }
            });
        });
    });
    
</script>