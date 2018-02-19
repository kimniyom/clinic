<?php
/* @var $this RepairController */
/* @var $model Repair */

$this->breadcrumbs=array(
	'ซ่อม - บำรุง'=>array('index'),
	$model->id,
);

?>

<h1>View Repair #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'object',
		'detail',
		'price',
		'user',
		'd_update',
		'date_alert',
		'status',
	),
)); ?>
