<?php
/* @var $this RepairController */
/* @var $model Repair */

$this->breadcrumbs=array(
	'Repairs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Repair', 'url'=>array('index')),
	array('label'=>'Manage Repair', 'url'=>array('admin')),
);
?>

<h1>Create Repair</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>