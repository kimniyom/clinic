<?php
/* @var $this RoleReportController */
/* @var $model RoleReport */

$this->breadcrumbs=array(
	'Role Reports'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RoleReport', 'url'=>array('index')),
	array('label'=>'Create RoleReport', 'url'=>array('create')),
	array('label'=>'View RoleReport', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RoleReport', 'url'=>array('admin')),
);
?>

<h1>Update RoleReport <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>