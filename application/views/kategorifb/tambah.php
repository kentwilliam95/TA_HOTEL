<legend>Add Category</legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
		 <div class="form-group">
           <label class="col-lg-2 control-label">Category ID</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" value="<?php echo $noauto;?>" readonly="readonly">
                    </div>
                </div>   
    <div class="form-group">
        <label class="col-lg-2 control-label">Category Name</label>
        <div class="col-lg-5">
            <input type="text" name="namakategorifb" class="form-control">
        </div>
    </div>
    
   
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Save</button>
        <a href="<?php echo site_url('kategorifb');?>" class="btn btn-default">Back to Menu</a>
    </div>
</form>