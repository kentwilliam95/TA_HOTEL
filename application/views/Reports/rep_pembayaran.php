<head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap.css")?>">

<script src="<?php echo base_url("assets/js/jquery.js")?>"> </script>
<script src="<?php echo base_url("assets/js/bootstrap.js")?>"> </script>
<script src="<?php echo base_url("assets/js_reports/jquery.dataTables.min.js")?>"></script>
<script src="<?php echo base_url("assets/js_reports/dataTables.bootstrap.min.js")?>"></script>
<script src="<?php echo base_url("dataTables.responsive.min.js")?>"></script>
<script src="<?php echo base_url("assets/js_reports/responsive.bootstrap.min.js")?>"></script>
<script>
var dataSet = null;
 
$(document).ready(function() {
    $('#tabelPembayaran').DataTable( {
        data: <?php echo $DataPengeluaran?>,
        columns: [
            { title: "ID Kateori Pengeluaran" },
            { title: "Id Pengeluaran" },
            { title: "Tangal" },
            { title: "Nominal" },
            { title: "Keterangan" }
        ]
    } );
	
	$('#tabelPayroll').DataTable( {
        data: <?php echo $DataPengeluaranPayroll?>,
        columns: [
            { title: "ID Penggajian" },
            { title: "Tangal Pengajian" },
            { title: "Id Pegawai" },
            { title: "Gaji Pokok" },
            { title: "bonus" },
			{ title: "Deskripsi" },
			{ title: "Overtime" },
			{ title: "Total_gaji" }
        ]
    } );
	
	$('#tabelIncome').DataTable( {
        data: <?php echo $DataPengeluaranIncome?>,
        columns: [
            { title: "ID Checkin" },
            { title: "Nomor Debit" },
            { title: "Akun Bayar" },
            { title: "Jumlah" },
            { title: "Terbayar" },
			{ title: "Sisa" },
			{ title: "Id Promo" },
			{ title: "Status Pembayaran" },
			{ title: "Jenis Pembayaran" }
        ]
    } );
	
	$('#tabelInventaris').DataTable( {
        data: <?php echo $DataPengeluaranInventaris?>,
        columns: [
            { title: "ID Kategori Inventaris" },
            { title: "Id Item" },
            { title: "Nama Item" },
            { title: "Start Guarantee" },
            { title: "End Guarantee" }
        ]
    } );
	
	
} );
	
</script>
</head>
<legend><?php echo $title;?></legend>
<?php echo $message;?>
<div class="container">
<ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#Expense"><strong>Expense Hotel</strong></a></li>
    <li><a data-toggle="pill" href="#payroll"><Strong>PayRoll Hotel</Strong></a></li>
    <li><a data-toggle="pill" href="#Income"><Strong> Income Hotel</strong> </a></li>
    <li><a data-toggle="pill" href="#menu3"><strong>Inventaris Hotel</strong></a></li>
</ul>
</div>
  <br>
<div class="container">

<div class="tab-content">
    <div id="Expense" class="tab-pane fade in active">
      <table id="tabelPembayaran" class="table table-striped table-bordered table-responsive">
	
	  </table>
    </div>
    <div id="payroll" class="tab-pane fade">
      <table id="tabelPayroll" class="table table-striped table-bordered table-responsive"> 
	  
	  </table>
    </div>
    <div id="Income" class="tab-pane fade">
     <table id="tabelIncome" class="table table-striped table-bordered table-responsive"> 
	  
	  </table>
    </div>
    <div id="menu3" class="tab-pane fade">
     <table id="tabelInventaris" class="table table-striped table-bordered table-responsive"> 
	  
	  </table>
      
    </div>
</div>
  
	
</div>
<script>
    
</script>