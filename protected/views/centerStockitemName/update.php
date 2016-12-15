<?php
/* @var $this CenterStockitemNameController */
/* @var $model CenterStockitemName */

$this->breadcrumbs=array(
	'Center Stockitem Names'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CenterStockitemName', 'url'=>array('index')),
	array('label'=>'Create CenterStockitemName', 'url'=>array('create')),
	array('label'=>'View CenterStockitemName', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CenterStockitemName', 'url'=>array('admin')),
);
?>

<h1>Update CenterStockitemName <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>