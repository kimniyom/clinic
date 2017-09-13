<?php
$this->breadcrumbs = array(
    'รายงานเปรียบเทียบ ซื้อเข้าของเดือนที่แล้วกับเดือนปัจจุบัน',
);

$ReportModel = new Report();
$BranchModel = new Branch();

$Branch = Yii::app()->session['branch'];
$yearNow = date("Y");
?>
<div class="row">

    <div class="col-lg-1">
        <label style=" padding-top: 5px;">ปี พ.ศ. </label>
    </div>
    <div class="col-lg-2">
        <select id="year" name="year" class="form-control">
            <?php for ($i = $yearNow; $i >= ($yearNow - 1); $i--): ?>
                <option value="<?php echo $i ?>"><?php echo ($i + 543) ?></option>
            <?php endfor; ?>
        </select>
    </div>
    <div class="col-lg-1">
        <label style=" padding-top: 5px;">เดือน </label>
    </div>
    <div class="col-lg-2">
        <select id="month" name="month" class="form-control">
            <?php foreach ($month as $m): ?>
                <option value="<?php echo $m['id'] ?>" <?php if($m['id'] == $monthactive){ echo "selected";}?>><?php echo $m['month_th'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-lg-1">
        <label style=" padding-top: 5px;">สาขา </label>
    </div>
    <div class="col-lg-2">
        <?php
        if ($Branch == '99') {
            $majer = Branch::model()->findAll("active = '1'");
            ?>
            <select id="branch" name="branch" class="form-control">
                <?php foreach ($majer as $ms): ?>
                    <option value="<?php echo $ms['id'] ?>"><?php echo $ms['branchname'] ?></option>
                <?php endforeach; ?>
            </select>
        <?php } else { ?>
            <select id="branch" name="branch" class="form-control">
                <option value="<?php echo $Branch ?>"><?php echo Branch::model()->find("id = '$Branch' ")['branchname'] ?></option>
            </select>
        <?php } ?>
    </div>
    <div class="col-lg-3">
        <button type="button" class="btn btn-success" onclick="getdata()">ตกลง</button>
    </div>

</div>

<div id="result"></div>
<script type="text/javascript">
    getdata();
    function getdata() {
        $("#result").html("loading...");
        var url = "<?php echo Yii::app()->createUrl('report/datainputproductmonth') ?>";
        var year = $("#year").val();
        var month = $("#month").val();
        var branch = $("#branch").val();
        var data = {year: year, month: month,branch: branch};
        $.post(url,data,function(datas){
            $("#result").html(datas);
        });
    }
</script>

