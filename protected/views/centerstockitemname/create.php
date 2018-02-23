<?php
/* @var $this CenterStockitemNameController */
/* @var $model CenterStockitemName */

$this->breadcrumbs = array(
    //'คลังสินค้า' => Yii::app()->createUrl('store/index'),
    'รายการวัตถุดิบ' => array('index'),
    'เพิ่ม',
);


?>

<h1>เพิ่มรายการวัตถุดิบ</h1>
<hr/>
<?php $this->renderPartial('_form', array('model' => $model)); ?>