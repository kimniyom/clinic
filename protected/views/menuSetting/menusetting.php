<ul class="list-group">
    <?php
    $i = 0;
    foreach ($menu as $rs): $i++;
        ?>
        <li class="list-group-item" id="font-18">
            <?php if (!empty($rs['setting_id'])) { ?>
                <input type="checkbox" checked="checked" onclick="deletemenu('<?php echo $rs['id'] ?>')"/>
            <?php } else { ?>
                <input type="checkbox" onclick="setmenu('<?php echo $rs['id'] ?>')"/>
            <?php } ?>
            <?php echo $rs['setting'] ?>
        </li>
    <?php endforeach; ?>
</ul>

<script type="text/javascript">
    function setmenu(setting_id) {
        var user_id = $("#user_id").val();
        var url = "<?php echo Yii::app()->createUrl('rolesetting/add') ?>";
        var data = {user_id: user_id, setting_id: setting_id};
        $.post(url, data, function (success) {
            getmenusetting();
        });
    }

    function deletemenu(setting_id) {
        var user_id = $("#user_id").val();
        var url = "<?php echo Yii::app()->createUrl('rolesetting/unactivemenu') ?>";
        var data = {user_id: user_id, setting_id: setting_id};
        $.post(url, data, function (success) {
            getmenusetting();
        });
    }
</script>


</div>
</div>

