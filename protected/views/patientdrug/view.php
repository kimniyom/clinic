<?php
/* @var $this PatientDrugController */
/* @var $model PatientDrug */

$this->breadcrumbs=array(
	'Patient Drugs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PatientDrug', 'url'=>array('index')),
	array('label'=>'Create PatientDrug', 'url'=>array('create')),
	array('label'=>'Update PatientDrug', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PatientDrug', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PatientDrug', 'url'=>array('admin')),
);
?>

<h1>View PatientDrug #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'patient_id',
		'drug',
		'd_update',
	),
)); ?>
