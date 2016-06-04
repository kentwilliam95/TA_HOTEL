   <table class="table table-striped" id="xy">
        <thead>
            <tr>
                <td>Check In</td>
				<td>Room Number</td>
				<td>Name</td>
            </tr>
        </thead>
        <?php foreach($buku2 as $tmp):?>
        <tr>
            <td><?php echo $tmp->id_checkin;?></td>
			<td><?php echo $tmp->id_kamar;?></td>
			<td><?php echo $tmp->nama_reservasi;?></td>
            <td><a href="#" class="tambah12" idcheckin="<?php echo $tmp->id_checkin;?>"><i class="glyphicon glyphicon-plus"></i></a>
			
			</td>
			
        </tr>
        <?php endforeach;?>
    </table>