<?php
/* @var $this CenterStockmixController */
/* @var $model CenterStockmix */

$this->breadcrumbs=array(
	'Center Stockmixes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CenterStockmix', 'url'=>array('index')),
	array('label'=>'Manage CenterStockmix', 'url'=>array('admin')),
);
?>

<h1>Create CenterStockmix</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>