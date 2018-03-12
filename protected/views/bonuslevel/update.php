<?php
/* @var $this BonuslevelController */
/* @var $model Bonuslevel */

$this->breadcrumbs=array(
	'Bonuslevels'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Bonuslevel', 'url'=>array('index')),
	array('label'=>'Create Bonuslevel', 'url'=>array('create')),
	array('label'=>'View Bonuslevel', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Bonuslevel', 'url'=>array('admin')),
);
?>

<h1>Update Bonuslevel <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>