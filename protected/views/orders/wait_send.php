<?php
$this->breadcrumbs = array(
    "รอจัดส่ง"
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <font id="font-rsu-18" style="color: #ff3300">
        <img src="<?php echo Yii::app()->baseUrl; ?>/images/delivery-box-icon.png"/>
        รอจัดส่ง</font>
    </div>
    <?php if (empty($order)) { ?>
        <br/><center>ไม่มีรายการ</center><br/>
    <?php } else { ?>
        <table class="table table-striped" id="font-20">
            <thead>
                <tr style=" background: #cccccc;">
                    <th>#</th>
                    <th>ดูสินค้า</th>
                    <th>รหัส</th>
                    <th style="text-align: center;">วันที่</th>
                    <th style="text-align: center;">จำนวน</th>
                    <th style="text-align: right;">ราคารวม</th>
                    <th style="text-align: center;">สถานะ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $web = new Configweb_model();
                foreach ($order as $rs): $i++;
                    $transport = $model->get_transport_in_order($rs['order_id']);
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><a href="javascript:view_order('<?php echo $rs['order_id'] ?>')"><i class="fa fa-eye"></i></a></td>
                        <td><?php echo $rs['order_id']; ?></td>
                        <td style="text-align: center;"><?php echo $web->thaidate($rs['order_date']); ?></td>
                        <td style="text-align: center;"><?php echo $rs['PRODUCT_TOTAL']; ?></td>
                        <td style="text-align: right;"><?php echo number_format($rs['PRICE_TOTAL'] + $transport['price'], 2); ?></td>
                        <td style="text-align: center; color: #ff6600;"><i class="fa fa-info-circle"></i> รอจัดส่ง</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php } ?>
</div>

<label style="color:red;">
    * ทางร้านเรากำลังเร่งจัดส่งสินค้าให้ท่าน<br/>
    * ถ้าหากทางร้านจัดส่งสินค้าให้ท่านแล้วจะรีบแจ้งให้ท่านทราบโดยเร็ว 
</label>
