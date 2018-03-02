<?php
/* @var $this CenterStockitemNameController */
/* @var $model CenterStockitemName */

$this->breadcrumbs = array(
    //'คลังสินค้า' => Yii::app()->createUrl('store/index'),
    'รายการวัตถุดิบ' => array('index'),
    'แก้ไข',
);
?>

<h4>แก้ไขวัตถุดิบ <?php echo $model->itemname; ?></h4>
<hr/>
<?php $this->renderPartial('_form', array('model' => $model)); ?>