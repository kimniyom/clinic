<?php
$this->breadcrumbs = array(
    //''=>array('index'),
    'รายงานขายสินค้าให้สาขาย่อย',
);


$yearNow = date("Y");
?>

<div class="row">
    <div class="col-lg-2 col-md-2" style=" text-align: center; padding-top: 5px;">
        เลือกปี
    </div>
    <div class="col-lg-3 col-md-3">
        <select id="year" class="form-control">
            <?php for ($i = $yearNow; $i >= ($yearNow - 3); $i--): ?>
                <option value="<?php echo $i ?>"><?php echo ($i + 543) ?></option>
            <?php endfor; ?>
        </select>
    </div>
    <div class="col-lg-2 col-md-2">
        <button type="button" class="btn btn-raised btn-info" style=" margin: 2px;" onclick="Getreport()">ตกลง</button>
    </div>
</div>

<div id="boxreport" style=" margin-top: 10px; margin-bottom: 0px; margin-right: 0px; padding-right: 5px;">
    <div id="result"></div>
</div>

<script type="text/javascript">
    Getreport();
    function Getreport() {
        $("#result").html("Loading...");
        var url = "<?php echo Yii::app()->createUrl('reportstorecenter/reportincome') ?>";
        var year = $("#year").val();
        var data = {year: year};
        $.post(url, data, function (datas) {
            $("#result").html(datas);
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
