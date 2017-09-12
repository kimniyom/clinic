<?php
/* @var $this MenuReportController */
/* @var $model MenuReport */

$this->breadcrumbs=array(
	'Menu Reports'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MenuReport', 'url'=>array('index')),
	array('label'=>'Create MenuReport', 'url'=>array('create')),
	array('label'=>'Update MenuReport', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MenuReport', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MenuReport', 'url'=>array('admin')),
);
?>

<h1>View MenuReport #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'report_name',
		'url',
	),
)); ?>
