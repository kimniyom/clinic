<?php
/* @var $this BranchController */
/* @var $model Branch */

$this->breadcrumbs = array(
    'ข้อมูลสาขา' => array('index'),
    //$model->id => array('view', 'id' => $model->id),
    'แก้ไข',
);
?>

<h4>แก้ไขข้อมูลสาขา <?php echo $model->branchname; ?></h4>

<?php $this->renderPartial('_form', array('model' => $model)); ?>