<?php
/* @var $this DiagController */
/* @var $model Diag */

$this->breadcrumbs=array(
	'หัตถการ'=>array('index'),
	'Create',
);

?>

<h4>เพิ่มรายการหัตถการ</h4>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>