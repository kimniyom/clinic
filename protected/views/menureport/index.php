<?php
/* @var $this MenuReportController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Menu Reports',
);

$this->menu=array(
	array('label'=>'Create MenuReport', 'url'=>array('create')),
	array('label'=>'Manage MenuReport', 'url'=>array('admin')),
);
?>

<h1>Menu Reports</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
