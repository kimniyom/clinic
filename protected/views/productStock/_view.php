<?php
/* @var $this ProductStockController */
/* @var $data ProductStock */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->product_id), array('view', 'id'=>$data->product_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::encode($data->id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('itemcode')); ?>:</b>
	<?php echo CHtml::encode($data->itemcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delete_flag')); ?>:</b>
	<?php echo CHtml::encode($data->delete_flag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expire')); ?>:</b>
	<?php echo CHtml::encode($data->expire); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_input')); ?>:</b>
	<?php echo CHtml::encode($data->date_input); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('d_update')); ?>:</b>
	<?php echo CHtml::encode($data->d_update); ?>
	<br />

	*/ ?>

</div>