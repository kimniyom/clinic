<?php
/* @var $this MascommisionController */
/* @var $data Mascommision */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commisionname')); ?>:</b>
	<?php echo CHtml::encode($data->commisionname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_status')); ?>:</b>
	<?php echo CHtml::encode($data->user_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valuecom')); ?>:</b>
	<?php echo CHtml::encode($data->valuecom); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('typevalue')); ?>:</b>
	<?php echo CHtml::encode($data->typevalue); ?>
	<br />


</div>