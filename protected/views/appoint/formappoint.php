<?php
$branchList = Branch::model()->findAll("active = '1'");
if (empty($model['branch'])) {
    $branch = Yii::app()->session['branch'];

    if ($branch == "99") {
        $active = "";
        $disabled = "";
    } else {
        $active = $branch;
        $disabled = "disabled='disabled'";
    }
} else {
    $active = $model['branch'];
    $disabled = "disabled='disabled'";
}

if (!empty($model['appoint'])) {
    $defaultappoint = $model['appoint'];
} else {
    $defaultappoint = "";
}
?>
<input type="hidden" id="service_id" value="<?php echo $seq ?>"/>
<input type="hidden" id="id" value="<?php echo $model['id'] ?>"/>
<div class="panel panel-success" style=" border-top: none; border: none;">
    <div class="panel-heading"  style=" border-top: none; border-radius: 0px;">
        <i class="fa fa-calendar"></i> นัดลูกค้า
        <button type="button" class="btn btn-success btn-xs pull-right" style=" margin: 0px;" onclick="Saveappoint()">
            <i class="fa fa-save"></i> บันทึกข้อมูล
        </button>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <label>ลงวันที่นัด</label>
                <div id="sandbox-container">
                    <div class="input-group date">
                        <input type="text" class="form-control" id="appoint" value="<?php echo $defaultappoint ?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-lg-2">
                <label>ชั่วโมง</label>
                <select id="h" class="form-control">
                    <option value="">== ชั่วโมง ==</option>
                    <?php
                    for ($i = 0; $i <= 24; $i++):
                        if (strlen($i) < 2) {
                            $h = "0" . $i;
                        } else {
                            $h = $i;
                        }
                        ?>
                        <option value="<?php echo $h ?>" <?php
                        if ($h == $hs) {
                            echo "selected";
                        }
                        ?>><?php echo $h ?></option>
                            <?php endfor; ?>
                </select>
            </div>

            <div class="col-md-2 col-lg-2">
                <label>นาที</label>
                <select id="m" class="form-control">
                    <option value="">== นาที ==</option>
                    <?php
                    for ($a = 0; $a <= 59; $a++):
                        if (strlen($a) < 2) {
                            $m = "0" . $a;
                        } else {
                            $m = $a;
                        }
                        ?>
                        <option value="<?php echo $m ?>" <?php
                        if ($m == $ms) {
                            echo "selected";
                        }
                        ?>><?php echo $m ?></option>
                            <?php endfor; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <label>สาขา</label>
                <select id="branch" class="form-control">
                    <?php foreach ($branchList as $b): ?>
                        <option value="<?php echo $b['id'] ?>" <?php
                        if ($b['id'] == $active) {
                            echo "selected";
                        }
                        ?> <?php echo $disabled; ?>><?php echo $b['branchname'] ?></option>
                            <?php endforeach; ?>
                </select>
            </div>

        </div>

        <hr/>

        <div id="appointlist"></div>

    </div>
</div>

<script type="text/javascript">
    getappoint();
    $(function () {
        $('#sandbox-container .input-group.date').datepicker({
            language: 'th',
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });
    });

    function Saveappoint() {
        var url = "<?php echo Yii::app()->createUrl('appoint/saveappoint') ?>";
        var appoint = $("#appoint").val();
        var service_id = $("#service_id").val();
        var branch = $("#branch").val();
        var id = $("#id").val();
        var h = $("#h").val();
        var m = $("#m").val();
        var time = h + ":" + m;
        if (appoint == "") {
            swal("Alert", "กรุณาเลือกวันนัด...", "warning");
            getappoint();
            return false;
        }

        if (h == '' || m == '') {
            swal("Alert", "กรุณาเลือกเวลา...", "warning");
            return false;
        }
        var data = {id: id, appoint: appoint, time: time, service_id: service_id, branch: branch};
        $.post(url, data, function (success) {
            swal("Success", "บันทึกข้อมูลวันนัดสำเร็จ...", "success");
            //GetformAppoint();
        });
    }

    function getappoint() {
        var url = "<?php echo Yii::app()->createUrl('appoint/getappoint') ?>";
        var branch = $("#branch").val();
        var data = {branch: branch};
        $.post(url, data, function (datas) {
            $("#appointlist").html(datas);
        });
    }
</script>
