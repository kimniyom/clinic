<?php
/* @var $this PatientContactController */
/* @var $model PatientContact */
/* @var $form CActiveForm */
?>
<style type="text/css">
    .form .row{
        margin-bottom: 10px;
    }
</style>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'patient-contact-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'patient_id'); ?>
        </div>
        <div class="col-lg-3">
            <?php echo $form->textField($model, 'patient_id', array('value' => $id, 'class' => 'form-control', 'readonly' => 'readonly')); ?>
            <?php echo $form->error($model, 'patient_id'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'tel'); ?>
        </div>
        <div class="col-lg-3">
            <?php echo $form->textField($model, 'tel', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'tel'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'email'); ?>
        </div>
        <div class="col-lg-6">
            <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'number'); ?>
        </div>
        <div class="col-lg-10">
            <?php echo $form->textField($model, 'number', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'number'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'changwat'); ?>
        </div>
        <div class="col-lg-5">

            <?php
            $form->widget('booster.widgets.TbSelect2', array(
                'model' => $model,
                'asDropDownList' => true,
                'attribute' => 'changwat',
                //'name' => 'oid',
                'data' => CHtml::listData(Changwat::model()->findAll(""), 'changwat_id', 'changwat_name'),
                //'value' => $model,
                'htmlOptions' => array(
                    //'name' => 'changwat',
                    'id' => 'changwat',
                ),
                'options' => array(
                    //$model,
                    //'oid',
                    //'tags' => array('clever', 'is', 'better', 'clevertech'),
                    'placeholder' => 'จังหวัด',
                    'width' => '100%',
                //'tokenSeparators' => array(',', ' ')
                )
            ));
            ?>
            <?php echo $form->error($model, 'changwat'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'amphur'); ?>
        </div>
        <div class="col-lg-5">

            <div id="_amphur"></div>
            <?php echo $form->error($model, 'amphur'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'tambon'); ?>
        </div>
        <div class="col-lg-2">
            <div id="_tambon"></div>
            <?php echo $form->error($model, 'tambon'); ?>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'zipcode'); ?>
        </div>
        <div class="col-lg-3">
            <?php echo $form->textField($model, 'zipcode', array('size' => 5, 'maxlength' => 5, 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'zipcode'); ?>
        </div>
    </div>

    <div class="row buttons">
        <div class="col-lg-2"></div>
        <div class="col-lg-10">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn btn-success")); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    ampur();
    $(document).ready(function () {
        $( "#amphur option:selected" ).val(<?php echo $model->amphur ?>);
        $("#changwat").change(function () {
            var url = "<?php echo Yii::app()->createUrl('patientcontact/amphur') ?>";
            var changwat = $("#changwat").val();
            var data = {changwat: changwat};
            $.post(url, data, function (result) {
                $("#_amphur").html(result);
            });
        });
    });

    function ampur() {
        var url = "<?php echo Yii::app()->createUrl('patientcontact/amphur') ?>";
        var changwat = $("#changwat").val();
        var amphur = "<?php echo $model->amphur ?>";
        var tambon = "<?php echo $model->tambon ?>";
        var data = {
            changwat: changwat,
            amphur: amphur,
            tambon: tambon
        };
        $.post(url, data, function (result) {
            $("#_amphur").html(result);
        });
    }
</script>