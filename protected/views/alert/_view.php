<?php
/* @var $this AlertController */
/* @var $data Alert */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alert_appoint')); ?>:</b>
	<?php echo CHtml::encode($data->alert_appoint); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alert_product')); ?>:</b>
	<?php echo CHtml::encode($data->alert_product); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alert_expire')); ?>:</b>
	<?php echo CHtml::encode($data->alert_expire); ?>
	<br />


</div>