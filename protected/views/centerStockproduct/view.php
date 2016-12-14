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
		'productcode',
		'productname',
		'cost',
		'price',
		'expire',
		'create_date',
		'number',
		'd_update',
	),
)); ?>
