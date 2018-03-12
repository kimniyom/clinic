<?php
/* @var $this CompanycenterController */
/* @var $model Companycenter */

$this->breadcrumbs=array(
	'Companycenters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Companycenter', 'url'=>array('index')),
	array('label'=>'Manage Companycenter', 'url'=>array('admin')),
);
?>

<h4>Create Companycenter</h4>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>