<?php
/* @var $this CenterStockcompanyController */
/* @var $model CenterStockcompany */

$this->breadcrumbs=array(
	'Center Stockcompanies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CenterStockcompany', 'url'=>array('index')),
	array('label'=>'Manage CenterStockcompany', 'url'=>array('admin')),
);
?>

<h1>Create CenterStockcompany</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>