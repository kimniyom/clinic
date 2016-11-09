
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
            $img_short = $product->get_images_product_title($rs['product_id']);
            if(!empty($img_short)){
                $img = "uploads/product_thumb/".$img_short['images'];
            } else {
                $img = "images/No_image_available.jpg";
            }
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td style="width: 10%;">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img ?>" class="img-thumbnail img-responsive" style="max-width:80px;"/>
                </td>
                <td><?php echo $rs['product_name']; ?></td>
                <td style="text-align: center;"><?php echo $rs['product_num']; ?></td>
                <td style="text-align: right; color: #ffcc00;"><?php echo number_format($rs['product_price'], 2); ?></td>
                <td style="text-align: right; color: #ff0000; background: #eeeeed;"><?php echo number_format($rs['product_price_sum'], 2); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="5" style="text-align: center;">ค่าจัดส่ง</td>
            <td style="text-align: right; text-align: right; color: #ff0000; background: #eeeeed;"><?php echo number_format($transport['price'], 2) ?></td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="text-align: center; background: #eeeeed;">รวมราคา</td>
            <td style="text-align: right; color: #ffff00; background: #b8b8b8;"><?php echo number_format($sum_price + $transport['price'], 2); ?></td>
        </tr>
    </tfoot>
</table>
