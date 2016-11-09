<br/>
<?php
$this->breadcrumbs = array(
    "วิธีการชำระเงิน",
);
?>
<h4>
    *โอนเงินผ่านธนาคาร หรือตู้ ATM 
</h4>
<div class="panel panel-default">
    <div class="panel-heading"><h4>รายละเอียดบัญชีธนาคาร</h4></div>
    <div class="panel-body">
        <div class="row">
            <?php
            $i = 1;
            foreach ($payment as $rs): $i++;
                ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <img src="<?php echo Yii::app()->baseUrl . '/images/' . $rs['bank_img']; ?>" class="img-resize img-responsive"/>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                            <b style="font-size: 18px;"><?php echo $rs['bank_name']; ?></b><br/>
                            ชื่อบัญชี <?php echo $rs['bookbank_name']; ?><br/>
                            สาขา <?php echo $rs['bank_branch']; ?><br/>
                            <b>เลขที่บัญชี <?php echo $rs['bookbank_number']; ?></b>
                        </div>
                    </div>
                    <hr/>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
