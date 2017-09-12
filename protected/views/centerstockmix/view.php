<?php
/* @var $this CenterStockmixController */
/* @var $model CenterStockmix */

$this->breadcrumbs=array(
	'Center Stockmixes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CenterStockmix', 'url'=>array('index')),
	array('label'=>'Create CenterStockmix', 'url'=>array('create')),
	array('label'=>'Update CenterStockmix', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CenterStockmix', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CenterStockmix', 'url'=>array('admin')),
);
?>

<h1>View CenterStockmix #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'productcode',
		'itemcode',
		'number',
		'total',
		'create_date',
	),
)); ?>
