<?php
/* @var $this CenterStockproductController */
/* @var $model CenterStockproduct */

$this->breadcrumbs=array(
	'Center Stockproducts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CenterStockproduct', 'url'=>array('index')),
	array('label'=>'Create CenterStockproduct', 'url'=>array('create')),
	array('label'=>'Update CenterStockproduct', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CenterStockproduct', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CenterStockproduct', 'url'=>array('admin')),
);
?>

<h1>View CenterStockproduct #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_id',
		'product_name',
		'costs',
		'product_price',
		'product_detail',
		'type_id',
		'delete_flag',
		'status',
		'd_update',
		'branch',
	),
)); ?>
