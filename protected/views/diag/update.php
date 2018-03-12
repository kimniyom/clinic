<?php
/* @var $this DiagController */
/* @var $model Diag */

$this->breadcrumbs=array(
	'หัตถการ'=>array('index'),
	$model->diagname=>array('view','id'=>$model->diagcode),
	'Update',
);

?>

<h4>แก้ไขรายการหัตถการ <?php echo $model->diagname; ?></h4>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>