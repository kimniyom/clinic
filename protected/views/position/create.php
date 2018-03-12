<?php
/* @var $this PositionController */
/* @var $model Position */

$this->breadcrumbs=array(
	'ตำแหน่งพนังงาน'=>array('index'),
	'เพิ่ม',
);

?>

<h4>ตำแหน่งพนังงาน</h4>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>