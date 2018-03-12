<?php
$this->breadcrumbs = array(
    //''=>array('index'),
    'รายงานการขายสินค้า',
);

$branch = Yii::app()->session['branch'];
if (Yii::app()->session['branch'] == "99") {
    $branchlist = Branch::model()->findAll();
} else {
    $branchlist = Branch::model()->findAll("id=:id", array(":id" => $branch));
}
?>
<div class="row" style="margin:0px;">
    <div class="col-lg-3">
        วันที่เริ่มต้น
        <?php
        $this->widget(
                'booster.widgets.TbDatePicker', array(
            //'model' => $model,
            //'attribute' => 'birth',
            'name' => 'datestart',
            'id' => 'datestart',
            'value' => date("Y-m-d"),
            'options' => array(
                'language' => 'th',
                'type' => 'date',
                'format' => 'yyyy-mm-dd',
            )
                )
        );
        ?>
    </div>
    <div class="col-lg-3">
        วันที่สิ้นสุด
        <?php
        $this->widget(
                'booster.widgets.TbDatePicker', array(
            //'model' => $model,
            //'attribute' => 'birth',
            'name' => 'dateend',
            'id' => 'dateend',
            'value' => date("Y-m-d"),
            'options' => array(
                'language' => 'th',
                'type' => 'date',
                'format' => 'yyyy-mm-dd',
            )
                )
        );
        ?>
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
        <button type="button" class="btn btn-default btn-block" onclick="getreport()">ตกลง</button>
    </div>
</div>

<div id="showreport"></div>

<script type="text/javascript">
    getreport();
    function getreport() {
        var url = "<?php echo Yii::app()->createUrl('report/datareportsellproduct') ?>";
        var datestart = $("#datestart").val();
        var dateend = $("#dateend").val();
        var branch = $("#branch").val();
        var data = {datestart: datestart, dateend: dateend, branch: branch};
        $.post(url, data, function (datas) {
            $("#showreport").html(datas);
        });
    }
</script>
