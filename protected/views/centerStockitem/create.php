<?php
/* @var $this CenterStockitemController */
/* @var $model CenterStockitem */

$this->breadcrumbs=array(
	'Item'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CenterStockitem', 'url'=>array('index')),
	array('label'=>'Manage CenterStockitem', 'url'=>array('admin')),
);
?>

<h1><img src="<?php echo Yii::app()->baseUrl;?>/images/text-plus-icon.png"/> เพิ่ม Item</h1>
<hr/>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>