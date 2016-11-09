<?php
/* @var $this CheckbodyController */
/* @var $model Checkbody */

$this->breadcrumbs=array(
	'Checkbodies'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Checkbody', 'url'=>array('index')),
	array('label'=>'Create Checkbody', 'url'=>array('create')),
	array('label'=>'View Checkbody', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Checkbody', 'url'=>array('admin')),
);
?>

<h1>Update Checkbody <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>