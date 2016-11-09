<?php
/* @var $this CheckbodyController */
/* @var $model Checkbody */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'checkbody-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'patient_id'); ?>
		<?php echo $form->textField($model,'patient_id'); ?>
		<?php echo $form->error($model,'patient_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'btemp'); ?>
		<?php echo $form->textField($model,'btemp',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'btemp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr'); ?>
		<?php echo $form->textField($model,'pr',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'pr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rr'); ?>
		<?php echo $form->textField($model,'rr',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'rr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_serv'); ?>
		<?php echo $form->textField($model,'date_serv'); ?>
		<?php echo $form->error($model,'date_serv'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'branch'); ?>
		<?php echo $form->textField($model,'branch'); ?>
		<?php echo $form->error($model,'branch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->