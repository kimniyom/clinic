<?php
$config = new Configweb_model();
$type = $patient['type'];

if (!empty($patient['images'])) {
    $img_profile = "uploads/profile/" . $patient['images'];
} else {
    if ($patient['sex'] == 'M') {
        $img_profile = "images/Big-user-icon.png";
    } else if ($patient['sex'] == 'F') {
        $img_profile = "images/Big-user-icon-female.png";
    } else {
        $img_profile = "images/Big-user.png";
    }
}
?>
<hr/>

<table class="table table-bordered">
    <tbody>
        <tr>
            <td style=" width: 20%;">
                <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_profile; ?>" class="img-responsive img-thumbnail" id="img_profile"/>
            </td>
            <td id="font-20">
                ชื่อ - สกุล : 
                <a href="<?php echo Yii::app()->createUrl('patient/view', array('id' => $patient['id'])) ?>">
                    <?php echo Pername::model()->find("oid", $patient['oid'])['pername'] . $patient['name'] . ' ' . $patient['lname'] ?></a><br/>
                อายุ: <?php echo $config->get_age($patient['birth']) ?> ปี<br/>
                ประเภทลูกค้า: <?php echo Gradcustomer::model()->find("id = '$type'")['grad']; ?><br/>
                อาชีพ : <?php echo Occupation::model()->find("id", $patient['occupation'])['occupationname']; ?><br/>
                PID : <?php echo $patient['pid'] ?><br/>
            </td>
        </tr>
    </tbody>
</table>




