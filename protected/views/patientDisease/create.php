<?php
/* @var $this PatientDiseaseController */
/* @var $model PatientDisease */

$this->breadcrumbs = array(
    'Patient Diseases' => array('index'),
    'Create',
);

$patientdisease = PatientDisease::model()->findAll("patient_id = '$patient_id' ");
?>

<h1>ข้อมูลโรคประจำตัว</h1>

<hr/>

<input type="hidden" id="patient_id" value="<?php echo $patient_id ?>"/>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-lg-10">
                <input type="text" id="disease" class="form-control"/>
            </div>
            <div class="col-lg-2">
                <button type="button" class="btn btn-success btn-block" onclick="Adddisease()">เพิ่ม</button>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>โรคประจำตัว</th>
                <th style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($patientdisease as $rs): $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $rs['disease']; ?></td>
                    <td style=" text-align: center;">
                        <a href="javascript:deletedisease('<?php echo $rs['id'] ?>')"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
     <div class="panel-footer" style=" text-align: right;">
        <a href="<?php echo Yii::app()->createUrl('patient/view',array("id" => $patient_id))?>">
            <button type="button" class="btn btn-default">ถัดไป <i class="fa fa-chevron-right"></i></button></a>
    </div>
</div>

<script type="text/javascript">
    loaddisease();
    function Adddisease() {
        var url = "<?php echo Yii::app()->createUrl('patientdisease/adddisease') ?>";
        var patient_id = $("#patient_id").val();
        var disease = $("#disease").val();
        if (disease == "") {
            $("#disease").focus();
            return false;
        }
        var data = {
            patient_id: patient_id,
            disease: disease
        };

        $.post(url, data, function (result) {
            window.location.reload();
        });
    }

    function deletedisease(id) {
        var url = "<?php echo Yii::app()->createUrl('patientdisease/deletedisease') ?>";
        var data = {
            id: id
        };

        $.post(url, data, function (result) {
            window.location.reload();
        });
    }

    function loaddisease() {
        var url = "<?php echo Yii::app()->createUrl('patientdisease/getdisease') ?>";
        var patient_id = "<?php echo $model['id'] ?>";
        var data = {patient_id: patient_id};

        $.post(url, data, function (result) {
            $("#result_disease").html(result);
        });
    }
</script>
