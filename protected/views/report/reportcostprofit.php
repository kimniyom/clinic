<?php

$this->breadcrumbs=array(
	//''=>array('index'),
	'รายงานต้นทุน กำไร',
);


$yearnow = date("Y");
$branchlist = Branch::model()->findAll("active = '1'");
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
            <option value="">== ทั้งหมด ==</option>
            <?php foreach ($branchlist as $rs): ?>
                <option value="<?php echo $rs['id'] ?>"><?php echo $rs['branchname'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-lg-2" style=" padding-top: 20px;">
        <button type="button" class="btn btn-default btn-block" onclick="getreport()">ตกลง</button>
    </div>
</div>

<div id="showreport"></div>

<script type="text/javascript">
    getreport();
    function getreport() {
        var url = "<?php echo Yii::app()->createUrl('report/datareportcostprofit') ?>";
        var year = $("#year").val();
        var branch = $("#branch").val();
        var data = {year: year,branch: branch};
        $.post(url, data, function (datas) {
            $("#showreport").html(datas);
        });
    }
</script>
