<?php
/* @var $this RoleReportController */
/* @var $model RoleReport */

$this->breadcrumbs=array(
	'Role Reports'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RoleReport', 'url'=>array('index')),
	array('label'=>'Manage RoleReport', 'url'=>array('admin')),
);
?>

<h1>Create RoleReport</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>