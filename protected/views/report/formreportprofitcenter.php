<style type="text/css">
    .well{
        background: #ffffff;
    }
</style>

<?php

$this->breadcrumbs=array(
	//''=>array('index'),
	'รายงาน กำไร ขาดทุนคลังสินค้ากลาง',
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

<div id="showreport"></div>

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