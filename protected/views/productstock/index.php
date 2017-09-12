<?php
/* @var $this ProductStockController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Product Stocks',
);

$this->menu=array(
	array('label'=>'Create ProductStock', 'url'=>array('create')),
	array('label'=>'Manage ProductStock', 'url'=>array('admin')),
);
?>

<h1>Product Stocks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
