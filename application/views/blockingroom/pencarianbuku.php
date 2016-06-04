 <table class="table table-striped" id="xx">
        <thead>
            <tr>
                <td>Reservation ID</td>
                <td>Customer Name</td>
                <td>Check in Date</td>
				<td>Check Out Date</td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($buku as $tmp){?>
        <tr>
            <td><?php echo $tmp->id_reservasi;?></td>
            <td><?php echo $tmp->nama_reservasi;?></td>
            <td><?php echo $tmp->tgl_checkin;?></td>
			<td><?php echo $tmp->tgl_checkout;?></td>
			
            <td><a href="#" class="tambah" no="<?php echo $tmp->id_reservasi;?>"
            
            tglreservasi="<?php echo $tmp->tgl_reservasi;?>"
			tglcheckin="<?php echo $tmp->tgl_checkin;?>"
			tglcheckout="<?php echo $tmp->tgl_checkout;?>"
			namareservasi="<?php echo $tmp->nama_reservasi;?>"
			jumlah="<?php echo $tmp->passengers;?>"
			tipekamar="<?php echo $tmp->id_tipekamar;?>"
			tipebed="<?php echo $tmp->id_bed;?>"
			id_useroom="<?php echo $tmp->id_useroom;?>"
			>
			<i class="glyphicon glyphicon-plus "></i></a></td>
        </tr>
        <?php };?>
    </table>