<?php
/* @var $this CenterStockproductController */
/* @var $model CenterStockproduct */

$this->breadcrumbs=array(
	'Center Stockproducts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CenterStockproduct', 'url'=>array('index')),
	array('label'=>'Create CenterStockproduct', 'url'=>array('create')),
	array('label'=>'View CenterStockproduct', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CenterStockproduct', 'url'=>array('admin')),
);
?>

<h1>Update CenterStockproduct <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>