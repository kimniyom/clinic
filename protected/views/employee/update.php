<?php
/* @var $this EmployeeController */
/* @var $model Employee */

$this->breadcrumbs=array(
	'พนักงาน'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>แก้ไขข้อมูล <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>