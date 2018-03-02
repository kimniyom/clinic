<title>จ่ายเงินเดือน</title>
<?php
$this->breadcrumbs = array(
    'จ่ายเงินเดือน',
);

$month = Month::model()->findAll();
$yearNow = date("Y");
$monthNow = date("m");
if (strlen($monthNow) < 2) {
    $monthNows = "0" . $monthNow;
} else {
    $monthNows = $monthNow;
}
?>
<div class="row" style=" margin: 0px;">
    <div class="col-md-12 col-lg-12">
        <div class="well">
            <div class="row" style=" margin: 0px;">
                <div class="col-md-3 col-lg-3">
                    <label>ประจำปี</label>
                    <select id="year" class="form-control" onchange="loademployee()">
                        <?php for ($i = $yearNow; $i >= ($yearNow - 1); $i--): ?>
                            <option value="<?php echo $i ?>" <?php echo ($yearNow == $i) ? "selected" : ""; ?>><?php echo ($i + 543) ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-3 col-lg-3">
                    <label>ประจำเดือน</label>
                    <select id="month" class="form-control" onchange="loademployee()">
                        <?php foreach ($month as $m): ?>
                            <option value="<?php echo $m['id'] ?>" <?php echo ($monthNows == $m['id']) ? "selected" : ""; ?>><?php echo $m['month_th'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" style=" margin: 0px;">
    <div class="col-md-6 col-lg-6">
        <div class="panel panel-default" style=" margin-bottom: 0px;">
            <div class="panel-heading">รายชื่อพนักงาน</div>
            <div class="panel-body" id="box-em-left">

                <!--
                <ul class="list-group">
                <?php
                //$i = 0;
                //foreach ($employee as $rs): $i++;
                ?>
                    <li class="list-group-item" id="in<?php //echo $i   ?>">
                <?php //echo $rs['name'] . " " . $rs['lname'] ?> (<?php //echo number_format($rs['salary']) ?>)   
                            <button type="button" class="btn btn-default" onclick="selectemployee('<?php //echo $i   ?>', '<?php //echo $rs['pid']   ?>', '<?php //echo $rs['salary']   ?>', '<?php //echo $rs['name']   ?>', '<?php //echo $rs['lname']   ?>')" style=" position: absolute;right: 3px; top: 3px;">
                                เลือก <i class="fa fa-chevron-right" style=" margin: 0px;"></i>
                            </button>    
                        </li>
                <?php //endforeach; ?>
                </ul>
                -->
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6">
        <div class="panel panel-default" style=" margin-bottom: 0px;">
            <div class="panel-heading">รายชื่อที่เลือก<input type="hidden" id="sumsalary" class="form-control"/></div>
            <div class="panel-body" id="box-em-right">
                <div class="list-group" id="box-em-right-body" style=" margin: 0px; padding: 0px;"></div>
            </div>
            <div class="panel-footer">
                <button type="button" class="btn btn-success" onclick="GetdataEmployee()"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    screen();
    loademployee();
    function loademployee() {
        var url = "<?php echo Yii::app()->createUrl('salary/getemployee') ?>";
        var year = $("#year").val();
        var month = $("#month").val();
        var data = {year: year, month: month};
        $.post(url, data, function (datas) {
            $("#box-em-left").html(datas);
            $("#box-em-right-body").html("");
            $("#sumsalary").val("");
        });
    }

    function screen() {
        var screen = window.innerHeight;
        var wight = window.innerWidth;
        if (wight > 768) {
            var h = screen - 270;
            $("#box-em-left").css({'height': h, 'overflow': 'auto'});
            $("#box-em-right").css({'height': h - 60, 'overflow': 'auto'});
        }
    }

    function selectemployee(id, pid, salary, name, lname) {
        $("#in" + id).hide();
        var sum = $("#sumsalary").val();
        var salarys = parseInt(salary);
        var sums;
        if (sum == "") {
            sums = 0;
        } else {
            sums = parseInt(sum);
        }
        var total = (sums + salarys);
        $("#sumsalary").val(total);
        addRow(id, pid, salary, name, lname);
    }

    function addRow(id, pid, salary, name, lname) {
        var datas = "<li class='list-group-item' id='remove" + id + "' style='padding-left:100px;'>"
                + "<button type='button' class='btn btn-danger' onclick='removeemployee(" + id + "," + salary + ")' style='position: absolute;left: 3px; top: 3px;'><i class='fa fa-chevron-left'></i> เอาออก</button>" + name + lname + "</li>"
                + "<input type='hidden' id='outemployee' value='" + pid + "' class='remove" + id + "'/>"
                + "<input type='hidden' id='outsalary' value='" + salary + "' class='remove" + id + "'/>";
        $("#box-em-right-body").append(datas);
    }

    function GetdataEmployee() {
        var ArrPID = [];
        var ArrSalary = [];
        var month = $("#month").val();
        var year = $("#year").val();
        var url = "<?php echo Yii::app()->createUrl('salary/savelist') ?>";
        var sum = $("#sumsalary").val();
        if (sum == "" || sum == "0") {
            alert("กรุณาเลือกรายชื่อพนักงาน");
            return false;
        }
        $('#box-em-right-body input#outemployee').each(function () {
            ArrPID.push($(this).val());
        });

        $('#box-em-right-body input#outsalary').each(function () {
            ArrSalary.push($(this).val());
        });
        var data = {ArrPID, ArrSalary, month: month, year: year, sum: sum};
        $.post(url, data, function (success) {
            loademployee();
            //console.log(success);
        });
    }

    function removeemployee(id, salary) {
        var sum = $("#sumsalary").val();
        var salarys = parseInt(salary);
        var sums;
        if (sum == "") {
            sums = 0;
        } else {
            sums = parseInt(sum);
        }
        var total = (sums - salarys);
        $("#sumsalary").val(total);

        $("#in" + id).show();
        $("#remove" + id).remove();
        $(".remove" + id).remove();
    }
</script>