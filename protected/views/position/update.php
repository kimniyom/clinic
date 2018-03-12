<?php
/* @var $this PositionController */
/* @var $model Position */

$this->breadcrumbs=array(
	'ตำแหน่งพนักงาน'=>array('index'),
	'แก้ไข',
);

?>

<h4>แก้ไข <?php echo $model->position; ?></h4>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>