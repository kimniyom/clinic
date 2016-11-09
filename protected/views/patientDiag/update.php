<?php
/* @var $this PatientDiagController */
/* @var $model PatientDiag */

$this->breadcrumbs=array(
	'Patient Diags'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PatientDiag', 'url'=>array('index')),
	array('label'=>'Create PatientDiag', 'url'=>array('create')),
	array('label'=>'View PatientDiag', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PatientDiag', 'url'=>array('admin')),
);
?>

<h1>Update PatientDiag <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>