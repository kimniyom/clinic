<?php
/* @var $this CenterStockproductController */
/* @var $model CenterStockproduct */

$this->breadcrumbs=array(
	'Center Stockproducts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CenterStockproduct', 'url'=>array('index')),
	array('label'=>'Manage CenterStockproduct', 'url'=>array('admin')),
);
?>

<h1>Create CenterStockproduct</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>