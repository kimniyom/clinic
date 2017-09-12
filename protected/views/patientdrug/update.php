<?php
/* @var $this PatientDrugController */
/* @var $model PatientDrug */

$this->breadcrumbs=array(
	'Patient Drugs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PatientDrug', 'url'=>array('index')),
	array('label'=>'Create PatientDrug', 'url'=>array('create')),
	array('label'=>'View PatientDrug', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PatientDrug', 'url'=>array('admin')),
);
?>

<h1>Update PatientDrug <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'patient_id' => $patient_id)); ?>