<?php
$config = new Configweb_model();
$type = $patient['type']
?>
<hr/>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ชื่อ - สกุล</th>
            <th>อายุ</th>
            <th>ประเภทลูกค้า</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><a href="<?php echo Yii::app()->createUrl('patient/view',array('id' => $patient['id']))?>"><?php echo $patient['name'] . ' ' . $patient['lname'] ?></a></td>
            <td><?php echo $config->get_age($patient['birth']) ?></td>
            <td><?php echo Gradcustomer::model()->find("id = '$type'")['grad']; ?></td>
        </tr>
    </tbody>
</table>
