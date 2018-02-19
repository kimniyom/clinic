<style type="text/css">
    .row{
        margin-bottom: 10px;
    }
</style>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'repair-form',
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
        <div class="col-md-3 col-lg-3">
            <?php echo $form->labelEx($model, 'object'); ?>
        </div>
        <div class="col-md-9 col-lg-9">
            <?php echo $form->textField($model, 'object', array('size' => 60, 'maxlength' => 255,'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'object'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?php echo $form->labelEx($model, 'detail'); ?>
        </div>
        <div class="col-md-9 col-lg-9">
            <?php echo $form->textArea($model, 'detail', array('size' => 60, 'maxlength' => 255, 'rows' => 6,'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'detail'); ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?php echo $form->labelEx($model, 'date_alert'); ?>
        </div>
        <div class="col-md-9 col-lg-9">
            <?php echo $form->textField($model, 'date_alert',array('value' => $datealert,'class' => 'form-control','readonly' => 'readonly')); ?>
            <?php echo $form->error($model, 'date_alert'); ?>
        </div>
    </div>


    <hr/>
    <div class="row buttons">
        <div class="col-md-3 col-lg-3"></div>
        <div class="col-md-9 col-lg-9">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'บันทึก', array('class' => 'btn btn-success')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->