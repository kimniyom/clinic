<?php
/* @var $this CenterStockitemNameController */
/* @var $model CenterStockitemName */
/* @var $form CActiveForm */
?>
<style type="text/css">
    .form .row{
        margin: 0px 0px 10px 0px;
    }
</style>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'center-stockitem-name-form',
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
            <?php echo $form->labelEx($model, 'itemcode'); ?>
        </div>
        <div class="col-lg-3">
            <?php echo $form->textField($model, 'itemcode', array('size' => 20, 'maxlength' => 10,'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'itemcode'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'itemname'); ?>
        </div>
        <div class="col-lg-6">
            <?php echo $form->textField($model, 'itemname', array('size' => 60, 'maxlength' => 255,'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'itemname'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'price'); ?>
        </div>
        <div class="col-lg-2">
            <?php echo $form->textField($model, 'price',array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'price'); ?>
        </div>
        <div class="col-lg-2">
            บาท
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
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
            ));
            ?>
            <?php echo $form->error($model, 'unit'); ?>
            <a href='<?php echo Yii::app()->createUrl('unit/create') ?>'>
            <button type="button" class="btn btn-default"><i class='fa fa-plus'></i> เพิ่มหน่วยนับ</button></a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'unitcut'); ?>
        </div>
        <div class="col-lg-4">
            <?php
            $form->widget('booster.widgets.TbSelect2', array(
                'model' => $model,
                'asDropDownList' => true,
                'attribute' => 'unitcut',
                //'name' => 'oid',
                'data' => CHtml::listData(CenterStockunit::model()->findAll(""), 'id', 'unit'),
                //'value' => $model,
                'options' => array(
                    //$model,
                    //'oid',
                    //'tags' => array('clever', 'is', 'better', 'clevertech'),
                    'placeholder' => 'หน่วยตัดสต๊อก',
                //'width' => '40%',
                //'tokenSeparators' => array(',', ' ')
                )
            ));
            ?>
            <?php echo $form->error($model, 'unitcut'); ?>
            <a href='<?php echo Yii::app()->createUrl('centerstockunit/create') ?>'>
                <button type="button" class="btn btn-default"><i class='fa fa-plus'></i> เพิ่มหน่วยตัดสต๊อก</button></a>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'alert'); ?>
        </div>
        <div class="col-lg-2">
            <?php echo $form->textField($model, 'alert', array('size' => 10, 'maxlength' => 10,'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'alert'); ?>
        </div>
    </div>
    
    <hr/>
    <div class="row buttons">
        <div class="col-lg-2"></div>
        <div class="col-lg-4">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'บันทึก', array('class' => 'btn btn-success')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->