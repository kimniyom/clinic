<?php
/* @var $this OcupationController */
/* @var $model Ocupation */

$this->breadcrumbs=array(
	'Ocupations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ocupation', 'url'=>array('index')),
	array('label'=>'Manage Ocupation', 'url'=>array('admin')),
);
?>

<h1>Create Ocupation</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>