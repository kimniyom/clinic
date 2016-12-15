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
            <?php echo $form->labelEx($model, 'itemid'); ?>
        </div>
        <div class="col-lg-4">
            <?php
            $form->widget('booster.widgets.TbSelect2', array(
                'model' => $model,
                'asDropDownList' => true,
                'attribute' => 'itemid',
                //'name' => 'oid',
                'data' => CHtml::listData(CenterStockitemName::model()->findAll(""), 'id', 'itemname'),
                //'value' => $model,
                'options' => array(
                    //$model,
                    //'oid',
                    //'tags' => array('clever', 'is', 'better', 'clevertech'),
                    'placeholder' => 'วัตถุดิบ',
                    'width' => '100%',
                //'tokenSeparators' => array(',', ' ')
                )
            ));
            ?>
            <?php echo $form->error($model, 'itemid'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'number'); ?>
        </div>
        <div class="col-lg-2">
            <?php echo $form->textField($model, 'number',array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'number'); ?>
        </div>
        <div class="col-lg-1"><div id="unit"></div></div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'price'); ?>
        </div>
        <div class="col-lg-2">
            <?php echo $form->textField($model, 'price',array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'price'); ?>
        </div>
        <div class="col-lg-1">บาท</div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'lotnumber'); ?>
        </div>
        <div class="col-lg-3">
            <?php $lot = date("Ym") ?>
            <?php echo $form->textField($model, 'lotnumber', array('value' => $lot, 'readonly' => 'readonly','class' => 'form-control')); ?>
            <?php echo $form->error($model, 'lotnumber'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'numbercut'); ?>
        </div>
        <div class="col-lg-2">
            <?php echo $form->textField($model, 'numbercut',array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'numbercut'); ?>
        </div>
        <div class="col-lg-2">
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
                    'width' => '100%',
                //'tokenSeparators' => array(',', ' ')
                )
            ));
            ?>
            <?php echo $form->error($model, 'unitcut'); ?>
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

<script type="text/javascript">
    $(document).ready(function () {
        $("#CenterStockitem_itemid").change(function () {
            var itemid = $(this).val();
            var url = "<?php echo Yii::app()->createUrl('centerstockitemname/getunit') ?>";
            var data = {itemid: itemid};
            $.post(url, data, function (datas) {
                $("#unit").html(datas);
            });
        });
    });
</script>