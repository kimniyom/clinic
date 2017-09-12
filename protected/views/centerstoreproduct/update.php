<?php
/* @var $this CenterStoreproductController */
/* @var $model CenterStoreproduct */

$this->breadcrumbs=array(
	'Center Storeproducts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CenterStoreproduct', 'url'=>array('index')),
	array('label'=>'Create CenterStoreproduct', 'url'=>array('create')),
	array('label'=>'View CenterStoreproduct', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CenterStoreproduct', 'url'=>array('admin')),
);
?>

<h1>Update CenterStoreproduct <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>