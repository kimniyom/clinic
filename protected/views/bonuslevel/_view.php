<?php
/* @var $this BonuslevelController */
/* @var $data Bonuslevel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('startlevel')); ?>:</b>
	<?php echo CHtml::encode($data->startlevel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('endlevel')); ?>:</b>
	<?php echo CHtml::encode($data->endlevel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bonus')); ?>:</b>
	<?php echo CHtml::encode($data->bonus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch')); ?>:</b>
	<?php echo CHtml::encode($data->branch); ?>
	<br />


</div>