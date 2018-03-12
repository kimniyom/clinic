<?php
/* @var $this BonuslevelController */
/* @var $model Bonuslevel */

$this->breadcrumbs=array(
	'Bonuslevels'=>array('index'),
	$model->id,
);

?>

<h1>View Bonuslevel #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'startlevel',
		'endlevel',
		'bonus',
		'branch',
	),
)); ?>
