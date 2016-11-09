<?php
/* @var $this GradcustomerController */
/* @var $model Gradcustomer */

$this->breadcrumbs = array(
    'Gradcustomers' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Gradcustomer', 'url' => array('index')),
    array('label' => 'Manage Gradcustomer', 'url' => array('admin')),
);
?>


<div class="panel panel-success">
    <div class="panel-heading"><h4>Create Gradcustomer</h4></div>
    <div class="panel-body">
        <?php $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
</div>