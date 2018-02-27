<?php
/* @var $this PatientController */
/* @var $model Patient */

$this->breadcrumbs=array(
	'ทะเบียนลูกค้า'=>array('index'),
	'ลงทะเบียนลูกค้า',
);

?>

<?php $this->renderPartial('_form', array('model'=>$model,'head' => 'ลงทะเบียนลูกค้า')); ?>