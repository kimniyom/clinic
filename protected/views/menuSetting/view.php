<?php
/* @var $this MenuSettingController */
/* @var $model MenuSetting */

$this->breadcrumbs=array(
	'Menu Settings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MenuSetting', 'url'=>array('index')),
	array('label'=>'Create MenuSetting', 'url'=>array('create')),
	array('label'=>'Update MenuSetting', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MenuSetting', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MenuSetting', 'url'=>array('admin')),
);
?>

<h1>View MenuSetting #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'setting',
		'user_id',
		'url',
	),
)); ?>
