<?php
/* @var $this RoleReportController */
/* @var $model RoleReport */

$this->breadcrumbs=array(
	'Role Reports'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RoleReport', 'url'=>array('index')),
	array('label'=>'Create RoleReport', 'url'=>array('create')),
	array('label'=>'Update RoleReport', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RoleReport', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RoleReport', 'url'=>array('admin')),
);
?>

<h1>View RoleReport #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'report_id',
	),
)); ?>
