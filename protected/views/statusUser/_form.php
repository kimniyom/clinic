<?php
/* @var $this StatusUserController */
/* @var $model StatusUser */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'status-user-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <p style=" color: #ff0000;">
        <?php echo $form->errorSummary($model); ?>
    </p>
    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'status'); ?>
        </div>
        <div class="col-lg-10">
            <?php echo $form->textField($model, 'status', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'status'); ?>
        </div>
    </div>
    
    <div class="row" style=" margin-top: 20px;">
        <div class="col-lg-2"></div>
        <div class="col-lg-10">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-success')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->