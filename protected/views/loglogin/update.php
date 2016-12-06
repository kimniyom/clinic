<?php
/* @var $this LogloginController */
/* @var $model Loglogin */

$this->breadcrumbs=array(
	'Loglogins'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Loglogin', 'url'=>array('index')),
	array('label'=>'Create Loglogin', 'url'=>array('create')),
	array('label'=>'View Loglogin', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Loglogin', 'url'=>array('admin')),
);
?>

<h1>Update Loglogin <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>