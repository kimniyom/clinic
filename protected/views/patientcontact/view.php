<?php
/* @var $this PatientContactController */
/* @var $model PatientContact */

$this->breadcrumbs=array(
	'Patient Contacts'=>array('index'),
	$model->patient_id,
);

$this->menu=array(
	array('label'=>'List PatientContact', 'url'=>array('index')),
	array('label'=>'Create PatientContact', 'url'=>array('create')),
	array('label'=>'Update PatientContact', 'url'=>array('update', 'id'=>$model->patient_id)),
	array('label'=>'Delete PatientContact', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->patient_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PatientContact', 'url'=>array('admin')),
);
?>

<h1>View PatientContact #<?php echo $model->patient_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'patient_id',
		'tel',
		'email',
		'number',
		'tambon',
		'amphur',
		'changwat',
		'zipcode',
	),
)); ?>
