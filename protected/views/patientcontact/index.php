<?php
/* @var $this PatientContactController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Patient Contacts',
);

$this->menu=array(
	array('label'=>'Create PatientContact', 'url'=>array('create')),
	array('label'=>'Manage PatientContact', 'url'=>array('admin')),
);
?>

<h1>Patient Contacts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
