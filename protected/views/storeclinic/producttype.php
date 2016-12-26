<?php
/* @var $this ProductTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'คลังสินค้ากลาง'=>array('index'),
    'ประเภทสินค้า',
);

$product_model = new Product();
?>

<h1>
    <img src="<?= Yii::app()->baseUrl; ?>/images/shipping-box-icon.png" 
         style="border-radius:20px; padding:2px; border:#FFF solid 2px;">
    คลังสินค้า      
</h1>
<hr/>

<h4>ประเภทสินค้า</h4>
<div class="row">
    <?php
    foreach ($type as $rs):
        ?>
        <div class="col-md-4 col-lg-4">
            <a href="<?php echo Yii::app()->createUrl('backend/product/Getproduct/type_id/' . $rs['type_id']) ?>">
                <button type="button" class="btn btn-default btn-block">
                    <img src="<?= Yii::app()->baseUrl; ?>/images/shipping-box-icon.png" 
                         style="border-radius:20px; padding:2px; border:#FFF solid 2px;"><br/>
                         <?php echo $rs['type_name'] ?>
                    <span class="label" style=" background: #24282d;">
                        <?php echo $product_model->get_count_product_type($rs['type_id']); ?>
                    </span>
                </button>
            </a>
        </div>
    <?php endforeach; ?>
</div>
