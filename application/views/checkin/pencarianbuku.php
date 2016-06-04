                       <table class="table table-striped">
        <thead>
            <tr>
                <td>Reservation ID</td>
                <td>Name </td>
                <td>Check in Date</td>
				<td>Check Out Date</td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($buku as $tmp):?>
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
			idkamar="<?php echo $tmp->id_kamar;?>"
			id_BookedRoom="<?php echo $tmp->id_bookedRoom?>"
			>
			<i class="glyphicon glyphicon-plus"></i></a></td>
        </tr>
        <?php endforeach;?>
    </table>