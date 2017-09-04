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
    <div class="panel-heading" style=" padding-bottom: 15px; padding-right: 5px; background: none;">
        <i class="fa fa-users"></i> ข้อมูลลูกค้า  <span id="loading"></span>
        <div class="pull-right">
            <button type="button" class="btn btn-default"
                    onclick="CheckPatient()"><i class="fa fa-user-plus"></i> เพิ่มข้อมูลลูกค้า</button>
        </div>
    </div>
    <div class="panel-body" style="padding: 10px;">
        <div class="row" style=" margin-top: 10px;">
            <div class="col-xs-3 col-lg-1 col-md-1" style=" text-align: center;"><label>สาขา*</label></div>
            <div class="col-xs-5 col-lg-3 col-md-3">
                <?php
                $this->widget('booster.widgets.TbSelect2', array(
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
            <div class="col-xs-3 col-md-3 col-lg-3">
                <button type="button" class="btn btn-default" onclick="getdata();">ค้นหา</button>
            </div>
        </div>
        <hr/>

        <div id="showdata"></div>
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

                <?php
                $this->widget("ext.maskedInput.MaskedInput", array(
                    //"model" => $model,
                    //"attribute" => "card",
                    //"id" => 'card',
                    "name" => 'card',
                    "mask" => '9-9999-99999-99-9',
                    "clientOptions" => array("autoUnmask" => true, "id" => "card"), /* autoUnmask defaults to false */
                    "defaults" => array("removeMaskOnSubmit" => false),
                        /* once defaults are set will be applied to all the masked fields  removeMaskOnSubmit defaults to true */
                ));
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
