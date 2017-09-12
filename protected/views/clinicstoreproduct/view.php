<?php
/* @var $this ClinicStoreproductController */
/* @var $model ClinicStoreproduct */

$this->breadcrumbs=array(
	'Clinic Storeproducts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ClinicStoreproduct', 'url'=>array('index')),
	array('label'=>'Create ClinicStoreproduct', 'url'=>array('create')),
	array('label'=>'Update ClinicStoreproduct', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ClinicStoreproduct', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClinicStoreproduct', 'url'=>array('admin')),
);
?>

<h1>View ClinicStoreproduct #<?php echo $model->id; ?></h1>

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
		'branch',
	),
)); ?>
