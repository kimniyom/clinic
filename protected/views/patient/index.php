<?php
/* @var $this EmployeeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Patient',
);

$system = new Configweb_model();
$branchModel = new Branch();
$typeModel = new Gradcustomer();
?>

<h1>ข้อมูลลูกค้า</h1>
<a href="<?php echo Yii::app()->createUrl('patient/create') ?>"></a>
<button type="button" class="btn btn-default"
        onclick="CheckPatient()"><i class="fa fa-user-plus"></i> เพิ่มข้อมูลลูกค้า</button>
<hr/>
<table class="table table-bordered" id="patient">
    <thead>
        <tr>
            <th>#</th>
            <th>Pid</th>
            <th>Card</th>
            <th>Name - Lname</th>
            <th>สาขา</th>
            <th>ประเภท</th>
            <th style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($patient as $rs): $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $rs['pid'] ?></td>
                <td><?php echo $rs['card'] ?></td>
                <td><?php echo $rs['name'] . ' ' . $rs['lname'] ?></td>
                <td>
                    <?php 
                        $branchId = $rs['branch'];
                        echo $branchModel->find("id = '$branchId'")['branchname'];
                    ?>
                </td>
                <td>
                    <?php 
                        $typeId = $rs['type'];
                        echo $typeModel->find("id = '$typeId'")['grad'];
                    ?>
                </td>
                <td style="text-align: center;">
                    <a href="<?php echo Yii::app()->createUrl('patient/view', array('id' => $rs['id'])) ?>"><i class="fa fa-eye"></i></a>
                    <a href="<?php echo Yii::app()->createUrl('patient/update', array('id' => $rs['id'])) ?>"><i class="fa fa-pencil"></i></a>
                    <a href="javascript:deletpatient('<?php echo $rs['id'] ?>')"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

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
                    "clientOptions" => array("autoUnmask" => true,"id" => "card"), /* autoUnmask defaults to false */
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
    $(document).ready(function () {
        $("#patient").dataTable();
    });
    
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
