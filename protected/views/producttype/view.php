<?php
/* @var $this ProductTypeController */
/* @var $model ProductType */

$this->breadcrumbs=array(
	'Product Types'=>array('index'),
	$model->type_id,
);

$this->menu=array(
	array('label'=>'List ProductType', 'url'=>array('index')),
	array('label'=>'Create ProductType', 'url'=>array('create')),
	array('label'=>'Update ProductType', 'url'=>array('update', 'id'=>$model->type_id)),
	array('label'=>'Delete ProductType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->type_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductType', 'url'=>array('admin')),
);
?>

<h1>View ProductType #<?php echo $model->type_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type_id',
		'type_name',
		'active',
	),
)); ?>
