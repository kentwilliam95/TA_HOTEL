<div class="panel-group" id="accordion">
<?php if($tipe == 1 || $tipe == 5){?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-folder-close">
                                        </span> Master</a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <table class="table">
										<?php if($tipe != 5){?>
											 <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-bed text-primary"></span> Room
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-bed text-primary"></span> <a href="<?php echo site_url('anggota');?>">&nbsp;&nbsp;&nbsp;&nbsp;Bed Type</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('buku');?>">&nbsp;&nbsp;&nbsp;&nbsp;Room Type</a>
                                                </td>
                                            </tr>
											 <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('kamar');?>">&nbsp;&nbsp;&nbsp;&nbsp;Room</a>
                                                </td>
                                            </tr>
											<tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('roomprice');?>">&nbsp;&nbsp;&nbsp;&nbsp;Room Price</a>
                                                </td>
                                            </tr>
											<tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('promo');?>">&nbsp;&nbsp;&nbsp;&nbsp;Promo</a>
                                                </td>
                                            </tr>
											
											<tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-bed text-primary"></span> Employee
                                            </tr>
											<tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('pegawai');?>">&nbsp;&nbsp;&nbsp;&nbsp;Employee</a>
                                                </td>
                                            </tr>
											<tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-bed text-primary"></span> Facilities
                                            </tr>
											<tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-bed text-primary"></span> Laundry
                                            </tr>
											<tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('laundry');?>">&nbsp;&nbsp;&nbsp;&nbsp;Laundry Sets</a>
                                                </td>
                                            </tr>
										<?php }?>
                                           <?php if($tipe==1||$tipe == 5){?>
										   <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-bed text-primary"></span> Restaurant
												</td>
                                           </tr>
											<tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('chef');?>">&nbsp;&nbsp;&nbsp;&nbsp;Chef</a>
                                                </td>
                                            </tr>
										    <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('kategorifb');?>">&nbsp;&nbsp;&nbsp;&nbsp;Categories</a>
                                                </td>
                                            </tr>
											<tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('menu');?>">&nbsp;&nbsp;&nbsp;&nbsp;Menu</a>
                                                </td>
                                            </tr>
										   <?php }?>
										   <?php if($tipe != 5){?>
                                                <td>
                                                    <span class="glyphicon glyphicon-bed text-primary"></span> Inventory
                                            </tr>
											<tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('kategoriinventaris');?>">&nbsp;&nbsp;&nbsp;&nbsp;Categories</a>
                                                </td>
                                            </tr>
											<tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('inventaris');?>">&nbsp;&nbsp;&nbsp;&nbsp;Inventory</a>
                                                </td>
                                            </tr>
										   <?php }?>
                                        </table>
                                    </div>
                                </div>
                            </div>
<?php }?>
<?php if($tipe == 1 || $tipe == 2 || $tipe == 4){?>
				<div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive"><span class="glyphicon glyphicon-th">
                            </span> Reservation</a>
                        </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('reservasi');?>">&nbsp;&nbsp;&nbsp;&nbsp;Reservation</a>
                                                </td>
                                            </tr>
								 <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('pembatalanreservasi');?>">&nbsp;&nbsp;&nbsp; Cancelled Reservation</a>
                                                </td>
                                            </tr>
                                 <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('blockingroom');?>">&nbsp;&nbsp;&nbsp;&nbsp;Room Blocking</a>
                                                </td>
                                            </tr>
					
                            </table>
                        </div>
                    </div>
                </div>
<?php }?>


<?php if($tipe == 1 || $tipe == 2 || $tipe == 4){?>				
			<div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseZZ"><span class="glyphicon glyphicon-th">
                            </span> Check In</a>
                        </h4>
                    </div>
                    <div id="collapseZZ" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('checkin');?>">Reserved Customer</a>
                                                </td>
                                            </tr>
										
											 <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('depositoawal');?>">Early Deposit</a>
                                                </td>
                                            </tr>
														<tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('upgrade');?>">Upgrade Room</a>
                                                </td>
                                            </tr>
											    	<tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('changeroom');?>">Change Room</a>
                                                </td>
                                            </tr>
											
                            </table>
                        </div>
                    </div>
                </div>
<?php }?>

<?php if($tipe == 1 || $tipe == 2 || $tipe == 4){?>			
			<div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseZ"><span class="glyphicon glyphicon-th">
                            </span> Facilities Usage</a>
                        </h4>
                    </div>
                    <div id="collapseZ" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                              
											</tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-bed text-primary"></span> Restaurant
                                            </tr>
								 <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('userestaurant');?>">&nbsp;&nbsp;&nbsp; Services</a>
                                                </td>
                                            </tr>
											 <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('dinein');?>">&nbsp;&nbsp;&nbsp; Dine-in</a>
                                                </td>
                                            </tr>
												</tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-bed text-primary"></span> Laundry
                                            </tr>
                                 <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('uselaundry');?>">&nbsp;&nbsp;&nbsp; Laundry</a>
                                                </td>
                                            </tr>
                            </table>
                        </div>
                    </div>
             </div>
<?php }?>
<?php if($tipe == 1 || $tipe == 2 || $tipe == 4){?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span class="glyphicon glyphicon-th">
                            </span> Guest Card</a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('customer');?>">&nbsp;&nbsp;&nbsp;&nbsp;Guest Card</a>
                                                </td>
                                            </tr>
                                
                            </table>
                        </div>
                    </div>
                </div>
<?php }?>		
<?php if($tipe == 1 || $tipe == 2 || $tipe == 4){?>		
				<div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseN"><span class="glyphicon glyphicon-th">
                            </span> Check Out</a>
                        </h4>
                    </div>
                    <div id="collapseN" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                          
                                  <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('payment');?>">&nbsp;&nbsp;&nbsp;&nbsp;Payment</a>
                                                </td>
                                            </tr>
											<tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('extendroom');?>">&nbsp;&nbsp;&nbsp;&nbsp;Extend</a>
                                                </td>
                                            </tr>
                            </table>
                        </div>
                    </div>
                </div>
<?php }?>		
<?php if($tipe == 1 || $tipe == 2){?>		
					<div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseB"><span class="glyphicon glyphicon-th">
                            </span> Payroll</a>
                        </h4>
                    </div>
                    <div id="collapseB" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('payroll');?>">&nbsp;&nbsp;&nbsp;&nbsp;Payroll</a>
                                                </td>
                                            </tr>
                                
                            </table>
                        </div>
                    </div>
                </div>
<?php }?>	
<?php if($tipe == 1 || $tipe == 2){?>			
				<div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseX"><span class="glyphicon glyphicon-th">
                            </span> Expenses</a>
                        </h4>
                    </div>
                    <div id="collapseX" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('categoryexpenses');?>">&nbsp;&nbsp;&nbsp;&nbsp;Category</a>
                                                </td>
                                            </tr>
                                  <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('expenses');?>">&nbsp;&nbsp;&nbsp;&nbsp;Expenses</a>
                                                </td>
                                            </tr>
                            </table>
                        </div>
                    </div>
                </div>
<?php }?>		
<?php if($tipe == 1 || $tipe == 2 || $tipe == 5){?>		
				 <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-th">
                            </span> Restaurant</a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('restaurant');?>">&nbsp;&nbsp;&nbsp;&nbsp;Restaurant</a>
                                                </td>
                                            </tr>
                                
                            </table>
                        </div>
                    </div>
                </div>
<?php }?>	
<?php if($tipe == 1 || $tipe == 2 || $tipe == 5){?>			
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseB"><span class="glyphicon glyphicon-file">
                            </span> Reports</a>
                        </h4>
                    </div>
                    <div id="collapseB" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-room text-success"></span> <a href="<?php echo site_url('restaurant');?>">&nbsp;&nbsp;&nbsp;&nbsp;Restaurant</a>
                                                </td>
                                            </tr>
                                
                            </table>
                        </div>
                    </div>
                </div>
<?php }?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="<?php echo site_url('dashboard/logout');?>"><span class="glyphicon glyphicon-off">
                            </span> Logout</a>
                        </h4>
                    </div>
                </div>
</div>