<?php
/* @var $this ClinicStockproductController */
/* @var $model ClinicStockproduct */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'clinic-stockproduct-form',
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
		<?php echo $form->labelEx($model,'clinicname'); ?>
		<?php echo $form->textField($model,'clinicname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'clinicname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_name'); ?>
		<?php echo $form->textField($model,'product_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'product_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_nameclinic'); ?>
		<?php echo $form->textField($model,'product_nameclinic',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'product_nameclinic'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'costs'); ?>
		<?php echo $form->textField($model,'costs'); ?>
		<?php echo $form->error($model,'costs'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_price'); ?>
		<?php echo $form->textField($model,'product_price'); ?>
		<?php echo $form->error($model,'product_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_detail'); ?>
		<?php echo $form->textArea($model,'product_detail',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'product_detail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type_id'); ?>
		<?php echo $form->textField($model,'type_id'); ?>
		<?php echo $form->error($model,'type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'delete_flag'); ?>
		<?php echo $form->textField($model,'delete_flag'); ?>
		<?php echo $form->error($model,'delete_flag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'d_update'); ?>
		<?php echo $form->textField($model,'d_update'); ?>
		<?php echo $form->error($model,'d_update'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'branch'); ?>
		<?php echo $form->textField($model,'branch'); ?>
		<?php echo $form->error($model,'branch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subproducttype'); ?>
		<?php echo $form->textField($model,'subproducttype'); ?>
		<?php echo $form->error($model,'subproducttype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unit'); ?>
		<?php echo $form->textField($model,'unit'); ?>
		<?php echo $form->error($model,'unit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company'); ?>
		<?php echo $form->textField($model,'company',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'company'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'size'); ?>
		<?php echo $form->textField($model,'size',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'size'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'private'); ?>
		<?php echo $form->textField($model,'private'); ?>
		<?php echo $form->error($model,'private'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->