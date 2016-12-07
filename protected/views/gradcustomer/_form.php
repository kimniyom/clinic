<?php
/* @var $this GradcustomerController */
/* @var $model Gradcustomer */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'gradcustomer-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <font style=" color: #ff0000;"><?php echo $form->errorSummary($model); ?></font>

    <div class="row">
        <div class="col-md-2 col-lg-2">
            <?php echo $form->labelEx($model, 'grad'); ?>
        </div>
        <div class="col-md-10 col-lg-10">
            <?php echo $form->textField($model, 'grad', array('size' => 60, 'maxlength' => 255,'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'grad'); ?>
        </div>
    </div>
<br/>
    <div class="row">
        <div class="col-md-2 col-lg-2">
            <?php echo $form->labelEx($model, 'distcount'); ?>
        </div>
        <div class="col-md-10 col-lg-10">
            <?php echo $form->textField($model, 'distcount',array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'distcount'); ?>
        </div>
    </div>

<div class="row" style=" margin-top: 20px;">
        <div class="col-md-2 col-lg-2">
            <?php echo $form->labelEx($model, 'distcountsell'); ?>
        </div>
        <div class="col-md-10 col-lg-10">
            <?php echo $form->textField($model, 'distcountsell',array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'distcountsell'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-10 col-lg-10">
            <div class="row buttons" style=" margin: 0px; margin-top: 10px;">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-success')); ?>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->