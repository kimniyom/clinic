<?php
$CenterStockItemModel = new CenterStockitem();
?>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>รหัส</th>
            <th>วัตถุดิบ</th>
            <th>คงเหลือ</th>
            <th>จำนวน / หน่วย</th>
            <th>จำนวนรวม</th>
            <th>หน่วย</th>
            <th style="text-align: center;">สถานะ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($mixer as $rs): $i++;
            $total = $CenterStockItemModel->Gettotalitem($rs['itemid']);
            $numbertotal = ($rs['number'] * $number);
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $rs['itemcodes'] ?></td>
                <td><?php echo $rs['itemname'] ?></td>
                <td><?php echo number_format($total) ?></td>
                <td><?php echo $rs['number'] ?></td>
                <td><?php echo number_format($numbertotal) ?></td>
                <td><?php echo $rs['unit'] ?></td>
                <td style=" text-align: center;">
                    <?php if ($total < $numbertotal) { ?>
                        <i class="fa fa-remove text-danger"></i>
                    <?php } else { ?>
                        <i class="fa fa-check text-success"></i>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
