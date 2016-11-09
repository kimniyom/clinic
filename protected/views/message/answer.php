
<?php
foreach ($answer as $rs) {
    if (!empty($rs['images'])) {
        $img = "uploads/profile/" . $rs['images'];
    } else {
        $img = "images/User-null.png";
    }
    ?>
    <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
            <img class="media-object img-responsive" src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img ?>">
        </div>
        <div class="col-xs-10 col-sm-10 col-md-11 col-lg-11">
            <?php echo $rs['message'] ?>
            <font id="font-glay">
            <i class="fa fa-user"></i> <?php echo $rs['name'] . ' ' . $rs['lname'] ?><br/>
            <i class="fa fa-calendar"></i> <?php echo $web->thaidate($rs['date_send'])?>
            <i class="fa fa-clock-o"></i> <?php echo $rs['ip'] ?>
        </div>
    </div>
<hr/>
<?php } ?>




