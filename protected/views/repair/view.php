<?php
/* @var $this RepairController */
/* @var $model Repair */

$this->breadcrumbs=array(
	'Repairs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Repair', 'url'=>array('index')),
	array('label'=>'Create Repair', 'url'=>array('create')),
	array('label'=>'Update Repair', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Repair', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Repair', 'url'=>array('admin')),
);
?>

<h1>View Repair #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'object',
		'detail',
		'price',
		'user',
		'd_update',
		'date_alert',
		'status',
	),
)); ?>
