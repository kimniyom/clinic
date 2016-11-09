<?php
/* @var $this MasuserController */
/* @var $model Masuser */

$this->breadcrumbs=array(
	'Masusers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Masuser', 'url'=>array('index')),
	array('label'=>'Manage Masuser', 'url'=>array('admin')),
);
?>

<h1>Create Masuser</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>