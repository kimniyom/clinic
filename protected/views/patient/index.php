<title>ทะเบียนลูกค้า</title>
<?php
/* @var $this EmployeeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'ทะเบียนลูกค้า',
);

$system = new Configweb_model();
$branchModel = new Branch();
$typeModel = new Gradcustomer();
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
                <button type="button" class="btn btn-default btn-block" onclick="getdata()"><i class="fa fa-search"></i> ตกลง</button>
            </div>
        </div>

    </div>
    <div class="panel-body" style="padding:0px; padding-top: 10px;">
        <center>
            <button type="button" id="btn-btn-search" class="btn btn-success" onclick="CheckPatient()"><i class="fa fa-user-plus"></i> เพิ่มข้อมูล</button>
        </center>
        <div id="showdata" style=" margin-top: 10px;"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        getdata();
    });

    function getdata() {
        var loading = '<i class="fa fa-spinner fa-spin fa-fw"></i>';
        $("#loading").html(loading);
        var branch = $("#branch").val();
        var url = "<?php echo Yii::app()->createUrl('patient/getdata') ?>";
        var data = {branch: branch};
        $.post(url, data, function (datas) {
            $("#loading").html('');
            $("#showdata").html(datas);
        });
    }
</script>


<!-- 
    ####################
    ### POPUPPATIENT ###
    ####################
-->
<div class="modal fade" tabindex="-1" role="dialog" id="popuppatient" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เช็คลูกค้า</h4>
            </div>
            <div class="modal-body">
                <label>รหัสบัตรประชาชน 13 หลัก</label>
                <input type="text" class="form-control" id="card" maxlength="13" style="text-align: center;" onKeyUp="if(this.value*1!=this.value) this.value='' ;"/>
                <?php
                //$this->widget("ext.maskedInput.MaskedInput", array(
                //"model" => $model,
                //"attribute" => "card",
                //"id" => 'card',
                //"name" => 'card',
                //"mask" => '9-9999-99999-99-9',
                //"clientOptions" => array("autoUnmask" => true, "id" => "card"), /* autoUnmask defaults to false */
                //"defaults" => array("removeMaskOnSubmit" => false),
                /* once defaults are set will be applied to all the masked fields  removeMaskOnSubmit defaults to true */
                //));
                ?>
                <div id="error"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" onclick="Check()">ตกลง</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<script type="text/javascript">
    function deletpatient(id) {
        var r = confirm("คุณแน่ใจหรือไม่ ...");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('patient/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }

    function CheckPatient() {
        $("#popuppatient").modal();
    }

    function Check() {
        var url = "<?php echo Yii::app()->createUrl('patient/checkpatient') ?>";
        var card = document.querySelector('[name="card"]').value;
        var data = {card: card};

        if (card == '') {
            $("#card").focus();
            return false;
        }

        $.post(url, data, function (result) {
            if (result == 1) {
                $("#error").html("<p style='color:red;'>มีการลงทะเบียนลูกค้าในระบบแล้ว ... </p>");
            } else {
                var utlcreate = "<?php echo Yii::app()->createUrl('patient/create') ?>";
                window.location = utlcreate;
            }
        });
    }
</script>
