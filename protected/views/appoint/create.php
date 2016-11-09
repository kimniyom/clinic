<?php
/* @var $this AppointController */
/* @var $model Appoint */

$this->breadcrumbs=array(
	'Appoints'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Appoint', 'url'=>array('index')),
	array('label'=>'Manage Appoint', 'url'=>array('admin')),
);
?>

<h1>Create Appoint</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>