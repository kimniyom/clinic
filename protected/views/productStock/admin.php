<?php
/* @var $this ProductStockController */
/* @var $model ProductStock */

$this->breadcrumbs=array(
	'Product Stocks'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ProductStock', 'url'=>array('index')),
	array('label'=>'Create ProductStock', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-stock-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Product Stocks</h1>

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
	'id'=>'product-stock-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'itemcode',
		'product_id',
		'delete_flag',
		'status',
		'expire',
		/*
		'date_input',
		'd_update',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
