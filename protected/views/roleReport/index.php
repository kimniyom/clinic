<?php
/* @var $this RoleReportController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Role Reports',
);

$this->menu=array(
	array('label'=>'Create RoleReport', 'url'=>array('create')),
	array('label'=>'Manage RoleReport', 'url'=>array('admin')),
);
?>

<h1>Role Reports</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
