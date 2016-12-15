<?php
/* @var $this CenterStockitemNameController */
/* @var $model CenterStockitemName */

$this->breadcrumbs=array(
	'Center Stockitem Names'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CenterStockitemName', 'url'=>array('index')),
	array('label'=>'Create CenterStockitemName', 'url'=>array('create')),
	array('label'=>'Update CenterStockitemName', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CenterStockitemName', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CenterStockitemName', 'url'=>array('admin')),
);
?>

<h1>View CenterStockitemName #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'itemcode',
		'itemname',
		'price',
		'unit',
	),
)); ?>
