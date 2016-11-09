<?php
$this->breadcrumbs = array(
    "จัดส่งสินค้าเรียบร้อย"
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <font id="font-rsu-18" style="color: #ff3300">
        <img src="<?php echo Yii::app()->baseUrl; ?>/images/send-receive-icon.png"/>
        จัดส่งสินค้าเรียบร้อย</font>
    </div>
    <?php if (empty($order)) { ?>
        <br/><center>ไม่มีรายการ</center><br/>
    <?php } else { ?>
        <table class="table table-striped" id="font-20">
            <thead>
                <tr style=" background: #cccccc;">
                    <th>#</th>
                    <th>รหัสสั่งซื้อ</th>
                    <th style="text-align: center;">วันที่จัดส่ง</th>
                    <th style="text-align: center;">จำนวน</th>
                    <th style="text-align: right;">ราคา</th>
                    <th style="text-align: center;">สถานะ</th>
                    <th style="text-align: center;">เลขพัสดุ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $web = new Configweb_model();
                foreach ($order as $rs): $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><a href="javascript:view_order('<?php echo $rs['order_id'] ?>')"><?php echo $rs['order_id']; ?></a></td>
                        <td style="text-align: center;"><?php echo $web->thaidate($rs['date_send']); ?></td>
                        <td style="text-align: center;"><?php echo $rs['PRODUCT_TOTAL']; ?></td>
                        <td style="text-align: right;"><?php echo number_format($rs['PRICE_TOTAL'], 2); ?></td>
                        <td style="text-align: center; color:green;"><i class="fa fa-check-circle"></i> จัดส่งเรียบร้อย</td>
                        <td style="text-align: center; color:red;"><?php echo $rs['postcode']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php } ?>
</div>

