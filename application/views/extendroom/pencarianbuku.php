 <table class="table table-striped" id="xx">
        <thead>
            <tr>
                <td>ID Reservasi</td>
                <td>Nama </td>
                <td>Tanggal Check in</td>
				<td>Tanggal Check Out</td>
				<td>Room ID</td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($buku as $tmp):?>
        <tr>
            <td><?php echo $tmp->id_reservasi;?></td>
            <td><?php echo $tmp->nama_reservasi;?></td>
            <td><?php echo $tmp->tgl_checkin;?></td>
			<td><?php echo $tmp->tgl_checkout;?></td>
			<td><?php echo $tmp->id_kamar;?></td>
            <td><a href="#" class="tambah" no="<?php echo $tmp->id_reservasi;?>"
            checkinId = "<?php echo $tmp->id_checkin;?>"
            customerName="<?php echo $tmp->nama_reservasi;?>"
			checkinDate="<?php echo $tmp->tgl_checkin;?>"
			checkoutDate="<?php echo $tmp->tgl_checkout;?>"
			roomId="<?php echo $tmp->id_kamar;?>"
			tipekamar="<?php echo $tmp->id_tipekamar;?>"
			tipebed="<?php echo $tmp->id_bed;?>"
			id_useroom="<?php echo $tmp->id_useroom;?>"
			>
			<i class="glyphicon glyphicon-plus"></i></a></td>
        </tr>
        <?php endforeach;?>
    </table>