<div class="panel panel-default" style=" border-top: none;">
    <div class="panel-body">
        <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style=" text-align: center;">#</th>
            <th>เมนูตั้งค่า</th>
            <th style=" text-align: center;">เลือก</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($menu as $rs): $i++;
            ?>
            <tr>
                <td style=" width: 5%; text-align: center;"><?php echo $i ?></td>
                <td><?php echo $rs['setting'] ?></td>
                <td style=" text-align: center; width: 5%;">
                    <?php if (!empty($rs['setting_id'])) { ?>
                        <input type="checkbox" checked="checked" onclick="deletemenu('<?php echo $rs['id'] ?>')"/>
                    <?php } else { ?>
                        <input type="checkbox" onclick="setmenu('<?php echo $rs['id'] ?>')"/>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

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

