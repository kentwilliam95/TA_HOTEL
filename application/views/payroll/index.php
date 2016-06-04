
<head>
	<script>
		$("document").ready(function()
		{
			//alert(1);
			$("#cari2").click(function()
			{
				$("#myModal2").modal("show");
			});
			
			$("#submitData").click(function()
			{
				
				$("#tipebed").val($("#idbed").val());
				$("#tipekamar").val($("#idtipe").val());
				$("#idkamar").val($("#no1").val());
				$("#checkinId").val($("#no").val());
				alert($("#tipebed").val()+","+$("#tipekamar").val()+","+$("#idkamar").val()+","+$("#checkinId").val());
			});
			
			$(".tambah").live("click",function(){
			var id_useroom = $(this).attr("id_useroom");
            var kode=$(this).attr("checkinId");
			var checkinDate=$(this).attr("checkinDate");
			var checkoutDate=$(this).attr("checkoutDate");
			var tipekamar=$(this).attr("tipekamar");
			var tipebed=$(this).attr("tipebed");
			var namareservasi=$(this).attr("customerName");
			var roomId = $(this).attr("roomId");
            
            $("#no").val(kode);
			$("#tglcheckin").val(checkinDate);
			$("#tglcheckout").val(checkoutDate);
			$("#idtipe").val(tipekamar);
			$("#idbed").val(tipebed);
			$("#custname").val(namareservasi);
			$("#roomid").val(roomId);

			$("#kodeUseroom").val(kode);
			$("#id_useroom").val(id_useroom);
			
            
            $("#myModal2").modal("hide");
        })
		
		$(".tambah1").live("click",function()
		{
				
				var temp1 = $(this).attr("carikamar");
				//alert(temp1);
				$("#no1").val(temp1);
				
				$("#myModal3").modal("hide");
		});
		
		$("#nis").click(function(){
			var tipekamar1= $("#idtipe").val();
			var tipebed1 = $("#idbed").val();
			//alert(tipekamar1+","+tipebed1);
			checkKamar(tipekamar1,tipebed1);
            $("#myModal3").modal("show");
        })
		$("#cari23").click(function(){
            var cari22=$("#cari22").val();
            
            $.ajax({
                url:"<?php echo site_url('changeroom/pencarianbuku');?>",
                type:"POST",
                data:"cari22="+cari22,
                cache:false,
                success:function(html){
                    $("#tampilbuku").html(html);
					$("#xx").hide();
                }
            })
			//alert("x");
        })
		function checkKamar(tipekamar1,tipebed1)
		{
			$.ajax({
                url:"<?php echo site_url('changeroom/CariKamar')?>", 
				type:"POST",
				datatype:"json",
				data:{tipekamar: tipekamar1,tipebed: tipebed1},
				success: function(result)
				{
					//alert("aa");
					$("#isiTabel").html(result);
				},
				error:function(aaa)
				{
					alert(aaa);
				}
            });
		}
		
		});
	</script>
</head>
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
