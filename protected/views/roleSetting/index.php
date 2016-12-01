<?php
/* @var $this RoleSettingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Role Settings',
);

$this->menu=array(
	array('label'=>'Create RoleSetting', 'url'=>array('create')),
	array('label'=>'Manage RoleSetting', 'url'=>array('admin')),
);
?>

<h1>Role Settings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
