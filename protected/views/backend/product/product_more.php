<?php
$product_model = new Product();
foreach ($product as $last):
    $img = $product_model->get_last_img($last['product_id']);
    $link = Yii::app()->createUrl('backend/product/detail_product&product_id=' . $last['product_id']);
    ?>

        <div class="col-xs-12 col-md-6 col-lg-4 col-sm-6">

            <div class="thumbnail btn" style=" text-align: center;" id="box_product">
                <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/<?php echo $img; ?>" id="img"/>
                <div class="caption">
                    <p style="color: #ff0000; font-size: 16px;">
                        <?php echo $last['product_name']; ?><br/>
                        ราคา <b><?php echo $last['product_price']; ?></b> บาท
                    </p>
                    <a href="<?php echo $link; ?>">
                        <div class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</div>
                    </a>
                </div>
            </div>
        </div>
<?php endforeach; ?>
