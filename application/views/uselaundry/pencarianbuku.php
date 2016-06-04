      <table class="table table-striped">
        <thead>
            <tr>
                <td>Item ID</td>
                <td>Item Name</td>
				<td>Price</td>
            </tr>
        </thead>
        <?php foreach($buku as $tmp):?>
        <tr>
            <td><?php echo $tmp->id_laundry;?></td>
            <td><?php echo $tmp->nama_item;?></td>
            <td><?php echo $tmp->harga_laundry;?></td>
            <td><a href="#" class="tambah" idmenu="<?php echo $tmp->id_laundry;?>"
        
            namamenu="<?php echo $tmp->nama_item;?>"  harga="<?php echo $tmp->harga_laundry;?>"><i class="glyphicon glyphicon-plus"></i></a>
			
			</td>
			
        </tr>
        <?php endforeach;?>
    </table>