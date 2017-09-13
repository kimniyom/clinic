<?php
/* @var $this EmployeeController */
/* @var $model Employee */

$this->breadcrumbs=array(
	'พนักงาน'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'แก้ไข',
);

?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>