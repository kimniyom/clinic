<?php
/* @var $this PatientController */
/* @var $model Patient */

$this->breadcrumbs=array(
	'Patients'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>แก้ไขข้อมูล <?php echo $model->name.' '.$model->lname; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>