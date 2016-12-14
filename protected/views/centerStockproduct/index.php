<?php
/* @var $this CenterStockproductController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Center Stockproducts',
);

$this->menu=array(
	array('label'=>'Create CenterStockproduct', 'url'=>array('create')),
	array('label'=>'Manage CenterStockproduct', 'url'=>array('admin')),
);
?>

<h1>Center Stockproducts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
