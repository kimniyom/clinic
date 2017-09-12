<?php
/* @var $this CenterStockitemController */
/* @var $model CenterStockitem */

$this->breadcrumbs=array(
	'Center Stockitems'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CenterStockitem', 'url'=>array('index')),
	array('label'=>'Create CenterStockitem', 'url'=>array('create')),
	array('label'=>'Update CenterStockitem', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CenterStockitem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CenterStockitem', 'url'=>array('admin')),
);
?>

<h1>View CenterStockitem #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'itemcode',
		'itemname',
		'total',
		'price',
		'unit',
		'lotnumber',
	),
)); ?>
