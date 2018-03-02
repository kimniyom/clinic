<?php
/* @var $this CenterStockcompanyController */
/* @var $model CenterStockcompany */

$this->breadcrumbs=array(
	'บริษัทสั่งซื้อวัตถุดิบ'=>array('index'),
	'เพิ่ม',
);

?>

<h4>เพิ่มบริษัทสั่งซื้อวัตถุดิบ</h4>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>