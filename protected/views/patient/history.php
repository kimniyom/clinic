<?php 
$config = new Configweb_model();
?>
<div class="list-group">
    <?php foreach($history as $rs): 
        $url = Yii::app()->createUrl('doctor/patientviewhistory',array("id" => $rs['patient_id'],"service_id" => $rs['id'],"flag" => "room"));
        ?>
    <a href="javascript:PopupCenter('<?php echo $url ?>','ประวัติการบริการ')" class="list-group-item" style=" border-radius: 0px; border-left: none; border-right: 0px; color: #406702; font-size: 12px;">
        <?php echo $config->thaidate($rs['service_date']) ?>
        <span class="badge"><?php echo $rs['branchname'] ?></span>
    </a>
    <?php endforeach; ?>
</div>
