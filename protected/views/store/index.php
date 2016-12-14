<?php
/* @var $this ProductTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'คลังสินค้ากลาง',
);

$product_model = new Product();
?>

<h1>
    <img src="<?= Yii::app()->baseUrl; ?>/images/shipping-box-icon.png" 
         style="border-radius:20px; padding:2px; border:#FFF solid 2px;">
    คลังสินค้า      
</h1>
<hr/>
<div class="row">
    <div class="col-lg-4 col-md-4">
        <a href="<?php echo Yii::app()->createUrl('store/producttype')?>">
        <button type="button" class="btn btn-success btn-block">
            <img src="<?= Yii::app()->baseUrl; ?>/images/shipping-box-icon.png" 
                         style="border-radius:20px; padding:2px; border:#FFF solid 2px;"><br/>
            สินค้า
        </button></a>
    </div>
    <div class="col-lg-4 col-md-4">
        <a href="<?php echo Yii::app()->createUrl('centerstockitem/index')?>">
        <button type="button" class="btn btn-success btn-block">
            <img src="<?= Yii::app()->baseUrl; ?>/images/shipping-box-icon.png" 
                         style="border-radius:20px; padding:2px; border:#FFF solid 2px;"><br/>
            วัตถุดิบ
        </button></a>
    </div>
</div>
<hr/>

