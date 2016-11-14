<table class="table">
    <thead>
        <tr>
            <td>#</td>
            <td>ชื่อสินค้า</td>
            <td style=" text-align: center;">จำนวน</td>
        </tr>
    </thead>
    <tbody>
        <?php $i=0;foreach($drug as $rs): $i++;?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $rs['product_name']?></td>
            <td style=" text-align: center;"><?php echo $rs['number']?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

