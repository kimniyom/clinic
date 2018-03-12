<?php
/* @var $this MascommisionController */
/* @var $model Mascommision */

$this->breadcrumbs=array(
	'Mascommisions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Mascommision', 'url'=>array('index')),
	array('label'=>'Create Mascommision', 'url'=>array('create')),
	array('label'=>'View Mascommision', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Mascommision', 'url'=>array('admin')),
);
?>

<h4>Update Mascommision <?php echo $model->id; ?></h4>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>