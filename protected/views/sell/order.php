
<table style=" width: 100%;" id="font-18">
    <thead>
        <tr style=" border-bottom: #efefef solid 1px;">
            <th style="text-align: center; width: 5%;">#</th>
            <th>รายการ</th>
            <th style=" text-align: center;">จำนวน</th>
            <th style=" text-align: right;">ราคา / หน่วย</th>
            <th style=" text-align: right;">รวม</th>
            <th></th>
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
                <td style=" text-align: center;">
                    <i class="fa fa-remove" onclick="deleteItems('<?php echo $rs['id'] ?>')" style=" cursor: pointer;"></i></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    function deleteItems(id) {
        var url = "<?php echo Yii::app()->createUrl('sell/deleteitemsinorder') ?>";
        var data = {id: id};
        $.post(url, data, function (datas) {
            loadorder();
        });
    }
</script>
