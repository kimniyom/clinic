<?php
/* @var $this RoleMenuController */
/* @var $model RoleMenu */

$this->breadcrumbs=array(
	'Role Menus'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RoleMenu', 'url'=>array('index')),
	array('label'=>'Manage RoleMenu', 'url'=>array('admin')),
);
?>

<h1>Create RoleMenu</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>