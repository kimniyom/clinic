<?php
/* @var $this MenuReportController */
/* @var $model MenuReport */

$this->breadcrumbs=array(
	'Menu Reports'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MenuReport', 'url'=>array('index')),
	array('label'=>'Create MenuReport', 'url'=>array('create')),
	array('label'=>'View MenuReport', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MenuReport', 'url'=>array('admin')),
);
?>

<h1>Update MenuReport <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>