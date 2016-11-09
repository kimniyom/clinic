<?php
/* @var $this OcupationController */
/* @var $data Ocupation */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('occupationname')); ?>:</b>
	<?php echo CHtml::encode($data->occupationname); ?>
	<br />


</div>