<?php
/* @var $this ServiceController */
/* @var $data Service */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch')); ?>:</b>
	<?php echo CHtml::encode($data->branch); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('patient_id')); ?>:</b>
	<?php echo CHtml::encode($data->patient_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diagcode')); ?>:</b>
	<?php echo CHtml::encode($data->diagcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_total')); ?>:</b>
	<?php echo CHtml::encode($data->price_total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('checkbody')); ?>:</b>
	<?php echo CHtml::encode($data->checkbody); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('service_date')); ?>:</b>
	<?php echo CHtml::encode($data->service_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('service_result')); ?>:</b>
	<?php echo CHtml::encode($data->service_result); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('d_update')); ?>:</b>
	<?php echo CHtml::encode($data->d_update); ?>
	<br />

	*/ ?>

</div>