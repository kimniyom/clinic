<?php
/* @var $this CenterStockitemController */
/* @var $model CenterStockitem */
/* @var $form CActiveForm */
?>
<style type="text/css">
    .form .row{
        margin-bottom: 5px;
    }
</style>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'center-stockitem-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'itemname'); ?>
        </div>
        <div class="col-lg-10">
            <?php echo $form->textField($model, 'itemname', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'itemname'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'price'); ?>
        </div>
        <div class="col-lg-2">
            <?php echo $form->textField($model, 'price'); ?>
            <?php echo $form->error($model, 'price'); ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'number'); ?>
        </div>
        <div class="col-lg-2">
            <?php echo $form->textField($model, 'number'); ?>
            <?php echo $form->error($model, 'number'); ?>
        </div>
        <div class="col-lg-2" style=" text-align: center;">
            <?php echo $form->labelEx($model, 'unit'); ?>
        </div>
        <div class="col-lg-4">
            
            <?php
                $form->widget('booster.widgets.TbSelect2', array(
                    'model' => $model,
                    'asDropDownList' => true,
                    'attribute' => 'unit',
                    //'name' => 'oid',
                    'data' => CHtml::listData(CenterStockunit::model()->findAll(""), 'id', 'unit'),
                    //'value' => $model,
                    'options' => array(
                        //$model,
                        //'oid',
                        //'tags' => array('clever', 'is', 'better', 'clevertech'),
                        'placeholder' => 'หน่วยนับ',
                    //'width' => '40%',
                    //'tokenSeparators' => array(',', ' ')
                    )
                ));?>
            
            <?php echo $form->error($model, 'unit'); ?>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'lotnumber'); ?>
        </div>
        <div class="col-lg-3">
            <?php echo $form->textField($model, 'lotnumber'); ?>
            <?php echo $form->error($model, 'lotnumber'); ?>
        </div>
    </div>
<hr/>
    <div class="row buttons">
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-success')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->