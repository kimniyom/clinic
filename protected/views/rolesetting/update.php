<?php
/* @var $this RoleSettingController */
/* @var $model RoleSetting */

$this->breadcrumbs=array(
	'Role Settings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RoleSetting', 'url'=>array('index')),
	array('label'=>'Create RoleSetting', 'url'=>array('create')),
	array('label'=>'View RoleSetting', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RoleSetting', 'url'=>array('admin')),
);
?>

<h1>Update RoleSetting <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>