<style type="text/css">
    .panel-heading .accordion-toggle:after {
        /* symbol for "opening" panels */
        font-family: 'Glyphicons Halflings';  /* essential for enabling glyphicon */
        content: "\e114";    /* adjust as needed, taken from bootstrap.css */
        float: right;        /* adjust as needed */
        color: grey;         /* adjust as needed */
    }
    .panel-heading .accordion-toggle.collapsed:after {
        /* symbol for "collapsed" panels */
        content: "\e080";    /* adjust as needed, taken from bootstrap.css */
    }
</style>
<?php
$this->breadcrumbs = array(
    "รอชำระเงิน",
);
?>

<br/>
<div class="well">
    <div style=" color: #ff3300;" id="font-rsu-18">
        <img src="<?php echo Yii::app()->baseUrl; ?>/images/payment-icon.png"/>
        * เลือกรายการที่จะชำระเงิน
    </div><br/>
    <?php if (empty($order)) { ?>
        <div class="alert alert-warning">ไม่มีรายการ</div>
    <?php } ?>
    <div class="panel-group" id="accordion">

        <?php
        $web = new Configweb_model();
        $i = 0;
        foreach ($order as $rs):
            $i++;
            if ($i == '1') {
                $active = "in";
            } else {
                $active = "";
            }
            ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title" style=" color: #ff3300;">
                        <a href="<?php echo Yii::app()->createUrl('frontend/orders/confieminformpayment', array('order_id' => $rs['order_id'])) ?>">
                            <div class="btn btn-default btn-sm" title="แจ้งชำระเงิน">
                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/atm-icon.png"/>
                                <font style="font-size:18px;">แจ้งชำระรายการนี้</font>
                            </div></a>
                        <div class="pull-right">
                            <a class="accordion-toggle btn btn-default" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" title="รายการสินค้า"></a>
                        </div>
                        <br/><br/>
                        <font id="font-rsu-16">
                        รหัสสั่งซื้อ <span class="badge"><?php echo $rs['order_id'] ?></span>
                        วันที่ <?php echo $web->thaidate($rs['order_date']) ?>
                        จำนวน <span class="badge"><?php echo $rs['PRODUCT_TOTAL'] ?></span>
                        ราคา <span class="badge"><?php echo number_format($rs['PRICE_TOTAL'], 2) ?></span>
                        </font>
                    </h4>
                </div>
                <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse <?php echo $active; ?>">

                    <table width="100%" class="table" id="font-20">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>รูป</td>
                                <td>ชื่อสินค้า</td>
                                <td style="text-align: center;">ราคา</td>
                                <td style="text-align: center;">จำนวน</td>
                                <td style="text-align: right;">ราคารวม</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalall = 0;
                            $i = 1;
                            $product_model = new Product();
                            $order = new Orders();
                            $transport = $order->get_price_transport($rs['order_id']);
                            $product = $order->_get_list_order($rs['order_id']);
                            foreach ($product as $products):
                                $img_ttitle = $product_model->get_images_product_title($products['product_id']);
                            if(!empty($img_ttitle)){
                                $img = "uploads/product_thumb/".$img_ttitle['images'];
                            } else {
                                $img = "images/No-image.jpg";
                            }
                                ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td style=" width: 10%;">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img; ?>" class="img-resize img-thumbnail" width="100%"/>
                                    </td>
                                    <td><?= $products['product_name']; ?></td>
                                    <td style=" text-align: right;"><?= number_format($products['product_price']); ?></td>
                                    <td style="text-align: center;"><?= $products['product_num']; ?></td>
                                    <td style="text-align: right;"><?= number_format(($products['product_price'] * $products['product_num']), 2); ?></td>
                                    <?php
                                    $total = (($products['product_price'] * $products['product_num']));
                                    $totalall = $totalall + $total;
                                    ?>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="5" style="text-align:center;">ค่าจัดส่ง</td>
                                <td style="text-align:right;"><?php echo number_format($transport, 2); ?></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr style="color:#ff3300;">
                                <td colspan="5" align="center"><font style="text-decoration:underline;">ราคาสุทธิ </font></td>
                                <td style=" text-align: right;"><font style="text-decoration:underline;"><?= number_format($totalall + $transport, 2) ?></font> </td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>
