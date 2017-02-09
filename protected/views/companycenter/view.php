<?php
/* @var $this CompanycenterController */
/* @var $model Companycenter */

$this->breadcrumbs=array(
	'Companycenters'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Companycenter', 'url'=>array('index')),
	array('label'=>'Create Companycenter', 'url'=>array('create')),
	array('label'=>'Update Companycenter', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Companycenter', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Companycenter', 'url'=>array('admin')),
);
?>

<h1>View Companycenter #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'companyname',
		'address',
		'tel',
		'memager',
	),
)); ?>
