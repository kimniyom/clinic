<?php
/* @var $this CenterStockunitController */
/* @var $model CenterStockunit */

$this->breadcrumbs=array(
	'Center Stockunits'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CenterStockunit', 'url'=>array('index')),
	array('label'=>'Create CenterStockunit', 'url'=>array('create')),
	array('label'=>'Update CenterStockunit', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CenterStockunit', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CenterStockunit', 'url'=>array('admin')),
);
?>

<h1>View CenterStockunit #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'unit',
	),
)); ?>
