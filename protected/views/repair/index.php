<?php
/* @var $this RepairController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Repairs',
);

$this->menu=array(
	array('label'=>'Create Repair', 'url'=>array('create')),
	array('label'=>'Manage Repair', 'url'=>array('admin')),
);
?>

<h1>Repairs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
