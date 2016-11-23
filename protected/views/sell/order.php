
<table style=" width: 100%;" id="font-18">
    <thead>
        <tr style=" border-bottom: #efefef solid 1px;">
            <th style="text-align: center; width: 5%;">#</th>
            <th>รายการ</th>
            <th style=" text-align: center;">จำนวน</th>
            <th style=" text-align: right;">ราคา / หน่วย</th>
            <th style=" text-align: right;">รวม</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sum = 0;
        $i = 0;
        foreach ($order as $rs):
            $i++;
            $priceRow = ($rs['product_price'] * $rs['total']);
            $sum = $sum + $priceRow;
            ?>
            <tr>
                <td style=" text-align: center;"><?php echo $i ?></td>
                <td><?php echo $rs['product_name'] ?></td>
                <td style=" text-align: center;"><?php echo $rs['total'] ?></td>
                <td style="text-align: right;">​<?php echo number_format($rs['product_price'], 2) ?></td>
                <td style="text-align: right;">​<?php echo number_format($priceRow, 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
