<?php
/* @var $this CenterStockitemController */
/* @var $model CenterStockitem */

$this->breadcrumbs=array(
        'คลังสินค้า' => Yii::app()->createUrl('store/index'),
	'วัตถุดิบ'=>array('index'),
	//$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>แก้ไขวัตถุดิบ <?php echo $model->id; ?></h1>
<hr/>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>