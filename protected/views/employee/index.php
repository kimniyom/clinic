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
        <a href="<?php echo Yii::app()->createUrl('employee/create') ?>">
            <button type="button" class="btn btn-default"><i class="fa fa-user-plus"></i> เพิ่มข้อมูลพนักงาน</button></a>
    </legend>
    <div class="row">
        <div class="col-md-3 col-lg-2 col-sm-3 col-xs-3">
            <label>สาขา</label>
        </div>
        <div class="col-md-6 col-lg-3 col-sm-6 col-xs-5">

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
        <div class="col-md-2 col-lg-2 col-sm-3 col-xs-4">
            <button type="button" class="btn btn-success btn-block" onclick="Getemployee()">ตกลง</button>
        </div>
    </div>

</fieldset>

<div id="result"></div>


<script type="text/javascript">
    Getemployee();
    function deletemployee(id) {
        var r = confirm("คุณแน่ใจหรือไม่ ... ข้อมูลที่เกี่ยวข้องกับพนักงานจะถูกลบทั้งหมด ... ?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('employee/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }

    function Getemployee() {
        var url = "<?php echo Yii::app()->createUrl('employee/dataemployee') ?>";
        var branch = $("#branch").val();
        var data = {branch: branch};
        $.post(url, data, function (success) {
            $("#result").html(success);
        });
    }
</script>
