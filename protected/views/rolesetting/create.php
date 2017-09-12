<?php
/* @var $this RoleSettingController */
/* @var $model RoleSetting */

$this->breadcrumbs=array(
	'Role Settings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RoleSetting', 'url'=>array('index')),
	array('label'=>'Manage RoleSetting', 'url'=>array('admin')),
);
?>

<h1>Create RoleSetting</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>