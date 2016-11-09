<?php
/* @var $this CheckbodyController */
/* @var $data Checkbody */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('patient_id')); ?>:</b>
	<?php echo CHtml::encode($data->patient_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('btemp')); ?>:</b>
	<?php echo CHtml::encode($data->btemp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr')); ?>:</b>
	<?php echo CHtml::encode($data->pr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rr')); ?>:</b>
	<?php echo CHtml::encode($data->rr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_serv')); ?>:</b>
	<?php echo CHtml::encode($data->date_serv); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch')); ?>:</b>
	<?php echo CHtml::encode($data->branch); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	*/ ?>

</div>