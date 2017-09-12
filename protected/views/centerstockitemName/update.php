<?php
/* @var $this CenterStockitemNameController */
/* @var $model CenterStockitemName */

$this->breadcrumbs = array(
    'คลังสินค้า' => Yii::app()->createUrl('store/index'),
    'รายการวัตถุดิบ' => array('index'),
    'Update',
);
?>

<h1>แก้ไขวัตถุดิบ <?php echo $model->itemname; ?></h1>
<hr/>
<?php $this->renderPartial('_form', array('model' => $model)); ?>