<?php
/* @var $this AppointController */
/* @var $model Appoint */

$this->breadcrumbs=array(
	'Appoints'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Appoint', 'url'=>array('index')),
	array('label'=>'Create Appoint', 'url'=>array('create')),
	array('label'=>'Update Appoint', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Appoint', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Appoint', 'url'=>array('admin')),
);
?>

<h1>View Appoint #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'service_id',
		'appoint',
		'branch',
		'create_date',
	),
)); ?>
