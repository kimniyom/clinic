<?php
/* @var $this GradcustomerController */
/* @var $model Gradcustomer */

$this->breadcrumbs=array(
	'Gradcustomers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Gradcustomer', 'url'=>array('index')),
	array('label'=>'Create Gradcustomer', 'url'=>array('create')),
	array('label'=>'Update Gradcustomer', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Gradcustomer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Gradcustomer', 'url'=>array('admin')),
);
?>

<h1>View Gradcustomer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'grad',
		'distcount',
	),
)); ?>
