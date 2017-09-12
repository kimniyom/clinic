<?php
/* @var $this PatientDiagController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Patient Diags',
);

$this->menu=array(
	array('label'=>'Create PatientDiag', 'url'=>array('create')),
	array('label'=>'Manage PatientDiag', 'url'=>array('admin')),
);
?>

<h1>Patient Diags</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
