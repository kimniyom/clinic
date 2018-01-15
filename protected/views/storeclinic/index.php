<title>คลังสินค้า</title>
<?php
/* @var $this ProductTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'คลังสินค้า',
);

$product_model = new Product();
$branch = Yii::app()->session['branch'];
if($branch == '99'){
    $WHERE = " ";
} else {
    $WHERE = " AND id = '$branch'";
}
$branchs = Branch::model()->findAll("active = '1' $WHERE");

?>


<?php foreach($branchs as $rs): ?>

<h3>สาขา <?php echo $rs['branchname']?></h3>
<div class="row">
    <div class="col-lg-2 col-md-2 col-xs-6" style=" margin-bottom: 10px;">
        <a href="<?php echo Yii::app()->createUrl('clinicstoreproduct/index',array("branch" => $rs['id'])) ?>">
            <button type="button" class="btn btn-success btn-block">
                <img src="<?= Yii::app()->baseUrl; ?>/images/box-icon.png"/><br/>
                สต๊อกสินค้า
            </button></a>
    </div>
    <div class="col-lg-2 col-md-2 col-xs-6" style=" margin-bottom: 10px;">
        <a href="<?php echo Yii::app()->createUrl('clinicstockproduct/index',array("branch" => $rs['id'])) ?>">
            <button type="button" class="btn btn-warning btn-block">
                <img src="<?= Yii::app()->baseUrl; ?>/images/Product-sale-report-icon.png"/><br/>
                รายการสินค้า
            </button></a>
    </div>
    
    <div class="col-lg-2 col-md-2 col-xs-6" style=" margin-bottom: 10px;">
        <a href="<?php echo Yii::app()->createUrl('orders/index',array("branch" => $rs['id'])) ?>">
            <button type="button" class="btn btn-default btn-block">
                <img src="<?= Yii::app()->baseUrl; ?>/images/text-richtext-icon.png"><br/>
                ใบสั่งซื้อสินค้า
            </button></a>
    </div>
   
</div>
<hr/>
<?php endforeach;?>



