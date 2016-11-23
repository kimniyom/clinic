<?php
/* @var $this BranchController */
/* @var $model Branch */
/* @var $form CActiveForm */
?>

<div class="well">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'branch-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'branchname'); ?>
        <?php echo $form->textField($model, 'branchname', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'branchname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'address'); ?>
        <?php
        $form->widget('application.components.widgets.XHeditor', array(
            'model' => $model,
            'modelAttribute' => 'address',
            'showModelAttributeValue' => true, // defaults to true, displays the value of $modelInstance->attribute in the textarea
            'config' => array(
                'id' => 'address',
                //'name' => 'xh',
                //'tools' => 'mini', // mini, simple, fill or from XHeditor::$_tools
                'width' => '100%',
            //see XHeditor::$_configurableAttributes for more
            ),
        ));
        ?>
        <?php echo $form->error($model, 'address'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'contact'); ?>
        <?php
        $form->widget('application.components.widgets.XHeditor', array(
            'model' => $model,
            'modelAttribute' => 'contact',
            'showModelAttributeValue' => true, // defaults to true, displays the value of $modelInstance->attribute in the textarea
            'config' => array(
                'id' => 'contact',
                //'name' => 'xh',
                //'tools' => 'mini', // mini, simple, fill or from XHeditor::$_tools
                'width' => '100%',
            //see XHeditor::$_configurableAttributes for more
            ),
        ));
        ?>
        <?php //echo $form->textArea($model, 'contact', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'contact'); ?>

    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'active'); ?>
        <?php echo $form->checkBox($model, 'active', array('value' => 1, 'uncheckValue' => null)); ?>
        <?php echo $form->error($model, 'active'); ?>
    </div>
    <hr/>
    <div class="row buttons" style=" margin-top: 20px;">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-success')); ?>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->