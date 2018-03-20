<?php
/* @var $this CompanycenterController */
/* @var $model Companycenter */

$this->breadcrumbs=array(
	'ข้อมูลบริษัท'=>array('store/index'),
	'แก้ไข',
);

?>

<h4>ที่อยู่ / ข้อมูลติดต่อ</h4>
<hr/>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>