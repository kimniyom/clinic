<?php
/* @var $this StatusUserController */
/* @var $model StatusUser */

$this->breadcrumbs=array(
	'Status Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StatusUser', 'url'=>array('index')),
	array('label'=>'Manage StatusUser', 'url'=>array('admin')),
);
?>

<h1>Create StatusUser</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>