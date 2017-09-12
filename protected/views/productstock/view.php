<?php
/* @var $this ProductStockController */
/* @var $model ProductStock */

$this->breadcrumbs=array(
	'Product Stocks'=>array('index'),
	$model->product_id,
);

$this->menu=array(
	array('label'=>'List ProductStock', 'url'=>array('index')),
	array('label'=>'Create ProductStock', 'url'=>array('create')),
	array('label'=>'Update ProductStock', 'url'=>array('update', 'id'=>$model->product_id)),
	array('label'=>'Delete ProductStock', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->product_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductStock', 'url'=>array('admin')),
);
?>

<h1>View ProductStock #<?php echo $model->product_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'itemcode',
		'product_id',
		'delete_flag',
		'status',
		'expire',
		'date_input',
		'd_update',
	),
)); ?>
