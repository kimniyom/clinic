<?php
/* @var $this CenterStockcompanyController */
/* @var $model CenterStockcompany */
/* @var $form CActiveForm */
?>
<style type="text/css">
    .form .row{
        margin-bottom: 10px;
    }
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'center-stockcompany-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
            <div class="col-lg-2" style=" text-align: right;">
		<?php echo $form->labelEx($model,'company_id'); ?>
            </div>
            <div class="col-lg-4">
		<?php echo $form->textField($model,'company_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'company_id'); ?>
            </div>
	</div>

	<div class="row">
            <div class="col-lg-2" style=" text-align: right;">
		<?php echo $form->labelEx($model,'company_name'); ?>
            </div>
            <div class="col-lg-4">
		<?php echo $form->textField($model,'company_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'company_name'); ?>
            </div>
	</div>

	
	<div class="row buttons">
            <div class="col-lg-1"></div>
            <div class="col-lg-4">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-default')); ?>
            </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->