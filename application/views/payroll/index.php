
<legend><?php echo $title;?></legend>
<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('expenses/cari');?>" method="post">
        
    </form>
</div>
<a href="<?php echo site_url('payroll/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> New</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>Employee ID</td>
            <td>Employee Name</td>
			<td>Salary</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($payroll as $row ): $no++;?>
    <tr>
      
       
        <td><?php echo $row->id_pegawai;?></td>
        <td><?php echo $row->nama_pegawai;?></td>
		<td><?php echo $row->total_gaji;?></td>
    </tr>
    <?php endforeach;?>
</Table>
