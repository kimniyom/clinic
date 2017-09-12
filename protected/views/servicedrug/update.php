<?php
/* @var $this ServiceDrugController */
/* @var $model ServiceDrug */

$this->breadcrumbs=array(
	'Service Drugs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ServiceDrug', 'url'=>array('index')),
	array('label'=>'Create ServiceDrug', 'url'=>array('create')),
	array('label'=>'View ServiceDrug', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ServiceDrug', 'url'=>array('admin')),
);
?>

<h1>Update ServiceDrug <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>