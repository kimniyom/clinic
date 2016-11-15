

<?php $web = new Configweb_model() ?>
<?php
foreach ($history as $rs):
    $url = Yii::app()->createUrl('historyservice/detailservice', array('patient_id' => $rs['patient_id'], 'diagcode' => $rs['diagcode'], 'service' => $rs['id']));
    ?>
    <!--
        <a href="javascript:PopupCenter('<?//php echo $url ?>')">
    -->
    <a href="javascript:history('<?php echo $rs['id'] ?>')">
        <div id="listmenu">
            <!--
            <img src="<?//php echo Yii::app()->baseUrl; ?>/images/clinic-icon.png"
                 height="32px" style="border-radius:20px; padding:2px; border:#FFF solid 2px; background: #FFFFFF;"/>
            -->
            <i class="fa fa-calendar"></i> <?php echo $web->thaidate($rs['service_date']) ?> คิวที่ (<?php echo $rs['id'] ?>)
        </div>
    </a>
<?php endforeach; ?>

<script type="text/javascript">
    function history(service_id) {
        var url = "<?php echo Yii::app()->createUrl('historyservice/result') ?>";
        var data = {service_id: service_id};
        $.post(url, data, function (datas) {
            $("#content-service").html(datas);
        });
    }
</script>
