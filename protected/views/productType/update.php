<?php
/* @var $this ProductTypeController */
/* @var $model ProductType */

$this->breadcrumbs=array(
	'Product Types'=>array('index'),
	$model->type_id=>array('view','id'=>$model->type_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductType', 'url'=>array('index')),
	array('label'=>'Create ProductType', 'url'=>array('create')),
	array('label'=>'View ProductType', 'url'=>array('view', 'id'=>$model->type_id)),
	array('label'=>'Manage ProductType', 'url'=>array('admin')),
);
?>

<h1>Update ProductType <?php echo $model->type_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>