<style type="text/css">
	.form .row{
		margin-bottom: 10px;
	}
</style>
<div class="form">

<?php $form=$this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
        'id' => 'verticalForm',
        'htmlOptions' => array('class' => 'well'), // for inset effect
    )); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<div class="col-md-2 col-lg-2">
		<?php echo $form->labelEx($model,'startlevel'); ?>
	</div>
	<div class="col-md-3 col-lg-3">
		<?php echo $form->textField($model,'startlevel',array('size'=>10,'maxlength'=>10,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'startlevel'); ?>
	</div>
	</div>

	<div class="row">
		<div class="col-md-2 col-lg-2">
		<?php echo $form->labelEx($model,'endlevel'); ?>
	</div>
	<div class="col-md-3 col-lg-3">
		<?php echo $form->textField($model,'endlevel',array('size'=>10,'maxlength'=>10,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'endlevel'); ?>
	</div>
	</div>

	<div class="row">
		<div class="col-md-2 col-lg-2">
		<?php echo $form->labelEx($model,'bonus'); ?>
	</div>
	<div class="col-md-3 col-lg-3">
		<?php echo $form->textField($model,'bonus',array('size'=>10,'maxlength'=>10,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'bonus'); ?>
	</div>
	</div>

	<div class="row">
		<div class="col-md-2 col-lg-2">
		<?php echo $form->labelEx($model,'branch'); ?>
	</div>
	<div class="col-md-3 col-lg-3">
		<?php
            //echo CHtml::dropDownList('status', $model, CHtml::listData(StatusUser::model()->findAll(""), 'id', 'status'), array('empty' => '(Select a status)', 'class' => 'form-control')
            //);
            
            $form->widget('booster.widgets.TbSelect2', array(
                'model' => $model,
                'asDropDownList' => true,
                'attribute' => 'branch',
                //'name' => 'oid',
                'data' => CHtml::listData(Branch::model()->findAll("id !=:id",array(":id" => '99')), 'id', 'branchname'),
                //'value' => $model,
                'options' => array(
                    //$model,
                    //'oid',
                    //'tags' => array('clever', 'is', 'better', 'clevertech'),
                    'placeholder' => 'Select a status',
                'width' => '100%',
                //'tokenSeparators' => array(',', ' ')
                )
            ));
            ?>
		<?php echo $form->error($model,'branch'); ?>
	</div>
	</div>

	<div class="row">
		<div class="col-md-2 col-lg-2">
		<?php echo $form->labelEx($model,'user_status'); ?>
	</div>
	<div class="col-md-3 col-lg-3">
		<?php
            //echo CHtml::dropDownList('status', $model, CHtml::listData(StatusUser::model()->findAll(""), 'id', 'status'), array('empty' => '(Select a status)', 'class' => 'form-control')
            //);
            
            $form->widget('booster.widgets.TbSelect2', array(
                'model' => $model,
                'asDropDownList' => true,
                'attribute' => 'user_status',
                //'name' => 'oid',
                'data' => CHtml::listData(StatusUser::model()->findAll(""), 'id', 'status'),
                //'value' => $model,
                'options' => array(
                    //$model,
                    //'oid',
                    //'tags' => array('clever', 'is', 'better', 'clevertech'),
                    'placeholder' => 'Select a status',
                'width' => '100%',
                //'tokenSeparators' => array(',', ' ')
                )
            ));
            ?>
		<?php echo $form->error($model,'user_status'); ?>
	</div>
	</div>

	<div class="row buttons">
		<div class="col-md-2 col-lg-2"></div>
		<div class="col-md-3 col-lg-3">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-success')); ?>
	</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->