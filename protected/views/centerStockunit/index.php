<?php
/* @var $this CenterStockunitController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Center Stockunits',
);

$this->menu=array(
	array('label'=>'Create CenterStockunit', 'url'=>array('create')),
	array('label'=>'Manage CenterStockunit', 'url'=>array('admin')),
);
?>

<h1>Center Stockunits</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
