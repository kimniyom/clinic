<?php
/* @var $this StatusUserController */
/* @var $model StatusUser */

$this->breadcrumbs=array(
	'Status Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List StatusUser', 'url'=>array('index')),
	array('label'=>'Create StatusUser', 'url'=>array('create')),
	array('label'=>'View StatusUser', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage StatusUser', 'url'=>array('admin')),
);
?>

<h1>Update StatusUser <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>