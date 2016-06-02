<table class="table table-striped">
        <thead>
            <tr>
                <td>Menu ID</td>
                <td>Menu Name</td>
				<td>Price</td>
            </tr>
        </thead>
        <?php foreach($buku as $tmp):?>
        <tr>
            <td><?php echo $tmp->id_menu;?></td>
            <td><?php echo $tmp->nama_menu;?></td>
			  <td><?php echo $tmp->harga_menu;?></td>
            <td><a href="#" class="tambah" idmenu="<?php echo $tmp->id_menu;?>"
        
            namamenu="<?php echo $tmp->nama_menu;?>"  harga="<?php echo $tmp->harga_menu;?>"><i class="glyphicon glyphicon-plus"></i></a>
			
			</td>
			
        </tr>
        <?php endforeach;?>
    </table>
                  