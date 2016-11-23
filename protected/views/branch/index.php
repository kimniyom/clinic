<?php
/* @var $this BranchController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Branches',
);
?>

<h1>Branches</h1>
<a href="<?php echo Yii::app()->createUrl('branch/create') ?>">
    <button type="button" class="btn btn-default"><i class="fa fa-plus"></i> เพิ่มสาขา</button></a><br/><br/>
<div class="row">
    <?php foreach ($branch as $rs): ?>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">

                <div class="caption">
                    <h3>
                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/clinic-icon.png" />
                        สาขา : <?php echo $rs['branchname'] ?>
                    </h3>
                    <p><?php echo $rs['address'] ?></p>
                    <p><?php echo $rs['contact'] ?></p>
                    <hr/>
                    <p><a href="<?php echo Yii::app()->createUrl('branch/update', array("id" => $rs['id'])) ?>" class="btn btn-primary" role="button">แก้ไข</a> 
                        <a href="#" class="btn btn-default" role="button">ลบ</a></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>