<?php
/* @var $this BonuslevelController */
/* @var $model Bonuslevel */

$this->breadcrumbs=array(
	'Bonuslevels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Bonuslevel', 'url'=>array('index')),
	array('label'=>'Manage Bonuslevel', 'url'=>array('admin')),
);
?>

<h1>Create Bonuslevel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>