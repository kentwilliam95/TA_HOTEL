<table class="table table-striped">
    <thead>
        <tr>
            <td>Tipe Kamar</td>
            <td>Tipe Bed</td>
            <td>ID Kamar</td>
            <td></td>
        </tr>
    </thead>
    <?php foreach($kamar as $row):?>
    <tr>
        <td><?php echo $row->id_tipekamar;?></td>
        <td><?php echo $row->id_bed;?></td>
        <td><?php echo $row->id_kamar;?></td>
        <td><a href="#" class="tambahkan" no="<?php echo $row->id_kamar;?>">
            <i class="glyphicon glyphicon-plus"></i>
        </a></td>
    </tr>
    <?php endforeach;?>
</table>