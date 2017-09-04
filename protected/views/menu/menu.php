<ul class="list-group" style=" margin-bottom: 0px;">
    <?php
    $i = 0;
    foreach ($menu as $rs): $i++;
        ?>
        <li class="list-group-item" id="font-18">
            <?php if (!empty($rs['menu_id'])) { ?>
                <input type="checkbox" checked="checked" onclick="deletemenu('<?php echo $rs['id'] ?>')"/>
            <?php } else { ?>
                <input type="checkbox" onclick="setmenu('<?php echo $rs['id'] ?>')"/>
            <?php } ?>
            <?php echo $rs['menu'] ?>
        </li>
    <?php endforeach; ?>
</ul>

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

