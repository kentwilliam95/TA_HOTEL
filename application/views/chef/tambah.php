<legend>Add Chef</legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
	<div class="form-group">
           <label class="col-lg-2 control-label">Chef ID</label>
                    <div class="col-lg-5">
                        <input type="text" id="no" name="no" class="form-control" value="<?php echo $noauto;?>" readonly="readonly">
                    </div>
                </div>  
    <div class="form-group">
        <label class="col-lg-2 control-label">Chef Name</label>
        <div class="col-lg-5">
            <input type="text" name="namachef" class="form-control">
        </div>
    </div>
     <div class="form-group">
        <label class="col-lg-2 control-label">Address</label>
        <div class="col-lg-5">
            <input type="text" name="alamatchef" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Birthdate</label>
        <div class="col-lg-5">
            <input type="text" name="ttl" id="tanggal" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Gender</label>
        <div class="col-lg-5">
       <select name="jkchef" class="form-control" id="jkcustomer">
                            <option>L</option>
							 <option>P</option>
       </select>
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Phone</label>
        <div class="col-lg-5">
            <input type="text" name="teleponchef" class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Skill</label>
        <div class="col-lg-10">
            <textarea name="skillchef"></textarea>
        </div>
    </div>
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Save</button>
        <a href="<?php echo site_url('chef');?>" class="btn btn-default">Back to Menu</a>
    </div>
	
</form>