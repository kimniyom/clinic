<?php
/* @var $this ServiceImagesController */
/* @var $model ServiceImages */

$this->breadcrumbs=array(
	'Service Images'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ServiceImages', 'url'=>array('index')),
	array('label'=>'Create ServiceImages', 'url'=>array('create')),
	array('label'=>'Update ServiceImages', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ServiceImages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ServiceImages', 'url'=>array('admin')),
);
?>

<h1>View ServiceImages #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'seq',
		'images',
		'create_date',
	),
)); ?>
