<table class="table table-striped">
        <thead>
            <tr>
				<td>ID Menu</td>
                <td>Kategori</td>
                <td>Chef</td>
                <td>Nama Menu</td>
				<td>Status</td>
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