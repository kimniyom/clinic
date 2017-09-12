<?php
/* @var $this PatientContactController */
/* @var $data PatientContact */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('patient_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->patient_id), array('view', 'id'=>$data->patient_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tel')); ?>:</b>
	<?php echo CHtml::encode($data->tel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number')); ?>:</b>
	<?php echo CHtml::encode($data->number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tambon')); ?>:</b>
	<?php echo CHtml::encode($data->tambon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amphur')); ?>:</b>
	<?php echo CHtml::encode($data->amphur); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('changwat')); ?>:</b>
	<?php echo CHtml::encode($data->changwat); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('zipcode')); ?>:</b>
	<?php echo CHtml::encode($data->zipcode); ?>
	<br />

	*/ ?>

</div>