<?php
/* @var $this BranchController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Branches',
);

$this->menu = array(
    array('label' => 'Create Branch', 'url' => array('create')),
    array('label' => 'Manage Branch', 'url' => array('admin')),
);
?>

<h1>Branches</h1>
<a href="<?php echo Yii::app()->createUrl('branch/create') ?>">
    <button type="button" class="btn btn-success"><i class="fa fa-plus"></i> เพิ่มสาขา</button></a>
<br/><br/>

<div class="row">
    <?php foreach ($branch as $rs): ?>
        <div class="col-md-4 col-lg-4">
            <center>
                <img src="<?php echo Yii::app()->baseUrl; ?>/images/clinic-icon.png" height="32px"/>
                <h3>สาขา <?php echo $rs['branchname'] ?></h3>
            </center>
            <hr/>
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <button type="button" class="btn btn-default btn-block"><i class="fa fa-pencil-square-o"></i> แก้ไข</button>
                </div>
                <div class="col-md-6 col-lg-6">
                    <button type="button" class="btn btn-default btn-block"><i class="fa fa-trash-o"></i> ลบ</button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>