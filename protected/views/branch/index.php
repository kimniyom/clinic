<?php
/* @var $this BranchController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Branches',
);

$LogoModel = new Backend_logo();
?>

<h1>Branches</h1>
<a href="<?php echo Yii::app()->createUrl('branch/create') ?>">
    <button type="button" class="btn btn-default"><i class="fa fa-plus"></i> เพิ่มสาขา</button></a><br/><br/>
<div class="row">
    <?php
    foreach ($branch as $rs):
        $logo = $LogoModel->get_logo_by_id($rs['id'])['logo'];
        ?>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">

                <div class="caption">
                    <h3>
                        <center>
                            <?php if (!empty($logo)) { ?>
                                <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $logo ?>" width="48"/>
                            <?php } else { ?>
                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/clinic-icon.png" />
                            <?php } ?>
                                <br/> สาขา : <?php echo $rs['branchname'] ?>
                        </center>
                    
                    </h3>
                    <p><?php echo $rs['address'] ?></p>
                    <p><?php echo $rs['contact'] ?></p>
                    <hr/>
                    <p>
                        <a href="<?php echo Yii::app()->createUrl('branch/update', array("id" => $rs['id'])) ?>" class="btn btn-primary" role="button"><i class="fa fa-pencil"></i> แก้ไข</a> 
                        <a href="<?php echo Yii::app()->createUrl('backend/logo', array("branch" => $rs['id'])) ?>"><button type="button" class="btn btn-success"><i class="fa fa-photo"></i> โลโก้</button></a>
                        <a href="#" class="btn btn-default" role="button"><i class="fa fa-trash"></i> ลบ</a>              
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>