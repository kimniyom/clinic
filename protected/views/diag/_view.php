<?php
/* @var $this DiagController */
/* @var $data Diag */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('diagcode')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->diagcode), array('view', 'id'=>$data->diagcode)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diagname')); ?>:</b>
	<?php echo CHtml::encode($data->diagname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />


</div>