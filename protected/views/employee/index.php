
<?php
/* @var $this EmployeeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'พนักงาน',
);

$system = new Configweb_model();
?>

<div class="panel panel-default" style=" margin-bottom: 0px;">

    <div class="panel-heading">
        <div class="row">
            <div class="col-md-2 col-lg-1 col-sm-3 col-xs-3" style=" text-align: center;">
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
                <button type="button" class="btn btn-success btn-block" onclick="Getemployee()"><i class="fa fa-search"></i> ตกลง</button>
            </div>
        </div>

    </div>
    <div class="panel-body">
        <center>
            <a href="<?php echo Yii::app()->createUrl('employee/create') ?>">
                <button type="button" class="btn btn-default"><i class="fa fa-user-plus"></i> เพิ่มข้อมูลพนักงาน</button></a>
        </center>
        <div id="result" style=" margin-top: 10px;"></div>
    </div>
</div>

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
