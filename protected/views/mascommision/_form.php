<style type="text/css">
    .form .row{
        margin-bottom: 10px;
    }
</style>

<div class="form">

    <?php
    $form = $this->beginWidget(
            'booster.widgets.TbActiveForm', array(
        'id' => 'verticalForm',
        'htmlOptions' => array('class' => 'well'), // for inset effect
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?php echo $form->labelEx($model, 'commisionname'); ?>
        </div>
        <div class="col-md-9 col-lg-9">
            <?php echo $form->textField($model, 'commisionname', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'commisionname'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?php echo $form->labelEx($model, 'user_status'); ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?php
            $form->widget('booster.widgets.TbSelect2', array(
                'model' => $model,
                'asDropDownList' => true,
                'attribute' => 'user_status',
                //'name' => 'oid',
                'data' => CHtml::listData(StatusUser::model()->findAll(), 'id', 'status'),
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
            <?php echo $form->error($model, 'user_status'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?php echo $form->labelEx($model, 'valuecom'); ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?php echo $form->textField($model, 'valuecom', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'valuecom'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?php echo $form->labelEx($model, 'typevalue'); ?>
        </div>
        <div class="col-md-3 col-lg-3">
         
            <?php
            echo $form->radioButtonList($model, 'typevalue', array(0 => 'เปอร์เซ็น',
                1 => 'จำนวนเงิน')
            )
            ?>
            <?php echo $form->error($model, 'typevalue'); ?>
        </div>
    </div>

    <div class="row buttons">
        <div class="col-md-3 col-lg-3"></div>
        <div class="col-md-3 col-lg-3">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-success')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->