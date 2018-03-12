<?php
/* @var $this MascommisionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mascommisions',
);

$this->menu=array(
	array('label'=>'Create Mascommision', 'url'=>array('create')),
	array('label'=>'Manage Mascommision', 'url'=>array('admin')),
);
?>

<h1>Mascommisions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
