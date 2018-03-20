
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
        <div class="row" style=" margin: 0px;">
            <div class="col-md-2 col-lg-1 col-sm-3 col-xs-3" style=" text-align: center; padding-top: 8px;">
                <label>สาขา</label>
            </div>
            <div class="col-md-6 col-lg-3 col-sm-6 col-xs-5">
                <select id="branch" class="form-control">
                    <?php foreach ($BranchList as $bs): ?>
                        <option value="<?php echo $bs['id'] ?>" <?php echo ($branch == $bs['id']) ? "selected" : "" ?>><?php echo $bs['branchname'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-3 col-xs-4">
                <button type="button" class="btn btn-default btn-block" onclick="Getemployee()"><i class="fa fa-search"></i> ตกลง</button>
            </div>
        </div>

    </div>
    <div class="panel-body" style=" padding: 0px; padding-top: 10px;">
        <center>
            <a href="<?php echo Yii::app()->createUrl('employee/create') ?>">
                <button type="button" class="btn btn-success" id="btn-btn-search"><i class="fa fa-user-plus"></i> เพิ่มข้อมูล</button></a>
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
