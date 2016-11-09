<?php
$period = new Backend_period();
$period_active = $period->get_period_active();
$this->breadcrumbs = array(
    'สรุปรายการสั่งซื้อ',
);
?>

<div class="well" id="font-rsu-16" style=" font-weight: bold; background: #FFF; color: #ff3300;">
    <img src="<?php echo Yii::app()->baseUrl; ?>/images/notification-icon.png"/><br/>
    ระบบจะทำการล็อคสินค้าไว้ให้ท่านเป็นเวลา <?php if(!empty($period_active)){echo $period_active;} else { echo "3";}?> วัน<br/>
    หากท่านไม่ชำระเงินภายในระยะเวลาที่กำหนดระบบจะทำการลบรายการสั่งซื้อของท่าน<br/><br/>
    ท่านสามารถแจ้งการชำระเงินได้ที่เมนู "แจ้งชำระเงิน" หรือคลิกที่นี้
    <a href="<?php echo Yii::app()->createUrl('frontend/orders/Informpayment') ?>">
      <div class="btn btn-success btn-sm"><i class="fa fa-hand-o-up"></i> แจ้งการชำระเงิน</div>
    </a>
</div>
<div class="well" style=" background: #FFF;" id="font-18">
    <label id="font-rsu-20"><i class="fa fa-home"></i> ที่อยู่จัดส่ง</label><br/>
    <label>
        คุณ <?php echo $address['name'] . ' ' . $address['lname'] ?>
    </label>
    <br/><br/>
    <label>เลขที่</label> <?php echo $address['number'] ?>
    <label>อาคาร</label> <?php echo $address['building'] ?>
    <label>ชั้น</label> <?php echo $address['class'] ?>
    <label>ห้อง</label> <?php echo $address['room'] ?><br/>
    <label>ตำบล</label>  <?php echo $address['tambon_name'] ?><br/>
    <label>อำเภอ</label>  <?php echo $address['ampur_name'] ?><br/>
    <label>จังหวัด</label>  <?php echo $address['changwat_name'] ?><br/>
    <label>รหัสไปรษณีย์</label>  <?php echo $address['zipcode'] ?>
    <br/><br/>
    <label>Tel </label> <?php echo $address['tel'] ?><br/>
    <label>Email </label> <?php echo $address['email'] ?>

    <br/><br/>
    <label id="font-rsu-20"><i class="fa fa-table"></i> สรุปรายการสั่งซื้อ</label><br/>
    <table width="100%" class="table table-bordered" id="font-18">
        <thead>
            <tr>
                <td>#</td>
                <td>รูป</td>
                <td>ชื่อสินค้า</td>
                <td style="text-align: center;">ราคา</td>
                <td style="text-align: center;">จำนวน</td>
                <td style="text-align: center;">ราคารวม</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalall = 0;
            $i = 1;
            $product_model = new Product();
            foreach ($product as $products):
                $img = $product_model->get_last_img($products['product_id']);
                ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td style=" width: 10%;">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/<?php echo $img; ?>" class="img-resize img-thumbnail" width="100%"/>
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
              <td colspan="5" style="text-align:center;">รวม</td>
              <td style="text-align:right;"><?php echo number_format($totalall,2);?></td>
            </tr>
            <tr>
              <td colspan="5" style="text-align:center;">ค่าจัดส่ง</td>
              <td style="text-align:right;"><?php echo number_format($transport,2);?></td>
            </tr>
        </tbody>
        <tfoot>
            <tr style="color:#ff3300;">
                <td colspan="5" align="center"><font style="text-decoration:underline;">รวมค่าสินค้า + ค่าจัดส่ง</font></td>
                <td style=" text-align: right;"><font style="text-decoration:underline;"><?= number_format($totalall + $transport, 2) ?></font> </td>
            </tr>
        </tfoot>
    </table>
    <center>
        <a href="<?php echo Yii::app()->createUrl('frontend/orders/Informpayment') ?>">
            <div class="btn btn-success btn-sm" style="font-size:20px;"><i class="fa fa-hand-o-up"></i> แจ้งการชำระเงิน</div>
        </a>
    </center>
</div>

<div class="well" style=" background: none;">
    <label id="font-rsu-20"><i class="fa fa-bank"></i>ชำระเงินผ่านธนาคาร</label>
    <table class="table table-bordered" id="font-20">
        <thead>
            <tr>
                <td colspan="2" style="text-align: center;">ธนาคาร</td>
                <td style="text-align: center;">เลขที่บัญชี</td>
                <td>สาขา</td>
                <td>ชื่อบัญชี</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($payment as $rs): $i++;
                ?>
                <tr>
                    <td style="text-align:center;">
                        <img src="<?php echo Yii::app()->baseUrl . '/images/' . $rs['bank_img']; ?>" width="30"/>
                    </td>
                    <td>
                        <?php echo $rs['bank_name']; ?>
                    </td>
                    <td style="text-align: center;"><?php echo $rs['bookbank_number']; ?></td>
                    <td><?php echo $rs['bank_branch']; ?></td>
                    <td><?php echo $rs['bookbank_name']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
