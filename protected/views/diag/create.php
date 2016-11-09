<?php
/* @var $this DiagController */
/* @var $model Diag */

$this->breadcrumbs=array(
	'หัตถการ'=>array('index'),
	'Create',
);

?>

<h1>เพิ่มรายการหัตถการ</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>