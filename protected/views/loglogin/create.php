<?php
/* @var $this LogloginController */
/* @var $model Loglogin */

$this->breadcrumbs=array(
	'Loglogins'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Loglogin', 'url'=>array('index')),
	array('label'=>'Manage Loglogin', 'url'=>array('admin')),
);
?>

<h1>Create Loglogin</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>