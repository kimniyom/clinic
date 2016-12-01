<div class="panel panel-default" style=" border-top: none;">
    <div class="panel-body">
        <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style=" text-align: center; width: 5%;">#</th>
            <th>รายงาน</th>
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
                <td><?php echo $rs['report_name'] ?></td>
                <td style=" text-align: center; width: 5%;">
                    <?php if (!empty($rs['report_id'])) { ?>
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

