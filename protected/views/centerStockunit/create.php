<?php
/* @var $this CenterStockunitController */
/* @var $model CenterStockunit */

$this->breadcrumbs=array(
	'Center Stockunits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CenterStockunit', 'url'=>array('index')),
	array('label'=>'Manage CenterStockunit', 'url'=>array('admin')),
);
?>

<h1>Create CenterStockunit</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>