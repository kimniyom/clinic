<?php
/* @var $this CenterStockitemController */
/* @var $model CenterStockitem */

$this->breadcrumbs=array(
	'Center Stockitems'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CenterStockitem', 'url'=>array('index')),
	array('label'=>'Create CenterStockitem', 'url'=>array('create')),
	array('label'=>'View CenterStockitem', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CenterStockitem', 'url'=>array('admin')),
);
?>

<h1>Update CenterStockitem <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>