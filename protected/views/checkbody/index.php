<?php
/* @var $this CheckbodyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Checkbodies',
);

$this->menu=array(
	array('label'=>'Create Checkbody', 'url'=>array('create')),
	array('label'=>'Manage Checkbody', 'url'=>array('admin')),
);
?>

<h1>Checkbodies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
