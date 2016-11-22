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

<div class="row">
    <?php foreach ($branch as $rs): ?>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail" style=" text-align: center;">
                <img src="<?php echo Yii::app()->baseUrl; ?>/images/clinic-icon.png" />
                <div class="caption">
                    <h3>สาขา : <?php echo $rs['branchname'] ?></h3>
                    <p><?php echo $rs['address'] ?></p>
                    <hr/>
                    <p><a href="<?php echo Yii::app()->createUrl('branch/update', array("id" => $rs['id'])) ?>" class="btn btn-primary" role="button">แก้ไข</a> 
                        <a href="#" class="btn btn-default" role="button">ลบ</a></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>