<?php
/* @var $this CenterStockmixController */
/* @var $model CenterStockmix */

$this->breadcrumbs=array(
	'Center Stockmixes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CenterStockmix', 'url'=>array('index')),
	array('label'=>'Create CenterStockmix', 'url'=>array('create')),
	array('label'=>'View CenterStockmix', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CenterStockmix', 'url'=>array('admin')),
);
?>

<h1>Update CenterStockmix <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>