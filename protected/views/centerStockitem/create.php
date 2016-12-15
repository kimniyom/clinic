<?php
/* @var $this CenterStockitemController */
/* @var $model CenterStockitem */

$this->breadcrumbs = array(
    'คลังวัตถุดิบ' => array('index'),
    'Create',
);
?>

<h1><img src="<?php echo Yii::app()->baseUrl; ?>/images/text-plus-icon.png"/> เพิ่มวัตถุดิบเข้าคลัง</h1>
<hr/>
<?php $this->renderPartial('_form', array('model' => $model)); ?>