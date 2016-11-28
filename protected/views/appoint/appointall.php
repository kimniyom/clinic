<?php
$this->breadcrumbs = array(
    "ลูกค้านัดวันนี้",
);

?>


<?php
$config = new Configweb_model();
foreach ($appoints as $appoint):
    if (!empty($appoint['images'])) {
        $img_profile = "uploads/profile/" . $appoint['images'];
    } else {
        if ($appoint['sex'] == 'M') {
            $img_profile = "images/Big-user-icon.png";
        } else if ($appoint['sex'] == 'F') {
            $img_profile = "images/Big-user-icon-female.png";
        } else {
            $img_profile = "images/Big-user.png";
        }
    }
    ?>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <td style=" width: 20%;">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_profile; ?>" class="img-responsive img-thumbnail" id="img_profile"/>
                </td>
                <td id="font-20">
                    ชื่อ - สกุล : 
                    <a href="<?php echo Yii::app()->createUrl('dortor/patientview', array('id' => $appoint['id'],'appoint' => $appoint['id'])) ?>">
                        <?php echo $appoint['pername'] . $appoint['name'] . ' ' . $appoint['lname'] ?></a>
                    อายุ: <?php echo $config->get_age($appoint['birth']) ?> ปี<br/>
                    หัตถการ: <?php echo $appoint['diagname'] ?><br/>
                    วันที่รับบริการ : <?php echo $config->thaidate($appoint['service_date']) ?> วันที่นัด : <?php echo $config->thaidate($appoint['appoint']) ?> เวลา : <?php echo $appoint['timeappoint']?><br/>
                    ผลตรวจ : <?php echo $appoint['service_result'] ?>
                </td>
            </tr>
        </tbody>
    </table>

<?php endforeach; ?>




