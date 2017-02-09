<?php
/* @var $this ListorderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Listorders',
);

$this->menu=array(
	array('label'=>'Create Listorder', 'url'=>array('create')),
	array('label'=>'Manage Listorder', 'url'=>array('admin')),
);
?>

<h1>Listorders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
