<?php
$config = new Configweb_model();
?>
<div class="list-group">
    <?php
    foreach ($sell as $rs):
        $url = Yii::app()->createUrl('patient/detailsell',array('sell_id' => $rs['sell_id']));
        ?>

        <a href="javascript:PopupBills('<?php echo $url ?>','รายละเอียดการขาย')" class="list-group-item" style=" border-radius: 0px; border-left: none; border-right: 0px; color: #406702; font-size: 12px;">
            <?php echo $config->thaidate($rs['date_sell']) ?>
            <?php echo $rs['sell_id'] ?>
        </a>
    <?php endforeach; ?>
</div>


