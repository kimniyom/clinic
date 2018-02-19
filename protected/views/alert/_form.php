<?php
/* @var $this AlertController */
/* @var $model Alert */
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
        'id' => 'alert-form',
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
        <div class="col-lg-3">
            <?php echo $form->labelEx($model, 'alert_appoint'); ?>
        </div>
        <div class="col-lg-2">
            <?php echo $form->textField($model, 'alert_appoint', array("class" => 'form-control')); ?>
            <?php echo $form->error($model, 'alert_appoint'); ?>
        </div>
        <div class="col-lg-3">วัน</div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <?php echo $form->labelEx($model, 'alert_product'); ?>
        </div>
        <div class="col-lg-2">
            <?php echo $form->textField($model, 'alert_product', array("class" => 'form-control')); ?>
            <?php echo $form->error($model, 'alert_product'); ?>
        </div>
        <div class="col-lg-3">วัน</div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <?php echo $form->labelEx($model, 'alert_expire'); ?>
        </div>
        <div class="col-lg-2">
            <?php echo $form->textField($model, 'alert_expire', array("class" => 'form-control')); ?>
            <?php echo $form->error($model, 'alert_expire'); ?>
        </div>
        <div class="col-lg-3">วัน</div>
    </div>
    
    <div class="row">
        <div class="col-lg-3">
            <?php echo $form->labelEx($model, 'alert_repair'); ?>
        </div>
        <div class="col-lg-2">
            <?php echo $form->textField($model, 'alert_repair', array("class" => 'form-control')); ?>
            <?php echo $form->error($model, 'alert_repair'); ?>
        </div>
        <div class="col-lg-3">วัน</div>
    </div>
    <hr/>
    <div class="row buttons">
        <div class="col-lg-3">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => 'btn btn-primary')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->