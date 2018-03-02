<?php
/* @var $this BranchController */
/* @var $model Branch */

$this->breadcrumbs=array(
	'Branches'=>array('index'),
	'Create',
);

?>

<h4>เพิ่มสาขา</h4>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>