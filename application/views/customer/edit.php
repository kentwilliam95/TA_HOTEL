<legend><?php echo $title;?></legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
	<div class="form-group">
        <label class="col-lg-2 control-label">ID Customer</label>
        <div class="col-lg-5">
            <input type="text" name="kode" class="form-control" value="<?php echo $customer['id_customer'];?>" readonly="readonly">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Nama Customer</label>
        <div class="col-lg-5">
            <input type="text" name="namacustomer" class="form-control" value="<?php echo $customer['nama_customer'];?>">
        </div>
    </div>
     <div class="form-group">
        <label class="col-lg-2 control-label">Alamat Customer</label>
        <div class="col-lg-5">
            <input type="text" name="alamatcustomer" class="form-control" value="<?php echo $customer['alamat_customer'];?>">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Tanggal Lahir</label>
        <div class="col-lg-5">
            <input type="text" name="ttl" id="tanggal" class="form-control" value="<?php echo $customer['ttl_customer'];?>">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Jenis Kelamin</label>
        <div class="col-lg-5">
       <select name="jkcustomer" class="form-control">
                <option value="<?php echo $customer['jk_customer'];?>"><?php echo $customer['jk_customer'];?></option>
				<option value="L">L</option>
                <option value="P">P</option>
            </select>
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Telepon Customer</label>
        <div class="col-lg-5">
            <input type="text" name="teleponcustomer" class="form-control" value="<?php echo $customer['telepon_customer'];?>">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Status Member</label>
        <div class="col-lg-5">
       <select name="statmember" class="form-control" id="statmember">
                            <option value="<?php echo $customer['status_member'];?>"><?php echo $customer['status_member'];?></option>
							<option value="Ya">Ya</option>
							<option value="Tidak">Tidak</option>
       </select>
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Nomor KTP</label>
        <div class="col-lg-5">
            <input type="text" name="ktpcustomer" class="form-control" value="<?php echo $customer['nomor_ktp'];?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">Pekerjaan</label>
        <div class="col-lg-5">
            <input type="text" name="pekerjaancustomer" class="form-control" value="<?php echo $customer['pekerjaan'];?>">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Status Nikah</label>
        <div class="col-lg-5">
       <select name="statnikahcustomer" class="form-control" id="statnikahcustomer">
                           <option value="<?php echo $customer['status_nikah'];?>"><?php echo $customer['status_nikah'];?></option>
						   <option value="Menikah">Menikah</option>
						   <option value="Belum Menikah">Belum Menikah</option>
       </select>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Company Customer</label>
        <div class="col-lg-5">
            <input type="text" name="companycustomer" class="form-control" value="<?php echo $customer['company_customer'];?>">
        </div>
    </div>
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('customer');?>" class="btn btn-default">Kembali</a>
    </div>
</form>