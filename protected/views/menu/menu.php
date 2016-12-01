<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="text-align: center;">#</th>
            <th>เมนู</th>
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
                <td><?php echo $rs['menu'] ?></td>
                <td style=" text-align: center; width: 5%;">
                    <?php if (!empty($rs['menu_id'])) { ?>
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
    function setmenu(menu_id) {
        var user_id = $("#user_id").val();
        var url = "<?php echo Yii::app()->createUrl('rolemenu/add') ?>";
        var data = {user_id: user_id, menu_id: menu_id};
        $.post(url, data, function (success) {
            menu();
        });
    }

    function deletemenu(menu_id) {
        var user_id = $("#user_id").val();
        var url = "<?php echo Yii::app()->createUrl('rolemenu/unactivemenu') ?>";
        var data = {user_id: user_id, menu_id: menu_id};
        $.post(url, data, function (success) {
            menu();
        });
    }
</script>

