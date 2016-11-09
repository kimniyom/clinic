<?php
/* @var $this ServiceImagesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Service Images',
);

$this->menu=array(
	array('label'=>'Create ServiceImages', 'url'=>array('create')),
	array('label'=>'Manage ServiceImages', 'url'=>array('admin')),
);
?>

<h1>Service Images</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
