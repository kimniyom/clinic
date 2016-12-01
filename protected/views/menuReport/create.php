<?php
/* @var $this MenuReportController */
/* @var $model MenuReport */

$this->breadcrumbs=array(
	'Menu Reports'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MenuReport', 'url'=>array('index')),
	array('label'=>'Manage MenuReport', 'url'=>array('admin')),
);
?>

<h1>Create MenuReport</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>