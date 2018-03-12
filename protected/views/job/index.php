<?php
$this->breadcrumbs = array(
    'พนักงาน' => array('employee/index'),
    'Jobs',
);

$yearnow = date("Y");
$month = Month::model()->findAll();
$yearNow = date("Y");
$monthNow = date("m");
if (strlen($monthNow) < 2) {
    $monthNows = "0" . $monthNow;
} else {
    $monthNows = $monthNow;
}
?>
<div class="well well-sm" style=" margin: 0px;">
    <h4>บันทึกการทำงาน (<?php echo $employee['name'] . " " . $employee['lname'] ?>)</h4>
    <div class="row" style=" margin: 0px; margin-bottom: 10px;">
        <div class="col-lg-3 col-md-3 col-sm-6">
            เลือกปี พ.ศ.
            <select id="year" class="form-control" onchange="getjob()">
                <?php for ($i = $yearnow; $i >= ($yearnow - 1); $i--): ?>
                    <option value="<?php echo $i ?>"><?php echo $i + 543 ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-6">
            ประจำเดือน
            <select id="month" class="form-control" onchange="getjob()">
                <?php foreach ($month as $m): ?>
                    <option value="<?php echo $m['id'] ?>" <?php echo ($monthNows == $m['id']) ? "selected" : ""; ?>><?php echo $m['month_th'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <input type="hidden" id="type"/>
    <div class="row" style="margin:0px;">
        <div class="col-sm-6 col-md-3 col-lg-3">
            <label>เลือกรายการ</label>
            <select id="commision" class="form-control" onchange="getcommision(this.value)">
                <option value="">== คอมมิชชั่น ==</option>
                <?php foreach ($mascommision as $rs): ?>
                    <option value="<?php echo $rs['id'] ?>"><?php echo $rs['commisionname'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-sm-6 col-md-2 col-lg-2">
            <label>อัตตราการคำนวน</label>
            <input type="hidden" class="form-control" id="valuecome"/>
            <input type="text" class="form-control" id="valuecometext" readonly="readonly" style=" text-align: center; color: #ffffff;"/>
        </div>
        <div class="col-sm-6 col-md-2 col-lg-2">
            <label>ยอด</label>
            <input type="text" class="form-control" id="total" onkeyUp="if(this.value*1!=this.value) { this.value=''; } else { calculatorpercent() }" style=" text-align: center;"/>
        </div>
        <div class="col-sm-6 col-md-2 col-lg-2">
            <label>ค่าตอบแทน / บาท</label>
            <input type="text" class="form-control" id="result" readonly="readonly" style=" text-align: center; color: #33ff33; font-weight: bold;"/>
        </div>
        <div class="col-sm-3 col-md-2 col-lg-2">
            <button type="button" class="btn btn-default" style=" margin-top: 25px;" onclick="savecommision()"><i class="fa fa-save"></i> บันทึก</button>
        </div>
    </div>

    <div id="resultjob"></div>

</div>
<script type="text/javascript">
    getjob();
    function getcommision(id) {
        var url = "<?php echo Yii::app()->createUrl('mascommision/getcommision') ?>";
        var data = {id: id};
        $("#total").val("");
        $("#result").val("");
        $.post(url, data, function (datas) {
            $("#valuecome").val(datas.value);
            $("#valuecometext").val(datas.value + " " + datas.typetext);
            $("#type").val(datas.type);
            if (datas.type == "0") {
                $("#total").prop('disabled', false);
                $("#result").prop('disabled', false);
                $("#result").val("");
            } else {
                $("#total").prop('disabled', false);
                $("#result").val(datas.value);
                $("#result").prop('disabled', true);
            }
        }, 'json');
    }

    function calculatorpercent() {
        var total = $("#total").val();
        var valuecome = $("#valuecome").val();
        var type = $("#type").val();
        var result;
        if (valuecome == "") {
            alert("ยังไม่ได้เลือกรายการ ...");
            $("#total").val("");
            return false;
        }
        if (type == "0") {
            result = (valuecome * total) / 100;
        } else {
            result = valuecome;
        }
        $("#result").val(result);
    }

    function savecommision() {
        var url = "<?php echo Yii::app()->createUrl('job/create') ?>";
        var employee = "<?php echo $employee['id'] ?>";
        var commision = $("#commision").val();
        var year = $("#year").val();
        var month = $("#month").val();
        var total = $("#total").val();
        var result = $("#result").val();

        if (commision == "" || total == "") {
            alert("ยังไม่ได้เลือกรายการ ...");
            return false;
        }
        var data = {employee: employee, commision: commision, total: total, result: result,year: year,month: month};
        $.post(url, data, function (datas) {
            getjob();
            $("#commision").val("");
            getcommision("");
        });
    }

    function getjob() {
        var url = "<?php echo Yii::app()->createUrl('job/getjob') ?>";
        var employee = "<?php echo $employee['id'] ?>";
        var year = $("#year").val();
        var month = $("#month").val();
        var data = {employee: employee,year: year,month: month};
        $.post(url, data, function (datas) {
            $("#resultjob").html(datas);
        });
    }
</script>