<?php
/* @var $this CompanycenterController */
/* @var $model Companycenter */
/* @var $form CActiveForm */
?>
<style type="text/css">
    .row{
        margin-bottom: 10px;
    }
</style>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'companycenter-form',
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
        <div class="col-md-2 col-lg-2"><?php echo $form->labelEx($model, 'companyname'); ?></div>
        <div class="col-md-10 col-lg-10">
            <?php echo $form->textField($model, 'companyname', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'companyname'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 col-lg-2">
            <?php echo $form->labelEx($model, 'address'); ?>
        </div>
        <div class="col-md-10 col-lg-10">
            <?php echo $form->textArea($model, 'address', array('rows' => 6, 'cols' => 50)); ?>
            <?php echo $form->error($model, 'address'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 col-lg-2">
            <?php echo $form->labelEx($model, 'tel'); ?>
        </div>
        <div class="col-md-10 col-lg-10">
            <?php echo $form->textField($model, 'tel', array('size' => 15, 'maxlength' => 15)); ?>
            <?php echo $form->error($model, 'tel'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 col-lg-2">
            <?php echo $form->labelEx($model, 'memager'); ?>
        </div>
        <div class="col-md-10 col-lg-10">
            <?php echo $form->textField($model, 'memager', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'memager'); ?>
        </div>
    </div>

    <div class="row buttons">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-10 col-lg-10">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-success')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->