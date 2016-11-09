<?php
/* @var $this GradcustomerController */
/* @var $data Gradcustomer */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grad')); ?>:</b>
	<?php echo CHtml::encode($data->grad); ?>
	<br />


</div>