<?php
/* @var $this OcupationController */
/* @var $model Ocupation */

$this->breadcrumbs=array(
	'Ocupations'=>array('index'),
	$model->occupationname,
);

?>

<h1>View Ocupation <?php echo $model->occupationname; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'occupationname',
	),
)); ?>
