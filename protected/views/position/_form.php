<style type="text/css">
    .form .row{
        margin-bottom:10px;
    }
</style>

<div class="form well">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'position-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
        <div class="col-md-3 col-lg-3">
		<?php echo $form->labelEx($model,'position'); ?>
    </div>
     <div class="col-md-9 col-lg-9">
		<?php echo $form->textField($model,'position',array('size'=>60,'maxlength'=>255,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'position'); ?>
    </div>
	</div>

	<div class="row">
        <div class="col-md-3 col-lg-3">
		<?php echo $form->labelEx($model,'positionfree'); ?>
    </div>
    <div class="col-md-3 col-lg-3">
		<?php echo $form->textField($model,'positionfree',array('class' => 'form-control')); ?>
		<?php echo $form->error($model,'positionfree'); ?>
    </div>
	</div>

	<div class="row">
        <div class="col-md-3 col-lg-3"></div>
         <div class="col-md-3 col-lg-3">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-success')); ?>
</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->