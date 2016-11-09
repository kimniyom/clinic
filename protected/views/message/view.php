<?php
$this->breadcrumbs = array(
    'ข้อความ',
);
?>
<div class="panel panel-default">
    <div class="panel-heading">ข้อความ</div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th colspan="2"><i class="fa fa-users"></i> ข้อความ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($msg as $rs) {
                $read = $model->Get_read_message($rs['id']);
                if ($read == '1') {
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
                        <a href="<?php echo Yii::app()->createUrl('frontend/message/detail/id/' . $rs['id']) ?>">
                            <h4 class="media-heading"><?php echo $rs['message'] ?></h4></a>
                        <font id="font-glay">
                        <i class="fa fa-user"></i> คุณ ถึง ผู้ดูแล
                        <i class="fa fa-calendar"></i> <?php echo $web->thaidate($rs['date_send']) ?>
                        <i class="fa fa-clock-o"></i> <?php echo $rs['ip'] ?>
                        </font>

                    </td>
                </tr>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>
