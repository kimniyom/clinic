<?php
/* @var $this MascommisionController */
/* @var $model Mascommision */
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
		<?php echo $form->label($model,'commisionname'); ?>
		<?php echo $form->textField($model,'commisionname',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_status'); ?>
		<?php echo $form->textField($model,'user_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valuecom'); ?>
		<?php echo $form->textField($model,'valuecom'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'typevalue'); ?>
		<?php echo $form->textField($model,'typevalue'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->