<?php
/* @var $this PatientDiseaseController */
/* @var $model PatientDisease */

$this->breadcrumbs=array(
	'Patient Diseases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PatientDisease', 'url'=>array('index')),
	array('label'=>'Create PatientDisease', 'url'=>array('create')),
	array('label'=>'View PatientDisease', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PatientDisease', 'url'=>array('admin')),
);
?>

<h1>Update PatientDisease <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'patient_id' => $patient_id)); ?>