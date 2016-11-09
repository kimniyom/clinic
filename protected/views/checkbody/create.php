<?php
/* @var $this CheckbodyController */
/* @var $model Checkbody */

$this->breadcrumbs=array(
	'Checkbodies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Checkbody', 'url'=>array('index')),
	array('label'=>'Manage Checkbody', 'url'=>array('admin')),
);
?>

<h1>Create Checkbody</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>