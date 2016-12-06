<?php
/* @var $this LogloginController */
/* @var $model Loglogin */

$this->breadcrumbs=array(
	'Loglogins'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Loglogin', 'url'=>array('index')),
	array('label'=>'Create Loglogin', 'url'=>array('create')),
	array('label'=>'Update Loglogin', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Loglogin', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Loglogin', 'url'=>array('admin')),
);
?>

<h1>View Loglogin #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'branch',
		'date',
	),
)); ?>
