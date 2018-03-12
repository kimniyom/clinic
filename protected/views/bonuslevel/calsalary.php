<?php
$this->breadcrumbs = array(
    //''=>array('index'),
    'คำนวนเงินเดือนพนักงาน',
);
$yearnow = date("Y");
?>
<div class="row">
    <div class="col-lg-3">
        เลือกปี พ.ศ.
        <select id="year" class="form-control">
            <?php for ($i = $yearnow; $i >= ($yearnow - 1); $i--): ?>
                <option value="<?php echo $i ?>"><?php echo $i + 543 ?></option>
            <?php endfor; ?>
        </select>
    </div>
    <div class="col-lg-3">
        เลือกสาขา
        <select id="branch" class="form-control">
            <?php foreach ($branchlist as $rs): ?>
                <option value="<?php echo $rs['id'] ?>"><?php echo $rs['branchname'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-lg-2" style=" padding-top: 20px;">
        <button type="button" class="btn btn-default btn-block" onclick="getreport()"><i class='fa fa-search'></i> ตกลง</button>
    </div>
</div>

<div id="boxreport" class="wells" style=" margin-top: 10px; background: none;margin-bottom: 0px; border: 0px; box-shadow: 0px; padding: 0px;">
    <div id="showreport" style=" margin: 0px;"></div>
</div>
<script type="text/javascript">
    getreport();
    function getreport() {
        var url = "<?php echo Yii::app()->createUrl('bonuslevel/getemployee') ?>";
        var year = $("#year").val();
        var branch = $("#branch").val();
        var data = {year: year, branch: branch};
        $.post(url, data, function (datas) {
            $("#showreport").html(datas);
        });
    }
</script>

<script type="text/javascript">
    Setscreen();
    function Setscreen() {
        var screen = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = (screen - 170);
        $("#boxreport").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '0px'});
        //$("#patientbox").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF'});
        //$("#boxorders").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF', 'overflow': 'auto', 'padding-left': '10px'});

    }
</script>
