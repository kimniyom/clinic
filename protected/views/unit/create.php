<?php
/* @var $this CenterStockunitController */
/* @var $model CenterStockunit */

$this->breadcrumbs=array(
	'units'=>array('index'),
	'Create',
);

?>

<h4><img src="<?php echo Yii::app()->baseUrl;?>/images/text-plus-icon.png"/> เพิ่มหน่วยนับ</h4>
<hr/>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>