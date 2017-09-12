<?php
/* @var $this ServiceImagesController */
/* @var $model ServiceImages */

$this->breadcrumbs=array(
	'Service Images'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ServiceImages', 'url'=>array('index')),
	array('label'=>'Create ServiceImages', 'url'=>array('create')),
	array('label'=>'View ServiceImages', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ServiceImages', 'url'=>array('admin')),
);
?>

<h1>Update ServiceImages <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>