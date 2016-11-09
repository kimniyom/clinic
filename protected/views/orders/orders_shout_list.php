<style type="text/css">
    #del{ cursor:pointer;}
</style>

<script type="text/javascript">
    function del_list_order(id, product_id) {
        //alert(product_id);
        var url = "<?= Yii::app()->createUrl('frontend/orders/del_list_order') ?>";
        var data = {id: id, product_id: product_id};

        $.post(url, data,
                function (success) {
                    //alert('ลบสินค้าออกจากตะกร้าแล้ว');
                    //window.location.reload();
                    load_cart_list();
                    load_box_cart();
                }
        );// endpost
    }

    function edit_num(id, new_num, price) {
        var url = "<?= Yii::app()->createUrl('frontend/orders/edit_num_order') ?>";
        var price_total = (price * new_num);
        var data = {
            id: id,
            new_num: new_num,
            price_total: price_total
        };

        $.post(url, data,
                function (success) {
                    //alert('ลบสินค้าออกจากตะกร้าแล้ว');
                    //window.location.reload();
                    load_cart_list();
                    load_box_cart();
                });
    }
</script>

<?php if ($count > 0) { ?>

    <table width="100%" class="table table-hover" id="font-18">
        <tbody>
            <?php
            $product_model = new Product();
            $totalall = 0;
            $i = 1;
            foreach ($product as $products):
                $img_title = $product_model->get_images_product_title($products['product_id']);
                if (!empty($img_title)) {
                    $img = "uploads/product_thumb/" . $img_title['images'];
                } else {
                    $img = "images/No_image_available.jpg";
                }
                $product_price = $products['product_price'];
                ?>
                <tr id="tr_b" style=" color: #000;">
                    <td id="td_b">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img; ?>" style=" max-width: 80px;"/>
                    </td>
                    <td>
                        <b>สินค้า</b> <?= $products['product_name']; ?><br/>
                        <b>ราคา</b> <?= number_format($products['product_price']); ?> <b>บาท/หน่วย</b><br/>
                        <b>จำนวน</b> <select id="num" onchange="edit_num('<?= $products['id'] ?>', this.value, '<?= $product_price ?>');"
                                             style=" width:100px; padding-left:5%;">
                                                 <?php for ($i = 1; $i <= 20; $i++) { ?>
                                <option value="<?php echo $i; ?>"<?php
                                if ($i == $products['product_num']) {
                                    echo "selected";
                                }
                                ?>><?php echo $i; ?></option>
                                    <?php } ?>
                        </select><br/>
                        <b>รวม</b> <?= number_format(($products['product_price'] * $products['product_num']), 2); ?> <b>บาท</b>
                    </td>
                    <td id="td_b" style=" text-align: center;">
                        <img src="<?= Yii::app()->baseUrl; ?>/images/error.png" onclick="return del_list_order('<?= $products['id'] ?>', '<?= $products['product_id'] ?>');" id="del" title="ลบสินค้าออกจากตะกร้า"/>
                    </td>
                    <?php
                    $total = (($products['product_price'] * $products['product_num']));
                    $totalall = $totalall + $total;
                    ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" id="td_b2" align="center">
                    <font style="text-decoration:none;font-size: 24px; color: #000;">ราคารวม </font>
                    <font style="text-decoration:none; font-size: 24px; margin: 0px 10px;"><?= number_format($totalall, 2) ?></font>
                    <font style="text-decoration:none;font-size: 24px; color: #000;">บาท</font>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <a href="<?php echo Yii::app()->createUrl('frontend/orders/order_list', array('order_id' => Yii::app()->session['order_id'])); ?>">
                        <button class="btn btn-default" style=" font-size: 14px;">
                            <i class="fa fa-shopping-cart"></i>
                            ยืนยันการสั่งซื้อสินค้า
                        </button></a>
                </td>
            </tr>
        </tfoot>
    </table>
<?php } else { ?>
    <div class="well" style="text-align:center; border-radius:0px;">
        <span class="fa-stack fa-lg">
            <i class="fa fa-shopping-cart fa-stack-4x"></i>
            <i class="fa fa-ban fa-stack-2x text-danger"></i>
        </span><br/><br/>
        <p id="font-rsu-20">
            ไม่มีสินค้าในตระกร้า
        </p>
    </div>
<?php } ?>
