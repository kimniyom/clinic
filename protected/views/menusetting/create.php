<?php
/* @var $this MenuSettingController */
/* @var $model MenuSetting */

$this->breadcrumbs=array(
	'Menu Settings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MenuSetting', 'url'=>array('index')),
	array('label'=>'Manage MenuSetting', 'url'=>array('admin')),
);
?>

<h1>Create MenuSetting</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>