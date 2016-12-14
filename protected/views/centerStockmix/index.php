<?php
/* @var $this CenterStockmixController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Center Stockmixes',
);

$this->menu=array(
	array('label'=>'Create CenterStockmix', 'url'=>array('create')),
	array('label'=>'Manage CenterStockmix', 'url'=>array('admin')),
);
?>

<h1>Center Stockmixes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
