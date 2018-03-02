<?php
/* @var $this RepairController */
/* @var $model Repair */

$this->breadcrumbs=array(
	'ซ่อม - บำรุง'=>array('index'),
	'เพิ่ม',
);

?>

<h4>เพิ่มข้อมูลซ่อม - บำรุง(ครั้งต่อไป)</h4>

<?php $this->renderPartial('_form', array('model'=>$model,'datealert' => $datealert)); ?>