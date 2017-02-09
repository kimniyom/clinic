<?php
/* @var $this ProductTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'คลังสินค้ากลาง',
);

$product_model = new Product();
?>

<h2>
    <img src="<?= Yii::app()->baseUrl; ?>/images/shipping-box-icon.png" 
         style="border-radius:20px; padding:2px; border:#FFF solid 2px;">
    คลังสินค้ากลาง     
</h2>
<hr/>
<h4>ที่อยู่ / ข้อมูลติดต่อ</h4>
<div class="row">
    <div class="col-lg-10 col-md-10">
        บริษัท : <?php echo $company['companyname'] ?><br/>
        ที่อยู่ : <?php echo $company['address'] ?><br/>
        ผู้จัดการ : <?php echo $company['memager'] ?><br/>
        เบอร์โทร : <?php echo $company['tel'] ?> 
        <a href="<?php echo Yii::app()->createUrl('companycenter/update', array('id' => 1)) ?>">
            <i class="fa fa-pencil"></i> แก้ไข</a>
    </div>
</div>
<hr/>
<h4>สินค้า</h4>
<div class="row">
    <div class="col-lg-2 col-md-2">
        <a href="<?php echo Yii::app()->createUrl('centerstoreproduct/index') ?>">
            <button type="button" class="btn btn-success btn-block">
                <img src="<?= Yii::app()->baseUrl; ?>/images/box-icon.png"/><br/>
                คลังสินค้า
            </button></a>
    </div>
    <div class="col-lg-2 col-md-2">
        <a href="<?php echo Yii::app()->createUrl('centerstockproduct/index') ?>">
            <button type="button" class="btn btn-success btn-block">
                <img src="<?= Yii::app()->baseUrl; ?>/images/Product-sale-report-icon.png"/><br/>
                รายการสินค้า
            </button></a>
    </div>

    <div class="col-lg-2 col-md-2">
        <a href="<?php echo Yii::app()->createUrl('unit/index') ?>">
            <button type="button" class="btn btn-default btn-block">
                <img src="<?= Yii::app()->baseUrl; ?>/images/unit-icon.png"><br/>
                หน่วยนับ สินค้า
            </button></a>
    </div>

    <div class="col-lg-2 col-md-2">
        <a href="<?php echo Yii::app()->createUrl('centerstockcompany/index') ?>">
            <button type="button" class="btn btn-default btn-block">
                <img src="<?= Yii::app()->baseUrl; ?>/images/company-building-icon.png"><br/>
                บริษัท
            </button></a>
    </div>

</div>
<hr/>
<h4>วัตถุดิบ</h4>
<div class="row">
    <div class="col-lg-2 col-md-2">
        <a href="<?php echo Yii::app()->createUrl('centerstockitem/index') ?>">
            <button type="button" class="btn btn-primary btn-block">
                <img src="<?= Yii::app()->baseUrl; ?>/images/store-icon.png"/><br/>
                คลังวัตถุดิบ
            </button></a>
    </div>
    <div class="col-lg-2 col-md-2">
        <a href="<?php echo Yii::app()->createUrl('centerstockitemname/index') ?>">
            <button type="button" class="btn btn-primary btn-block">
                <img src="<?= Yii::app()->baseUrl; ?>/images/product-icon.png"/><br/>
                รายการวัตถุดิบ
            </button></a>
    </div>

    <div class="col-lg-2 col-md-2">
        <a href="<?php echo Yii::app()->createUrl('centerstockunit/index') ?>">
            <button type="button" class="btn btn-default btn-block">
                <img src="<?= Yii::app()->baseUrl; ?>/images/unit-icon.png"><br/>
                หน่วยนับ วัตถุดิบ
            </button></a>
    </div>

</div>


