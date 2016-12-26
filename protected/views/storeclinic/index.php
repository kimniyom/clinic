<?php
/* @var $this ProductTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'คลังสิน',
);

$product_model = new Product();
?>

<h1>
    <img src="<?= Yii::app()->baseUrl; ?>/images/shipping-box-icon.png" 
         style="border-radius:20px; padding:2px; border:#FFF solid 2px;">
    คลังสินค้า      
</h1>
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
            <button type="button" class="btn btn-warning btn-block">
                <img src="<?= Yii::app()->baseUrl; ?>/images/Product-sale-report-icon.png"/><br/>
                รายการสินค้า
            </button></a>
    </div>
    
    <div class="col-lg-2 col-md-2">
        <a href="<?php echo Yii::app()->createUrl('unit/index') ?>">
            <button type="button" class="btn btn-default btn-block">
                <img src="<?= Yii::app()->baseUrl; ?>/images/text-richtext-icon.png"><br/>
                ใบสั่งซื้อสินค้า
            </button></a>
    </div>
   
</div>
<hr/>



