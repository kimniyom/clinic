<?php
/* @var $this ProductStockController */
/* @var $model ProductStock */

$this->breadcrumbs=array(
	'Product Stocks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductStock', 'url'=>array('index')),
	array('label'=>'Manage ProductStock', 'url'=>array('admin')),
);
?>

<h1>Create ProductStock</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>