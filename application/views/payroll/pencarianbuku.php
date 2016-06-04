                     <table class="table table-striped" id="xx">
        <thead>
            <tr>
                <td>Employee ID</td>
                <td>Name </td>
                <td>JobDesc</td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($buku as $tmp):?>
        <tr>
            <td><?php echo $tmp->id_pegawai;?></td>
            <td><?php echo $tmp->nama_pegawai;?></td>
            <td><?php echo $tmp->jabatan_pegawai;?></td>
			
            <td><a href="#" class="tambah" idpegawai="<?php echo $tmp->id_pegawai;?>"
            
           
			>
			<i class="glyphicon glyphicon-plus"></i></a></td>
        </tr>
        <?php endforeach;?>
    </table>