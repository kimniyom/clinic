<table class="table table-bordered" id="viewcarlendar">
    <thead>
        <tr>
            <th style=" text-align: center;">#</th>
            <th>ชื่อ - สกุล</th>
            <th style=" text-align: center; width: 5%;">เลือก</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($appoint as $rs): $i++;
            ?>
            <tr>
                <td style=" text-align: center; width: 5%;"><?php echo $i ?></td>
                <td>
                    <?php if (Yii::app()->session['status'] == '2') { ?>
                    <a href="<?php echo Yii::app()->createUrl('doctor/patientview',array("id"=>$rs['id'],"appoint" => '1'))?>"><?php echo $rs['name'] . " " . $rs['lname'] ?></a>
                    <?php } else { ?>
                        <?php echo $rs['name'] . " " . $rs['lname'] ?>
                    <?php } ?>
                </td>
                <td style="text-align: center;">
                    <a href="javascript:deleteappoint('<?php echo $rs['id'] ?>')"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<script type="text/javascript">
    $(document).ready(function () {
        $("#viewcarlendar").dataTable();
    });

    function deleteappoint(id) {
        var r = confirm("Are you sure ...");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('appoint/deleteappoint') ?>";
            var data = {id: id};
            $.post(url, data, function (datas) {
                window.location.reload();
            });
        }
    }
</script>
