<?php
/* @var $this PatientDrugController */
/* @var $model PatientDrug */

$this->breadcrumbs = array(
    'Patient Drugs' => array('index'),
    'Create',
);

$patientdrug = PatientDrug::model()->findAll("patient_id = '$patient_id' ");
?>

<h1>ข้อมูลการแพ้ยา</h1>
<hr/>


<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-lg-10">
                <input type="text" id="drug" class="form-control"/>
            </div>
            <div class="col-lg-2">
                <button type="button" class="btn btn-success btn-block" onclick="Adddrug()"><i class="fa fa-save"></i> เพิ่ม</button>
            </div>
        </div>
    </div>
 
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>อาการแพ้ยา</th>
                    <th style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($patientdrug as $rs): $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $rs['drug']; ?></td>
                        <td style=" text-align: center;">
                            <a href="javascript:deletedrug('<?php echo $rs['id'] ?>')"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    
    <div class="panel-footer" style=" text-align: right;">
        <a href="<?php echo Yii::app()->createUrl('patientdisease/create',array("id" => $patient_id))?>">
            <button type="button" class="btn btn-default">ถัดไป <i class="fa fa-chevron-right"></i></button></a>
    </div>
</div>

<script type="text/javascript">
    function Adddrug() {
        var url = "<?php echo Yii::app()->createUrl('patientdrug/adddrug') ?>";
        var patient_id = $("#patient_id").val();
        var drug = $("#drug").val();
        if (drug == "") {
            $("#drug").focus();
            return false;
        }
        var data = {
            patient_id: patient_id,
            drug: drug
        };

        $.post(url, data, function (result) {
            window.location.reload();
        });
    }

    function deletedrug(id) {
        var url = "<?php echo Yii::app()->createUrl('patientdrug/deletedrug') ?>";
        var data = {
            id: id
        };

        $.post(url, data, function (result) {
            window.location.reload();
        });
    }

    function loaddrug() {
        var url = "<?php echo Yii::app()->createUrl('patientdrug/getdrug') ?>";
        var patient_id = "<?php echo $patient_id ?>";
        var data = {patient_id: patient_id};

        $.post(url, data, function (result) {
            $("#result_drug").html(result);
        });
    }
</script>
