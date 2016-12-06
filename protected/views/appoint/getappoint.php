<?php
$web = new Configweb_model();
?>
<h4 style=" padding-left: 10px; float: left;">คิวการนัด</h4>
<div style="padding-top:10px; color: #ff0000;">*คลิกวันที่เพื่อดูเวลานัด</div>
<?php if ($appoint) { ?>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th style=" width: 5%;">#</th>
                <th>วันที่</th>
                <th>เวลา</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($appoint as $ap): $i++;
                ?>
                <tr onclick="getday('<?php echo $ap['day'] ?>', '<?php echo $web->thaidate($ap['appoint']) ?>')" style=" cursor: pointer;">
                    <td style=" text-align: center;"><?php echo $i ?></td>
                    <td><?php echo $web->thaidate($ap['appoint']) ?></td>
                    <td><?php echo $ap['timeappoint'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php } else { ?>
    <h4 style=" text-align: center; color: #ff0000;">
        === ไม่มีรายการนัด ===
    </h4>
<?php } ?>
<script type="text/javascript">
    function getday(day, appoint) {
        var url = "<?php echo Yii::app()->createUrl('appoint/getdayappoint') ?>";
        var branch = "<?php echo Yii::app()->session['branch'] ?>";
        var month = $("#month").val();

        var data = {branch: branch, month: month, day: day};
        $.post(url, data, function (datas) {
            $("#headday").html("วันที่นัด " + appoint);
            $("#popupday").modal();
            $("#showappointday").html(datas);
        });

    }
</script>
