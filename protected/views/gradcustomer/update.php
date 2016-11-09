<?php
/* @var $this GradcustomerController */
/* @var $model Gradcustomer */

$this->breadcrumbs = array(
    'Gradcustomers' => array('index'),
    $model->grad => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List Gradcustomer', 'url' => array('index')),
    array('label' => 'Create Gradcustomer', 'url' => array('create')),
    array('label' => 'View Gradcustomer', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage Gradcustomer', 'url' => array('admin')),
);
?>

<div class="panel panel-warning">
    <div class="panel-heading"><h4>Update Gradcustomer <?php echo $model->grad; ?></h4></div>
    <div class="panel-body">
        <?php $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
</div>