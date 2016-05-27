<table class="table table-striped">
        <thead>
            <tr>
                <td>ID Pegawai</td>
                <td>Nama Pegawai</td>
                <td>Jabatan</td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($pegawai as $tmp):?>
        <tr>
            <td><?php echo $tmp->id_pegawai;?></td>
            <td><?php echo $tmp->nama_pegawai;?></td>
            <td><?php echo $tmp->jabatan_pegawai;?></td>
            <td><a href="#" class="tambah" kode="<?php echo $tmp->id_pegawai;?>"
            <i class="glyphicon glyphicon-plus"></i></a></td>
        </tr>
        <?php endforeach;?>
    </table>