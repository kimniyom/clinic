<?php
/* @var $this RoleMenuController */
/* @var $model RoleMenu */

$this->breadcrumbs=array(
	'Role Menus'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RoleMenu', 'url'=>array('index')),
	array('label'=>'Create RoleMenu', 'url'=>array('create')),
	array('label'=>'View RoleMenu', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RoleMenu', 'url'=>array('admin')),
);
?>

<h1>Update RoleMenu <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>