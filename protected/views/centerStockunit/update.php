<?php
/* @var $this CenterStockunitController */
/* @var $model CenterStockunit */

$this->breadcrumbs=array(
	'Center Stockunits'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CenterStockunit', 'url'=>array('index')),
	array('label'=>'Create CenterStockunit', 'url'=>array('create')),
	array('label'=>'View CenterStockunit', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CenterStockunit', 'url'=>array('admin')),
);
?>

<h1>Update CenterStockunit <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>