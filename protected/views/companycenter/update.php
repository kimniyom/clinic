<?php
/* @var $this CompanycenterController */
/* @var $model Companycenter */

$this->breadcrumbs=array(
	'คลังสินค้า'=>array('store/index'),
	'Update',
);

$this->menu=array(
	array('label'=>'List Companycenter', 'url'=>array('index')),
	array('label'=>'Create Companycenter', 'url'=>array('create')),
	array('label'=>'View Companycenter', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Companycenter', 'url'=>array('admin')),
);
?>

<h1>ที่อยู่ / ข้อมูลติดต่อ</h1>
<hr/>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>