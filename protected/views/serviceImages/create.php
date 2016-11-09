<?php
/* @var $this ServiceImagesController */
/* @var $model ServiceImages */

$this->breadcrumbs=array(
	'Service Images'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ServiceImages', 'url'=>array('index')),
	array('label'=>'Manage ServiceImages', 'url'=>array('admin')),
);
?>

<h1>Create ServiceImages</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>