<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>เมนู</th>
            <th style=" text-align: center;">เเลือก</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0;foreach($menu as $rs): $i++;?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $rs['menu'] ?></td>
            <td style=" text-align: center;"><input type="checkbox" /></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

<script type="text/javascript">
    function setmenu(user_id,menu_id){
        var url = "<?php echo Yii::app()->createUrl('privilege/add')?>";
        var data = {user_id: user_id,menu_id: menu_id};
        $.post(url,data,function(success){
            menu();
        });
    }
</script>

