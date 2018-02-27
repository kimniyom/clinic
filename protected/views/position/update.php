<?php
/* @var $this PositionController */
/* @var $model Position */

$this->breadcrumbs=array(
	'ตำแหน่งพนักงาน'=>array('index'),
	'แก้ไข',
);

?>

<h3>แก้ไข <?php echo $model->position; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>