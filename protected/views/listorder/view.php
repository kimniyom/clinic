<?php
/* @var $this ListorderController */
/* @var $model Listorder */

$this->breadcrumbs=array(
	'Listorders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Listorder', 'url'=>array('index')),
	array('label'=>'Create Listorder', 'url'=>array('create')),
	array('label'=>'Update Listorder', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Listorder', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Listorder', 'url'=>array('admin')),
);
?>

<h1>View Listorder #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'order_id',
		'product_id',
		'number',
		'pricetotal',
		'd_update',
		'status',
	),
)); ?>
