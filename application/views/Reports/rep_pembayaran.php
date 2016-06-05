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
} );
	
</script>
</head>
<legend><?php echo $title;?></legend>
<?php echo $message;?>
<div class="container">
<ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#Expense"><strong>Expense Hotel</strong></a></li>
    <li><a data-toggle="pill" href="#menu1">Menu 1</a></li>
    <li><a data-toggle="pill" href="#menu2">Menu 2</a></li>
    <li><a data-toggle="pill" href="#menu3">Menu 3</a></li>
  </ul>
  </div>
  <br>
<div class="container">

<div class="tab-content">
    <div id="Expense" class="tab-pane fade in active">
      <table id="tabelPembayaran" class="table table-striped table-bordered table-responsive">
	
	  </table>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>HAI 1</h3>
      
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>HAI 2</h3>
      
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>HAI 3</h3>
      
    </div>
</div>
  
	
</div>
<script>
    
</script>