<?php
/* @var $this MenuSettingController */
/* @var $model MenuSetting */

$this->breadcrumbs=array(
	'Menu Settings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MenuSetting', 'url'=>array('index')),
	array('label'=>'Create MenuSetting', 'url'=>array('create')),
	array('label'=>'View MenuSetting', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MenuSetting', 'url'=>array('admin')),
);
?>

<h1>Update MenuSetting <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>