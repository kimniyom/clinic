<?php
/* @var $this PatientController */
/* @var $model Patient */

$this->breadcrumbs=array(
	'ทะเบียนลูกค้า'=>array('index'),
	'ลงทะเบียนลูกค้า',
);

$this->menu=array(
	array('label'=>'List Patient', 'url'=>array('index')),
	array('label'=>'Manage Patient', 'url'=>array('admin')),
);
?>

<h1>ลงทะเบียนลูกค้า</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>