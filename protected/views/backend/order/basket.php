
<table class="table table-responsive" id="font-th">
    <thead>
        <tr>
            <th>#</th>
            <th></th>
            <th>สินค้า</th>
            <th style="text-align: center;">จำนวน</th>
            <th style="text-align: right;">ราคา/ชิ้น</th>
            <th style="text-align: right;">ราคารวม</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        $product = new Product();
        $sum_price = 0;
        foreach ($basket as $rs):
            $i++;
            $sum_price = $sum_price + $rs['product_price_sum'];
            $img = $product->get_last_img($rs['product_id']);
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td style=" width: 10%;">
                    <img src="<?php echo Yii::app()->baseUrl;?>/uploads/<?php echo $img?>" class="img-thumbnail img-responsive"/>
                </td>
                <td><?php echo $rs['product_name']; ?></td>
                <td style="text-align: center;"><?php echo $rs['product_num']; ?></td>
                <td style="text-align: right; color: #ffcc00;"><?php echo number_format($rs['product_price'], 2); ?></td>
                <td style="text-align: right; color: #ff0000; background: #22282e;"><?php echo number_format($rs['product_price_sum'], 2); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="text-align: center; background: #22282e;">รวมราคา</td>
            <td style="text-align: right; color: #ff0000; background: #1c1e22;"><?php echo number_format($sum_price, 2); ?></td>
        </tr>
    </tfoot>
</table>
