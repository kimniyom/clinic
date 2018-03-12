<?php
/* @var $this CenterStockitemController */
/* @var $model CenterStockitem */

$this->breadcrumbs=array(
        //'คลังสินค้า' => Yii::app()->createUrl('store/index'),
	'คลังวัตถุดิบ'=>array('index'),
	//$model->id=>array('view','id'=>$model->id),
	'แก้ไข',
);

?>

<h4>แก้ไขวัตถุดิบ <?php echo $model->id; ?></h4>
<hr/>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>