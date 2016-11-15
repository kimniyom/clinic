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
    $defaultappoint = date("Y-m-d");
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
    </div>
</div>

<script type="text/javascript">
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
        var data = {id: id,appoint: appoint, service_id: service_id, branch: branch};
        $.post(url, data, function (success) {
            swal("Success", "บันทึกข้อมูลวันนัดสำเร็จ...", "success");
            //GetformAppoint();
        });
    }
</script>
