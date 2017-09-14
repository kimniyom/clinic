<style type="text/css">
    .well{
        background: #ffffff;
    }
</style>

<?php
$this->breadcrumbs = array(
    //''=>array('index'),
    'รายงานรายรับ - รายจ่าย คลังสินค้ากลาง',
);


$yearnow = date("Y");
$branchlist = Branch::model()->findAll("active = '1'");
?>
<div class="row">
    <div class="col-lg-3 col-md-3">
        เลือกปี พ.ศ.
        <select id="year" class="form-control">
            <?php for ($i = $yearnow; $i >= ($yearnow - 4); $i--): ?>
                <option value="<?php echo $i ?>"><?php echo $i + 543 ?></option>
            <?php endfor; ?>
        </select>
    </div>
    <div class="col-lg-2 col-md-2">
        <button type="button" class="btn btn-default" style=" margin-top: 20px;" onclick="getreport()">ตกลง</button>
    </div>
</div>

<div id="boxreport" style=" margin-top: 10px; margin-bottom: 0px; margin-right: 0px; padding-right: 5px;">
    <div id="showreport" style=" margin-bottom: 0px;"></div>
</div>

<script type="text/javascript">
    getreport();
    function getreport() {
        var url = "<?php echo Yii::app()->createUrl('report/reportprofitcenter') ?>";
        var year = $("#year").val();
        //var branch = $("#branch").val();
        var data = {year: year};
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
        var screenfull = (screen - 163);
        $("#boxreport").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
        //$("#patientbox").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF'});
        //$("#boxorders").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF', 'overflow': 'auto', 'padding-left': '10px'});

    }


</script>