<?php
/* @var $this PatientDiseaseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Patient Diseases',
);

$this->menu=array(
	array('label'=>'Create PatientDisease', 'url'=>array('create')),
	array('label'=>'Manage PatientDisease', 'url'=>array('admin')),
);
?>

<h1>Patient Diseases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
