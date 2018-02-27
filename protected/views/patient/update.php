<?php
/* @var $this PatientController */
/* @var $model Patient */

$this->breadcrumbs=array(
	'Patients'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
$head = "แก้ไขข้อมูล ".$model->name.' '.$model->lname;
?>



<?php $this->renderPartial('_form', array('model'=>$model,'head' => $head )); ?>