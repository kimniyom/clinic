<?php
/* @var $this PatientDiagController */
/* @var $model PatientDiag */

$this->breadcrumbs=array(
	'Patient Diags'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PatientDiag', 'url'=>array('index')),
	array('label'=>'Manage PatientDiag', 'url'=>array('admin')),
);
?>

<h1>Create PatientDiag</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>