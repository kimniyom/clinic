<?php
/* @var $this CenterStockitemController */
/* @var $model CenterStockitem */

$this->breadcrumbs=array(
        'คลังสินค้า' => Yii::app()->createUrl('stock/index'),
	'วัตถุดิบ'=>array('index'),
	//$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CenterStockitem', 'url'=>array('index')),
	array('label'=>'Create CenterStockitem', 'url'=>array('create')),
	array('label'=>'View CenterStockitem', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CenterStockitem', 'url'=>array('admin')),
);
?>

<h1>แก้ไขวัตถุดิบ <?php echo $model->itemname; ?></h1>
<hr/>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>