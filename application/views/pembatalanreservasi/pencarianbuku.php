   <table class="table table-striped">
        <thead>
            <tr>
                <td>ID Reservasi</td>
                <td>Nama </td>
                <td>Tanggal Check in</td>
				<td>Tanggal Check Out</td>
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
			id_useroom="<?php echo $tmp->id_useroom;?>"
			>
			<i class="glyphicon glyphicon-plus"></i></a></td>
        </tr>
        <?php endforeach;?>
    </table>