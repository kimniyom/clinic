<?php
/* @var $this MascommisionController */
/* @var $model Mascommision */

$this->breadcrumbs=array(
	'Mascommisions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Mascommision', 'url'=>array('index')),
	array('label'=>'Create Mascommision', 'url'=>array('create')),
	array('label'=>'Update Mascommision', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Mascommision', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Mascommision', 'url'=>array('admin')),
);
?>

<h1>View Mascommision #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'commisionname',
		'user_status',
		'valuecom',
		'typevalue',
	),
)); ?>
