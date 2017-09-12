<?php
/* @var $this CenterStockitemNameController */
/* @var $data CenterStockitemName */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('itemcode')); ?>:</b>
	<?php echo CHtml::encode($data->itemcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('itemname')); ?>:</b>
	<?php echo CHtml::encode($data->itemname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit')); ?>:</b>
	<?php echo CHtml::encode($data->unit); ?>
	<br />


</div>