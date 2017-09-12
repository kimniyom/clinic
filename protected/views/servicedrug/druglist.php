<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>#</td>
            <td></td>
            <td>ชื่อสินค้า</td>
            <td style=" text-align: center;">จำนวน</td>
            <td style=" text-align: center;">ราคา / หน่วย</td>
            <td style=" text-align: center;">รวม</td>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sum = 0;
        $product_model = new Product();
        $i = 0;
        foreach ($drug as $rs): $i++;
            $firstImg = $product_model->firstpictures($rs['product_id']);
            if (!empty($firstImg)) {
                $img = "uploads/product/" . $firstImg;
            } else {
                $img = "images/No_image_available.jpg";
            }
            $total = ($rs['product_price'] * $rs['number']);
            $sum = $sum + $total;
            ?>
            <tr>
                <td style=" width: 2%; text-align: center;"><?php echo $i ?></td>
                <td style=" width: 5%;">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img ?>" class="img-resize img-responsive"/>
                </td>
                <td><?php echo $rs['product_name'] ?></td>
                <td style=" text-align: center;"><?php echo $rs['number'] ?></td>
                <td style=" text-align: right;"><?php echo number_format($rs['product_price'], 2) ?></td>
                <td style=" text-align: right;"><?php echo number_format($total, 2) ?></td>
                <td style=" text-align: center;">
                    <button type="button" class="btn btn-danger"
                            onclick="deleteitem('<?php echo $rs['product_id'] ?>')"><i class="fa fa-trash"></i></button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="text-align: center; font-weight: bold;">รวม</td>
            <td style=" text-align: right; font-weight: bold;">
                <?php echo number_format($sum, 2) ?>
            </td>
            <td></td>
        </tr>
    </tfoot>
</table>

<script type="text/javascript">
    function deleteitem(product_id) {
        var r = confirm("Are you sure ...");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('service/deleteitem') ?>";
            var service_id = $("#service_id").val();
            var data = {product_id: product_id, service_id: service_id};
            $.post(url, data, function (result) {
                GetformDrug();
            });
        }
    }
</script>

