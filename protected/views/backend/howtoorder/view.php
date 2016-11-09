
<?php
$this->breadcrumbs = array(
    "วิธีการสั่งซื้อ"
        )
?>

<div class="panel panel-default">
    <div class="panel-heading">
        วิธีการสั่งซื้อ
        <a href="<?php echo Yii::app()->createUrl('backend/howtoorder/create'); ?>">
            <button type="button" class="pull-right"><i class="fa fa-pencil"></i></button></a>
    </div>
    <div class="panel-body">
        <?php if (!empty($howtoorder)) { ?>
            <?php echo $howtoorder; ?>
        <?php } else { ?>
            <center>
                <a href="<?php echo Yii::app()->createUrl('backend/howtoorder/create'); ?>">
                <div class="btn btn-default" style="text-align: center; font-size: 24px; color: #999999;">
                    <i class="fa fa-plus-circle fa-5x"></i> <br/>สร้าง
                </div></a>
            </center>
        <?php } ?>
    </div>
</div>
