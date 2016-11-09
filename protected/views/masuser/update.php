<?php
/* @var $this MasuserController */
/* @var $model Masuser */

$this->breadcrumbs=array(
	'Masusers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Masuser', 'url'=>array('index')),
	array('label'=>'Create Masuser', 'url'=>array('create')),
	array('label'=>'View Masuser', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Masuser', 'url'=>array('admin')),
);
?>

<h1>Update Masuser <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>