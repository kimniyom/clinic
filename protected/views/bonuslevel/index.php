<?php
/* @var $this BonuslevelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bonuslevels',
);

?>

<h1>Bonuslevels</h1>

<?php 
/*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
*/
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'branch-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'startlevel',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
