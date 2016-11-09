<?php
/* @var $this ServiceDrugController */
/* @var $model ServiceDrug */

$this->breadcrumbs=array(
	'Service Drugs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ServiceDrug', 'url'=>array('index')),
	array('label'=>'Manage ServiceDrug', 'url'=>array('admin')),
);
?>

<h1>Create ServiceDrug</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>