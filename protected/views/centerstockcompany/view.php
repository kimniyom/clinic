<?php
/* @var $this CenterStockcompanyController */
/* @var $model CenterStockcompany */

$this->breadcrumbs=array(
	'Center Stockcompanies'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CenterStockcompany', 'url'=>array('index')),
	array('label'=>'Create CenterStockcompany', 'url'=>array('create')),
	array('label'=>'Update CenterStockcompany', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CenterStockcompany', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CenterStockcompany', 'url'=>array('admin')),
);
?>

<h1>View CenterStockcompany #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'company_id',
		'company_name',
		'address',
		'tel',
	),
)); ?>
