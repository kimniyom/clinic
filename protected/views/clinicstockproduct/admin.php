<?php
/* @var $this ClinicStockproductController */
/* @var $model ClinicStockproduct */

$this->breadcrumbs=array(
	'Clinic Stockproducts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ClinicStockproduct', 'url'=>array('index')),
	array('label'=>'Create ClinicStockproduct', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#clinic-stockproduct-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Clinic Stockproducts</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'clinic-stockproduct-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'product_id',
		'clinicname',
		'product_name',
		'product_nameclinic',
		'costs',
		/*
		'product_price',
		'product_detail',
		'type_id',
		'delete_flag',
		'status',
		'd_update',
		'branch',
		'subproducttype',
		'unit',
		'company',
		'size',
		'private',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
