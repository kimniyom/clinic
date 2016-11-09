<?php
/* @var $this ServiceController */
/* @var $model Service */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'branch'); ?>
		<?php echo $form->textField($model,'branch'); ?>
		<?php echo $form->error($model,'branch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'patient_id'); ?>
		<?php echo $form->textField($model,'patient_id'); ?>
		<?php echo $form->error($model,'patient_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'diagcode'); ?>
		<?php echo $form->textField($model,'diagcode'); ?>
		<?php echo $form->error($model,'diagcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price_total'); ?>
		<?php echo $form->textField($model,'price_total'); ?>
		<?php echo $form->error($model,'price_total'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'checkbody'); ?>
		<?php echo $form->textField($model,'checkbody'); ?>
		<?php echo $form->error($model,'checkbody'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'service_date'); ?>
		<?php echo $form->textField($model,'service_date'); ?>
		<?php echo $form->error($model,'service_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'service_result'); ?>
		<?php echo $form->textArea($model,'service_result',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'service_result'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'d_update'); ?>
		<?php echo $form->textField($model,'d_update'); ?>
		<?php echo $form->error($model,'d_update'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->