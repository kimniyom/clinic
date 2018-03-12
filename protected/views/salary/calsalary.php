<?php
$this->breadcrumbs = array(
    //''=>array('index'),
    'คำนวนเงินเดือนพนักงาน',
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
<div class="row" style=" margin: 0px;">
    <div class="col-lg-3">
        เลือกสาขา
        <select id="branch" class="form-control">
            <?php foreach ($branchlist as $rs): ?>
                <option value="<?php echo $rs['id'] ?>"><?php echo $rs['branchname'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-lg-3">
        เลือกปี พ.ศ.
        <select id="year" class="form-control">
            <?php for ($i = $yearnow; $i >= ($yearnow - 1); $i--): ?>
                <option value="<?php echo $i ?>"><?php echo $i + 543 ?></option>
            <?php endfor; ?>
        </select>
    </div>
    <div class="col-md-3 col-lg-3">
        ประจำเดือน
        <select id="month" class="form-control">
            <?php foreach ($month as $m): ?>
                <option value="<?php echo $m['id'] ?>" <?php echo ($monthNows == $m['id']) ? "selected" : ""; ?>><?php echo $m['month_th'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-lg-2" style=" padding-top: 20px;">
        <button type="button" class="btn btn-default btn-block" onclick="getreport()"><i class='fa fa-search'></i> ตกลง</button>
    </div>
</div>

<div id="boxreport" class="wells" style=" margin-top: 10px; background: none;margin-bottom: 0px; border: 0px; box-shadow: 0px; padding: 0px;">
    <div class="row" style=" margin: 0px;">
        <div class="col-lg-12">
            <div id="showreport" style=" margin: 0px;"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    getreport();
    function getreport() {
        var url = "<?php echo Yii::app()->createUrl('salary/getemployees') ?>";
        var year = $("#year").val();
        var branch = $("#branch").val();
        var month = $("#month").val();
        var data = {year: year, branch: branch, month: month};
        $.post(url, data, function (datas) {
            $("#showreport").html(datas);
        });
    }
</script>

<script type="text/javascript">
    Setscreen();
    function Setscreen() {
        var screen = $(window).height();
        var w = window.innerWidth;
        var screenfull = (screen - 170);
        if (w >= 768) {
            $("#boxreport").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '0px'});
        }
    }

    function confirmsalary() {
        var url = "<?php echo Yii::app()->createUrl('salary/confirmsalarylist') ?>";
        var year = $("#year").val();
        var branch = $("#branch").val();
        var month = $("#month").val();
        var data = {year: year, branch: branch, month: month};
        $.post(url, data, function (datas) {
            window.location.reload();
        });
    }
</script>
