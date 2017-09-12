<?php
/* @var $this ClinicStoreproductController */
/* @var $model ClinicStoreproduct */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lotnumber'); ?>
		<?php echo $form->textField($model,'lotnumber',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'generate'); ?>
		<?php echo $form->textField($model,'generate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'expire'); ?>
		<?php echo $form->textField($model,'expire'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'d_update'); ?>
		<?php echo $form->textField($model,'d_update'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'number'); ?>
		<?php echo $form->textField($model,'number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total'); ?>
		<?php echo $form->textField($model,'total'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'branch'); ?>
		<?php echo $form->textField($model,'branch'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->