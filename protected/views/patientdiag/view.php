<?php
/* @var $this PatientDiagController */
/* @var $model PatientDiag */

$this->breadcrumbs=array(
	'Patient Diags'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PatientDiag', 'url'=>array('index')),
	array('label'=>'Create PatientDiag', 'url'=>array('create')),
	array('label'=>'Update PatientDiag', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PatientDiag', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PatientDiag', 'url'=>array('admin')),
);
?>

<h1>View PatientDiag #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'patient_id',
		'diag',
		'create_date',
	),
)); ?>
