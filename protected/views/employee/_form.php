<?php
/* @var $this EmployeeController */
/* @var $model Employee */
/* @var $form CActiveForm */
?>

<style type="text/css">
    .row{
        margin-bottom: 10px;
    }
</style>


<div class="panel panel-default" style=" margin-bottom: 0px;">
    <div class="panel-heading"><i class="fa fa-users"></i> ข้อมูลพนักงาน</div>
    <div class="panel-body" id="p-box">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'employee-form',
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
        <h4 style=" border-bottom: #cccccc solid 1px; width: 100%; padding-bottom: 10px;">ข้อมูลทั่วไป</h4>
        <div class="well">
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
                    <?php echo $form->labelEx($model, 'alias'); ?>
                </div>
                <div class="col-lg-5">
                    <?php echo $form->textField($model, 'alias', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'alias'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <?php echo $form->labelEx($model, 'email'); ?>
                </div>
                <div class="col-lg-8">

                    <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <?php echo $form->labelEx($model, 'tel'); ?>
                </div>
                <div class="col-lg-4">
                    <?php echo $form->textField($model, 'tel', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'tel'); ?>
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
        </div>
        <h4 style=" border-bottom: #cccccc solid 1px; width: 100%; padding-bottom: 10px;">ข้อมูลการทำงาน</h4>
        <div class="well">
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
                            'placeholder' => 'สถานที่ปฏิบัติงาน',
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
                    <?php echo $form->labelEx($model, 'position'); ?>
                </div>
                <div class="col-lg-5">
                    <?php
                    $form->widget('booster.widgets.TbSelect2', array(
                        'model' => $model,
                        'asDropDownList' => true,
                        'attribute' => 'position',
                        //'name' => 'oid',
                        'data' => CHtml::listData(Position::model()->findAll(""), 'id', 'position'),
                        //'value' => $model,
                        'options' => array(
                            //$model,
                            //'oid',
                            //'tags' => array('clever', 'is', 'better', 'clevertech'),
                            'placeholder' => 'ตำแหน่ง',
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
                    <?php echo $form->labelEx($model, 'walking'); ?>
                </div>
                <div class="col-lg-5">
                    <?php
                    $form->widget(
                            'booster.widgets.TbDatePicker', array(
                        'model' => $model,
                        'attribute' => 'walking',
                        'options' => array(
                            'language' => 'th',
                            'type' => 'date',
                            'format' => 'yyyy-mm-dd',
                        )
                            )
                    );
                    ?>
                    <?php echo $form->error($model, 'walking'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <?php echo $form->labelEx($model, 'salary'); ?>
                </div>
                <div class="col-lg-4">
                    <?php echo $form->textField($model, 'salary', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'salary'); ?>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-10">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', array('class' => 'btn btn-success')); ?>
                </div>
            </div>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>
<script type="text/javascript">
    Setscreen();
    function Setscreen() {
        var screen = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = (screen - 143);
        $("#p-box").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
        //$("#patientbox").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF'});
        //$("#boxorders").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF', 'overflow': 'auto', 'padding-left': '10px'});

    }
</script>

