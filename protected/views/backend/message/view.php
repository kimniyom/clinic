<?php
$this->breadcrumbs = array(
    'ข้อความ',
);
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th colspan="3"><i class="fa fa-users"></i> ข้อความจากสมาชิก</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($message as $rs) {
            if (!empty($rs['images'])) {
                $img = "uploads/profile/" . $rs['images'];
            } else {
                $img = "images/User-null.png";
            }

            if ($rs['status'] == '1') {
                $msg_status = "Read-Message-icon.png";
            } else {
                $msg_status = "Urgent-Message-icon.png";
            }
            ?>
            <tr>
                <td>
                    <img class="media-object img-responsive" src="<?php echo Yii::app()->baseUrl; ?>/images/<?php echo $msg_status ?>" style=" max-width: 50px;">
                </td>
                <td>
                    <img class="media-object img-responsive" src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img ?>" style=" max-width: 50px;">
                </td>
                <td>
                    <a href="<?php echo Yii::app()->createUrl('backend/message/detail/id/' . $rs['id']) ?>">
                        <h4 class="media-heading"><?php echo $rs['message'] ?></h4></a>
                    <font id="font-glay">
                    <i class="fa fa-user"></i> <?php echo $rs['name'] . ' ' . $rs['lname'] ?>
                    <i class="fa fa-calendar"></i> <?php echo $web->thaidate($rs['date_send']) ?>
                    <i class="fa fa-clock-o"></i> <?php echo $rs['ip'] ?>
                    </font>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
