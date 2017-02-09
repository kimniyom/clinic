<?php
/* @var $this CompanycenterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Companycenters',
);

$this->menu=array(
	array('label'=>'Create Companycenter', 'url'=>array('create')),
	array('label'=>'Manage Companycenter', 'url'=>array('admin')),
);
?>

<h1>Companycenters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
