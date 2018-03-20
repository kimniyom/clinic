<?php
/* @var $this CenterStockunitController */
/* @var $model CenterStockunit */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'center-stockunit-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>


	<div class="row" style="margin:0px;">
            <div class="col-lg-2">
		<?php echo $form->labelEx($model,'unit'); ?>
            </div>
            <div class="col-lg-5">
		<?php echo $form->textField($model,'unit',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'unit'); ?>
            </div>
	</div>
<hr/>
	<div class="row buttons" style="margin:0px;">
            <div class="col-lg-2"></div>
            <div class="col-lg-3">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-success')); ?>
            </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->