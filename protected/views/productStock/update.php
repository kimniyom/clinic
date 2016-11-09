<?php
/* @var $this ProductStockController */
/* @var $model ProductStock */

$this->breadcrumbs=array(
	'Product Stocks'=>array('index'),
	$model->product_id=>array('view','id'=>$model->product_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductStock', 'url'=>array('index')),
	array('label'=>'Create ProductStock', 'url'=>array('create')),
	array('label'=>'View ProductStock', 'url'=>array('view', 'id'=>$model->product_id)),
	array('label'=>'Manage ProductStock', 'url'=>array('admin')),
);
?>

<h1>Update ProductStock <?php echo $model->product_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>