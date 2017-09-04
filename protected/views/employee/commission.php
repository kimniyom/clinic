<style type="text/css">
    fieldset.scheduler-border {
        border: 1px groove #eeeeee !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #eeeeee;
        box-shadow:  0px 0px 0px 0px #eeeeee;
    }

    legend.scheduler-border {
        width:inherit; /* Or auto */
        padding:0 10px; /* To give a bit of padding on the left and right */
        border-bottom:none;
    }
</style>
<?php
/* @var $this EmployeeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'พนักงาน',
);

$system = new Configweb_model();
?>

<fieldset class="scheduler-border">
    <legend class="scheduler-border">
        :: ค้นหา ::
    </legend>
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <label>สาขา</label>
            <?php
            $this->widget(
                    'booster.widgets.TbSelect2', array(
                'name' => 'branch',
                'id' => 'branch',
                'data' => CHtml::listData($BranchList, 'id', 'branchname'),
                'value' => $branch,
                'options' => array(
                    'placeholder' => 'เลือกสาขา',
                    'width' => '100%',
                    'allowClear' => true,
                )
                    )
            );
            ?>
        </div>
        <div class="col-md-6 col-lg-3">
            <label>เดือน</label>
            <?php
            $monthNow = date("m");
            if(strlen($monthNow) < 2){
                $m = "0".$monthNow;
            } else {
                $m = $monthNow;
            }
            $this->widget(
                    'booster.widgets.TbSelect2', array(
                'name' => 'month',
                'id' => 'month',
                'data' => CHtml::listData($month, 'id', 'month_th'),
                'value' => $m,
                'options' => array(
                    'placeholder' => 'เดือน',
                    'width' => '100%',
                    'allowClear' => true,
                )
                    )
            );
            ?>
        </div>
        <div class="col-md-6 col-lg-3">
            <label>พ.ศ.</label>
            <select class=" form-control" id="year">
            <?php
            $yearNow = date("Y");
            for($i=$yearNow;$i>($yearNow-2);$i--):
            ?>
                <option value="<?php echo $i ?>"><?php echo ($i + 543) ?></option>
                <?php endfor; ?>
        </select>
        </div>
        <div class="col-md-2 col-lg-2">
            <button type="button" class="btn btn-success btn-block" onclick="Getemployee()">ตกลง</button>
        </div>
    </div>

</fieldset>

<div id="result"></div>


<script type="text/javascript">
    Getemployee();

    function Getemployee() {
        var url = "<?php echo Yii::app()->createUrl('employee/dataemployeecommission') ?>";
        var branch = $("#branch").val();
        var data = {branch: branch};
        $.post(url, data, function (success) {
            $("#result").html(success);
        });
    }
</script>
