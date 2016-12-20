<?php
/* @var $this CenterStoreproductController */
/* @var $model CenterStoreproduct */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'center-storeproduct-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'product_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lotnumber'); ?>
		<?php echo $form->textField($model,'lotnumber',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'lotnumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'generate'); ?>
		<?php echo $form->textField($model,'generate'); ?>
		<?php echo $form->error($model,'generate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expire'); ?>
		<?php echo $form->textField($model,'expire'); ?>
		<?php echo $form->error($model,'expire'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'d_update'); ?>
		<?php echo $form->textField($model,'d_update'); ?>
		<?php echo $form->error($model,'d_update'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'number'); ?>
		<?php echo $form->textField($model,'number'); ?>
		<?php echo $form->error($model,'number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total'); ?>
		<?php echo $form->textField($model,'total'); ?>
		<?php echo $form->error($model,'total'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->