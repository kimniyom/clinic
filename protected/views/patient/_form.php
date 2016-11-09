<?php
/* @var $this EmployeeController */
/* @var $model Employee */
/* @var $form CActiveForm */
?>

<style type="text/css">
    .form .row{
        margin-bottom: 10px;
    }
</style>
<hr/>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'patient-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>


   
        <p class="note">Fields with <span class="required">*</span> are required.</p>
        <div style=" color: #ff0033;">
            <?php echo $form->errorSummary($model); ?>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <?php echo $form->labelEx($model, 'oid'); ?>
            </div>
            <div class="col-lg-3">
                <?php
                //echo CHtml::dropDownList('oid', $model, CHtml::listData(Pername::model()->findAll(""), 'oid', 'pername'), array('class' => 'form-control')
                //echo $form->dropDownList($model, 'oid', CHtml::listData(Pername::model()->findAll(""), 'oid', 'pername'), array('class' => 'form-control'));
                ?>

                <?php
                $form->widget('booster.widgets.TbSelect2', array(
                    'model' => $model,
                    'asDropDownList' => true,
                    'attribute' => 'oid',
                    //'name' => 'oid',
                    'data' => CHtml::listData(Pername::model()->findAll(""), 'oid', 'pername'),
                    //'value' => $model,
                    'options' => array(
                        //$model,
                        //'oid',
                        //'tags' => array('clever', 'is', 'better', 'clevertech'),
                        'placeholder' => 'คำนำหน้าชื่อ',
                    //'width' => '40%',
                    //'tokenSeparators' => array(',', ' ')
                    )
                ));
                /*
                  $this->widget(
                  'booster.widgets.TbSelect2', array(
                  'asDropDownList' => true,
                  'name' => 'clevertech1',
                  'options' => array(
                  //'tags' => array('clever', 'is', 'better', 'clevertech'),
                  'placeholder' => 'type clever, or is, or just type!',
                  'width' => '40%',
                  'tokenSeparators' => array(',', ' ')
                  )
                  )
                  );
                 * 
                 */
                ?>

                <?php echo $form->error($model, 'oid'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2">
                <?php echo $form->labelEx($model, 'name'); ?>
            </div>
            <div class="col-lg-10">
                <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control')); ?>
                <?php echo $form->error($model, 'name'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2">
                <?php echo $form->labelEx($model, 'lname'); ?>
            </div>
            <div class="col-lg-10">
                <?php echo $form->textField($model, 'lname', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control')); ?>
                <?php echo $form->error($model, 'lname'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2">
                <?php echo $form->labelEx($model, 'card'); ?>
            </div>
            <div class="col-lg-5">
                <?php //echo $form->textField($model, 'card', array('size' => 60, 'maxlength' => 13, 'class' => 'form-control')); ?>

                <?php
                 $form->widget("ext.maskedInput.MaskedInput", array(
                    "model" => $model,
                    "attribute" => "card",
                    //"id" => 'card',
                    //"name" => 'card',
                    "mask" => '9-9999-99999-99-9',
                    "clientOptions" => array("autoUnmask" => true), /* autoUnmask defaults to false */
                    "defaults" => array("removeMaskOnSubmit" => false),
                        /* once defaults are set will be applied to all the masked fields  removeMaskOnSubmit defaults to true */
                ));
                ?>
                <?php echo $form->error($model, 'card'); ?>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-2">
                <?php echo $form->labelEx($model, 'sex'); ?>
            </div>
            <div class="col-lg-3">
                <?php
                $DATASEX = array("M" => "ชาย", "F" => "หญิง");
                echo $form->dropDownList($model, 'sex', $DATASEX, array('empty' => '== เลือกเพศ ==', 'class' => 'form-control')
                );
                ?>
                <?php echo $form->error($model, 'sex'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2">
                <?php echo $form->labelEx($model, 'birth'); ?>
            </div>
            <div class="col-lg-4">
                <?php
                $form->widget(
                        'booster.widgets.TbDatePicker', array(
                    'model' => $model,
                    'attribute' => 'birth',
                    'options' => array(
                        'language' => 'th',
                        'type' => 'date',
                        'format' => 'yyyy-mm-dd',
                    )
                        )
                );
                ?>

                <?php echo $form->error($model, 'birth'); ?>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-lg-2">
                <?php echo $form->labelEx($model, 'occupation'); ?>
            </div>
            <div class="col-lg-8">
                <?php
                $form->widget('booster.widgets.TbSelect2', array(
                    'model' => $model,
                    'asDropDownList' => true,
                    'attribute' => 'occupation',
                    //'name' => 'oid',
                    'data' => CHtml::listData(Occupation::model()->findAll(""), 'id', 'occupationname'),
                    //'value' => $model,
                    'options' => array(
                        //$model,
                        //'oid',
                        //'tags' => array('clever', 'is', 'better', 'clevertech'),
                        'placeholder' => 'อาชีพ',
                    'width' => '100%',
                    //'tokenSeparators' => array(',', ' ')
                    )
                ));
                ?>

                <?php echo $form->error($model, 'occupation'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2">
                <?php echo $form->labelEx($model, 'branch'); ?>
            </div>
            <div class="col-lg-6">
                <?php
                if (Yii::app()->session['branch'] == '99') {
                    $where = "";
                } else {
                    $branch_id = Yii::app()->session['branch'];
                    $where = "id = '$branch_id'";
                }
                $form->widget('booster.widgets.TbSelect2', array(
                    'model' => $model,
                    'asDropDownList' => true,
                    'attribute' => 'branch',
                    //'name' => 'oid',
                    'data' => CHtml::listData(Branch::model()->findAll($where), 'id', 'branchname'),
                    //'value' => $model,
                    'options' => array(
                        //$model,
                        //'oid',
                        //'tags' => array('clever', 'is', 'better', 'clevertech'),
                        'placeholder' => 'สถานบริการที่เข้ารับ',
                        'width' => '100%',
                    //'tokenSeparators' => array(',', ' ')
                    )
                ));
                ?>
                <?php echo $form->error($model, 'branch'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2">
                <?php echo $form->labelEx($model, 'type'); ?>
            </div>
            <div class="col-lg-6">
                <?php
                $form->widget('booster.widgets.TbSelect2', array(
                    'model' => $model,
                    'asDropDownList' => true,
                    'attribute' => 'type',
                    //'name' => 'oid',
                    'data' => CHtml::listData(Gradcustomer::model()->findAll(""), 'id', 'grad'),
                    //'value' => $model,
                    'options' => array(
                        //$model,
                        //'oid',
                        //'tags' => array('clever', 'is', 'better', 'clevertech'),
                        'placeholder' => 'ประเภทลูกค้า',
                        'width' => '100%',
                    //'tokenSeparators' => array(',', ' ')
                    )
                ));
                ?>
                <?php echo $form->error($model, 'type'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2">
                <?php echo $form->labelEx($model, 'create_date'); ?>
            </div>
            <div class="col-lg-5">
                <?php
                $form->widget(
                        'booster.widgets.TbDatePicker', array(
                    'model' => $model,
                    'attribute' => 'create_date',
                    'options' => array(
                        'language' => 'th',
                        'type' => 'date',
                        'format' => 'yyyy-mm-dd',
                    )
                        )
                );
                ?>
                <?php echo $form->error($model, 'create_date'); ?>
            </div>
        </div>


        <hr/>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-10">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-success')); ?>
            </div>
        </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->