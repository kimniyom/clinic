<?php
/* @var $this ListorderController */
/* @var $model Listorder */

$this->breadcrumbs=array(
	'Listorders'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Listorder', 'url'=>array('index')),
	array('label'=>'Create Listorder', 'url'=>array('create')),
	array('label'=>'View Listorder', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Listorder', 'url'=>array('admin')),
);
?>

<h1>Update Listorder <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>