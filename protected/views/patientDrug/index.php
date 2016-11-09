<?php
/* @var $this PatientDrugController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Patient Drugs',
);

$this->menu=array(
	array('label'=>'Create PatientDrug', 'url'=>array('create')),
	array('label'=>'Manage PatientDrug', 'url'=>array('admin')),
);
?>

<h1>Patient Drugs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
