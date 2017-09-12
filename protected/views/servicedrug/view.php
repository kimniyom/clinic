<?php
/* @var $this ServiceDrugController */
/* @var $model ServiceDrug */

$this->breadcrumbs=array(
	'Service Drugs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ServiceDrug', 'url'=>array('index')),
	array('label'=>'Create ServiceDrug', 'url'=>array('create')),
	array('label'=>'Update ServiceDrug', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ServiceDrug', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ServiceDrug', 'url'=>array('admin')),
);
?>

<h1>View ServiceDrug #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'patient_id',
		'drug',
		'service_id',
		'user_id',
		'diagcode',
		'price',
		'branch',
		'date_serv',
	),
)); ?>
