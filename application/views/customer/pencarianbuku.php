              <table class="table table-striped">
        <thead>
            <tr>
                <td>Check In ID</td>
                <td>Guest </td>
				 
                <td></td>
            </tr>
        </thead>
        <?php foreach($buku as $tmp):?>
        <tr>
            <td><?php echo $tmp->id_checkin;?></td>
            <td><?php echo $tmp->nama_reservasi;?></td>
			
            <td><a href="#" class="tambah" no="<?php echo $tmp->id_checkin;?>"
			>
			<i class="glyphicon glyphicon-plus"></i></a></td>
        </tr>
        <?php endforeach;?>
    </table>