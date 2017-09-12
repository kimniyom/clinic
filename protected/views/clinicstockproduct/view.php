<?php
/* @var $this ClinicStockproductController */
/* @var $model ClinicStockproduct */

$this->breadcrumbs=array(
	'Clinic Stockproducts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ClinicStockproduct', 'url'=>array('index')),
	array('label'=>'Create ClinicStockproduct', 'url'=>array('create')),
	array('label'=>'Update ClinicStockproduct', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ClinicStockproduct', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClinicStockproduct', 'url'=>array('admin')),
);
?>

<h1>View ClinicStockproduct #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_id',
		'clinicname',
		'product_name',
		'product_nameclinic',
		'costs',
		'product_price',
		'product_detail',
		'type_id',
		'delete_flag',
		'status',
		'd_update',
		'branch',
		'subproducttype',
		'unit',
		'company',
		'size',
		'private',
	),
)); ?>
