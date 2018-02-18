<?php
/* @var $this RepairController */
/* @var $model Repair */

$this->breadcrumbs=array(
	'Repairs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Repair', 'url'=>array('index')),
	array('label'=>'Create Repair', 'url'=>array('create')),
	array('label'=>'View Repair', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Repair', 'url'=>array('admin')),
);
?>

<h1>Update Repair <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>