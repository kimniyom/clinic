<?php
/* @var $this ServiceDrugController */
/* @var $model ServiceDrug */
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
		<?php echo $form->label($model,'patient_id'); ?>
		<?php echo $form->textField($model,'patient_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drug'); ?>
		<?php echo $form->textField($model,'drug'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'service_id'); ?>
		<?php echo $form->textField($model,'service_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diagcode'); ?>
		<?php echo $form->textField($model,'diagcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'branch'); ?>
		<?php echo $form->textField($model,'branch'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_serv'); ?>
		<?php echo $form->textField($model,'date_serv'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->