<?php
/* @var $this ListorderController */
/* @var $model Listorder */

$this->breadcrumbs=array(
	'Listorders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Listorder', 'url'=>array('index')),
	array('label'=>'Manage Listorder', 'url'=>array('admin')),
);
?>

<h1>Create Listorder</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>