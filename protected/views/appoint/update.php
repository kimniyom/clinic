<?php
/* @var $this AppointController */
/* @var $model Appoint */

$this->breadcrumbs=array(
	'Appoints'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Appoint', 'url'=>array('index')),
	array('label'=>'Create Appoint', 'url'=>array('create')),
	array('label'=>'View Appoint', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Appoint', 'url'=>array('admin')),
);
?>

<h1>Update Appoint <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>