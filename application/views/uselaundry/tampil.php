<table class="table table-striped">
        <thead>
            <tr>
				<td>ID Item</td>
                <td>Nama Item</td>
				<td>Jumlah</td>
				<td>Harga</td>
				<td>Subtotal</td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($tmp as $tmp):?>
        <tr>
            <td><?php echo $tmp->id_menu;?></td>
            <td><?php echo $tmp->id_kategorifb;?></td>
            <td><?php echo $tmp->id_chef;?></td>
			  <td><?php echo $tmp->nama_menu;?></td>
			    <td><?php echo $tmp->status;?></td>
            <td><a href="#" class="hapus" kode="<?php echo $tmp->id_menu;?>"><i class="glyphicon glyphicon-trash"></i></a></td>
        </tr>
        <?php endforeach;?>
        
    </table>