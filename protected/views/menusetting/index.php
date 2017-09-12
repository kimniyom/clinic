<?php
/* @var $this MenuSettingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Menu Settings',
);

$this->menu=array(
	array('label'=>'Create MenuSetting', 'url'=>array('create')),
	array('label'=>'Manage MenuSetting', 'url'=>array('admin')),
);
?>

<h1>Menu Settings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
