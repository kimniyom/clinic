<?php
/* @var $this CenterStockitemNameController */
/* @var $model CenterStockitemName */

$this->breadcrumbs=array(
	'Center Stockitem Names'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CenterStockitemName', 'url'=>array('index')),
	array('label'=>'Manage CenterStockitemName', 'url'=>array('admin')),
);
?>

<h1>Create CenterStockitemName</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>