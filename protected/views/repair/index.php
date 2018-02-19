<?php
/* @var $this RepairController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'ซ่อม - บำรุง',
);

?>

<h1>Repairs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
