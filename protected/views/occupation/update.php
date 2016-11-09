<?php
/* @var $this OcupationController */
/* @var $model Ocupation */

$this->breadcrumbs=array(
	'Ocupations'=>array('index'),
	$model->occupationname=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Update Ocupation <?php echo $model->occupationname; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>