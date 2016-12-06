<?php
/* @var $this LogloginController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Loglogins',
);

$this->menu=array(
	array('label'=>'Create Loglogin', 'url'=>array('create')),
	array('label'=>'Manage Loglogin', 'url'=>array('admin')),
);
?>

<h1>Loglogins</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
