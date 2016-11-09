<?php
/* @var $this PatientDiseaseController */
/* @var $model PatientDisease */

$this->breadcrumbs=array(
	'Patient Diseases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PatientDisease', 'url'=>array('index')),
	array('label'=>'Create PatientDisease', 'url'=>array('create')),
	array('label'=>'Update PatientDisease', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PatientDisease', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PatientDisease', 'url'=>array('admin')),
);
?>

<h1>View PatientDisease #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'patient_id',
		'disease',
		'd_update',
	),
)); ?>
