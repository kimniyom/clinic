<?php
/* @var $this DiagController */
/* @var $model Diag */

$this->breadcrumbs = array(
    'Diags' => array('index'),
    $model->diagcode,
);

$this->menu = array(
    array('label' => 'List Diag', 'url' => array('index')),
    array('label' => 'Create Diag', 'url' => array('create')),
    array('label' => 'Update Diag', 'url' => array('update', 'id' => $model->diagcode)),
    array('label' => 'Delete Diag', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->diagcode), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Diag', 'url' => array('admin')),
);
?>

<h1>View Diag #<?php echo $model->diagcode; ?></h1>

<?php
$this->widget('booster.widgets.TbEditableDetailView', array(
    'data' => $model,
    'attributes' => array(
        'diagcode',
        'diagname',
        'price',
    ),
));
?>
