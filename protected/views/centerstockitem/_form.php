<?php
/* @var $this CenterStockitemController */
/* @var $model CenterStockitem */
/* @var $form CActiveForm */
?>
<style type="text/css">
    .form .row{
        margin: 0px;
        margin-bottom: 5px;
    }
</style>
<div class="form">

    <?php
    $ModelUnit = new CenterStockunit();
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
        <div class="col-lg-2 col-sm-12 col-xs-12">
            <?php echo $form->labelEx($model, 'itemid'); ?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
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
        <div class="col-md-2 col-lg-2 col-sm-3 col-xs-3">
            <a href="<?php echo Yii::app()->createUrl('centerstockitemname/create') ?>">
            <button type="button" class="btn btn-default"><i class="fa fa-plus"></i> เพิ่ม</button></a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'number'); ?>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
            <?php echo $form->textField($model, 'number',array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'number'); ?>
        </div>
        <div class="col-lg-1 col-md-2 col-sm-6 col-xs-6">
            <div id="unit" style=" padding-top: 10px;">
                <?php echo $ModelUnit->GetunitById($model->itemid)?>
            </div>
                
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'price'); ?>
        </div>
         <div class="col-lg-2 col-md-2 col-sm-6 col-xs-8">
            <?php echo $form->textField($model, 'price',array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'price'); ?>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">บาท</div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'lotnumber'); ?>
        </div>
        <div class="col-lg-3">
            <?php $lot = date("Ymd") ?>
            <?php echo $form->textField($model, 'lotnumber', array('value' => $lot, 'readonly' => 'readonly','class' => 'form-control')); ?>
            <?php echo $form->error($model, 'lotnumber'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <?php echo $form->labelEx($model, 'numbercut'); ?>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-8">
            <?php echo $form->textField($model, 'numbercut',array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'numbercut'); ?>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
            <div id="unitcut" style=" padding-top: 10px;">
                <?php echo $ModelUnit->GetunitCutById($model->itemid)?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2"> <?php echo $form->labelEx($model, 'expire'); ?></div>
        <div class="col-lg-4">
            <div>
                <?php
                $form->widget(
                        'booster.widgets.TbDatePicker', array(
                    'model' => $model,
                    'attribute' => 'expire',
                    //'value' => date("Y-m-d"),
                    //'id' => 'datestart',
                    //'name' => 'datestart',
                    'options' => array(
                        'language' => 'th',
                        'type' => 'date',
                        'format' => 'yyyy-mm-dd',
                    )
                        )
                );
                ?>
        </div>
        <?php echo $form->error($model, 'expire'); ?>
    </div>
</div>
<div class="row">
        <div class="col-lg-2"> <?php echo $form->labelEx($model, 'company_id'); ?></div>
        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-8">
            <?php
                    $form->widget('booster.widgets.TbSelect2', array(
                        'model' => $model,
                        'asDropDownList' => true,
                        'attribute' => 'company_id',
                        //'name' => 'company_id',
                        //'id' => 'company',
                        'data' => CHtml::listData(CenterStockcompany::model()->findAll(""), 'id', 'company_name'),
                        //'value' => $model,
                        'options' => array(
                            'allowClear' => true,
                            //$model,
                            //'oid',
                            //'tags' => array('clever', 'is', 'better', 'clevertech'),
                            'placeholder' => '== บริษัท ==',
                            'width' => '100%',
                        //'tokenSeparators' => array(',', ' ')
                        )
                    ));
                    ?>
                </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-4">
                <a href="<?php echo Yii::app()->createUrl('centerstockcompany/create') ?>">
                <button type="button" class="btn btn-default"><i class="fa fa-plus"></i> เพิ่มบริษัท</button></a>
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
                $("#unit").html(datas.unit);
                $("#unitcut").html(datas.unitcut);
            },'json');
        });
    });
</script>