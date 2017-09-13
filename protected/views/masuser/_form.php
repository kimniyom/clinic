<?php
/* @var $this MasuserController */
/* @var $model Masuser */
/* @var $form CActiveForm */
?>
<style type="text/css">
    .form .row{
        margin-bottom: 10px;
    }
</style>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'masuser-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">เครื่องหมาย <span class="required">*</span> ต้องไม่ว่าง.</p>
    <div style=" color: #ff0033;">
        <?php echo $form->errorSummary($model); ?>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'username'); ?>
        </div>
        <div class="col-lg-4">
            <?php echo $form->textField($model, 'username', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'username'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'password'); ?>
        </div>
        <div class="col-lg-4">
            <?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'status'); ?>  
        </div>
        <div class="col-lg-4">
            <?php
            //echo CHtml::dropDownList('status', $model, CHtml::listData(StatusUser::model()->findAll(""), 'id', 'status'), array('empty' => '(Select a status)', 'class' => 'form-control')
            //);
            
            $form->widget('booster.widgets.TbSelect2', array(
                'model' => $model,
                'asDropDownList' => true,
                'attribute' => 'status',
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
            <?php echo $form->error($model, 'status'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'user_id'); ?>
        </div>
        <div class="col-lg-6">
            
            <?php
            
            $sql = "SELECT id,CONCAT(name,' ',lname) AS fname FROM employee";
            $datas = Yii::app()->db->createCommand($sql)->queryAll();
            $form->widget('booster.widgets.TbSelect2', array(
                'model' => $model,
                'asDropDownList' => true,
                'attribute' => 'user_id',
                //'name' => 'oid',
                'data' => CHtml::listData($datas,'id','fname'),
                //'value' => $model,
                'options' => array(
                    //$model,
                    //'oid',
                    //'tags' => array('clever', 'is', 'better', 'clevertech'),
                    'placeholder' => 'เลือกข้อมูลพนักงาน',
                'width' => '100%',
                //'tokenSeparators' => array(',', ' ')
                )
            ));
            //echo CHtml::dropDownList('user_id', $model, CHtml::listData(Employee::model()->findAll(""), 'id', 'name'), array('empty' => '(Select a employee)', 'class' => 'form-control')
            //);
            ?>
            <?php echo $form->error($model, 'user_id'); ?>
        </div>
    </div>
    <br/>
    <div class="row buttons">
        <div class="col-lg-2"></div>
        <div class="col-lg-10">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'บันทึก' : 'Save', array('class' => 'btn btn-success')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->