<?php
/* @var $this MasuserController */
/* @var $model Masuser */

$this->breadcrumbs = array(
    'ผู้ใช้งาน' => array('index'),
    $model->username => array('view', 'id' => $model->id, 'user_id' => $user_id),
    'แก้ไข',
);

$this->menu = array(
    array('label' => 'List Masuser', 'url' => array('index')),
    array('label' => 'Create Masuser', 'url' => array('create')),
    array('label' => 'View Masuser', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage Masuser', 'url' => array('admin')),
);
?>

<h1>แก้ไข <?php echo $model->username; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>