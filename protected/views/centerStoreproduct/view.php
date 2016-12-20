<?php
/* @var $this CenterStoreproductController */
/* @var $model CenterStoreproduct */

$this->breadcrumbs=array(
	'Center Storeproducts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CenterStoreproduct', 'url'=>array('index')),
	array('label'=>'Create CenterStoreproduct', 'url'=>array('create')),
	array('label'=>'Update CenterStoreproduct', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CenterStoreproduct', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CenterStoreproduct', 'url'=>array('admin')),
);
?>

<h1>View CenterStoreproduct #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_id',
		'lotnumber',
		'generate',
		'expire',
		'd_update',
		'number',
		'total',
	),
)); ?>
