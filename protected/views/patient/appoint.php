<?php 
$config = new Configweb_model();
?>
<div class="list-group">
    <?php foreach($appoint as $rs): ?>
    <a href="javascript:viewappoint('<?php echo $rs['id']?>')" class="list-group-item" style=" border-radius: 0px; border-left: none; border-right: 0px; color: #406702; font-size: 12px;">
        <?php echo $config->thaidate($rs['appoint']) ?>
        <span class="badge"><?php echo $rs['branchname'] ?></span>
    </a>
    <?php endforeach; ?>
</div>

<script type="text/javascript">
    function deleteappoint(){
        var appoint_id = $("#appoint_id").val();
        var url = "<?php echo Yii::app()->createUrl('patient/deleteappoint')?>";
        var data = {appoint_id: appoint_id};
        $.post(url,data,function(datas){
            loadappoint();
            $("#popupviewappoint").modal("hide");
        });
    }
</script>



