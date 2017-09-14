รายงานสาขา
<ul class="list-group">
    <?php
    $i = 0;
    foreach ($menu as $rs): $i++;
        ?>
        <li class="list-group-item" id="font-18">
            <?php if (!empty($rs['report_id'])) { ?>
                <input type="checkbox" checked="checked" onclick="deletemenu('<?php echo $rs['id'] ?>')"/>
            <?php } else { ?>
                <input type="checkbox" onclick="setmenu('<?php echo $rs['id'] ?>')"/>
            <?php } ?>
            <?php echo $rs['report_name'] ?>
        </li>
    <?php endforeach; ?>
</ul>

รายงานคลังสินค้าหลัก
<ul class="list-group">
    <?php
    $a = 0;
    foreach ($menucenter as $rs): $a++;
        ?>
        <li class="list-group-item" id="font-18">
            <?php if (!empty($rs['report_id'])) { ?>
                <input type="checkbox" checked="checked" onclick="deletemenu('<?php echo $rs['id'] ?>')"/>
            <?php } else { ?>
                <input type="checkbox" onclick="setmenu('<?php echo $rs['id'] ?>')"/>
            <?php } ?>
            <?php echo $rs['report_name'] ?>
        </li>
    <?php endforeach; ?>
</ul>

<script type="text/javascript">
    function setmenu(report_id) {
        var user_id = $("#user_id").val();
        var url = "<?php echo Yii::app()->createUrl('rolereport/add') ?>";
        var data = {user_id: user_id, report_id: report_id};
        $.post(url, data, function (success) {
            getmenureport();
        });
    }

    function deletemenu(report_id) {
        var user_id = $("#user_id").val();
        var url = "<?php echo Yii::app()->createUrl('rolereport/unactivemenu') ?>";
        var data = {user_id: user_id, report_id: report_id};
        $.post(url, data, function (success) {
            getmenureport();
        });
    }
</script>


</div>
</div>

