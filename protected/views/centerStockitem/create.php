<?php
/* @var $this CenterStockitemController */
/* @var $model CenterStockitem */

$this->breadcrumbs=array(
	'Center Stockitems'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CenterStockitem', 'url'=>array('index')),
	array('label'=>'Manage CenterStockitem', 'url'=>array('admin')),
);
?>

<h1>Create CenterStockitem</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>