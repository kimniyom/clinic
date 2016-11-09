<?php
/* @var $this AppointController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Appoints',
);

$this->menu=array(
	array('label'=>'Create Appoint', 'url'=>array('create')),
	array('label'=>'Manage Appoint', 'url'=>array('admin')),
);
?>

<h1>Appoints</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
