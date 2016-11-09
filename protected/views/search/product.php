<?php
$this->breadcrumbs = array(
    'ค้นหาสินค้า',
);
?>
<br/>
<ol class="dribbbles group" style="padding-left: 0px;">
    <?php
    $product_model = new Product();
    $web = new Configweb_model();
    $i = 0;
    foreach ($product as $last):
        $i++;
        $img_short = $product_model->get_images_product_title($last['product_id']);
        if (!empty($img_short['images'])) {
            $img = "uploads/product_thumb/" . $img_short['images'];
        } else {
            $img = "images/No_image_available.jpg";
        }
        $link = Yii::app()->createUrl('frontend/product/detail/id/' . $web->url_encode($last['product_id']));
        ?>
        <li id="screenshot-<?php echo $i; ?>" class="col-lg-4 col-md-4 col-sm-6 col-xs-6" style="text-align:center; margin-bottom:15px;">
            <div class="dribbble" id="box_list_product">
                <div class="dribbble-shot">
                    <div class="dribbble-img">
                        <a class="dribbble-link" href="/shots/2166663-Retinabbble-Chrome-extension-for-dribbble">
                            <div data-picture data-alt="Retinabbble - Chrome extension for dribbble">
                                <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img; ?>"/>
                            </div>
                        </a>
                        <a class="dribbble-over hvr-pop" href="<?php echo $link ?>" id="hover-box-product">    
                            <?php echo $last['product_name']; ?><br/>
                            <span id="font-22" style=" color: #ff9900;">ราคา <?php echo $last['product_price']; ?> บาท</span>
                        </a>
                    </div>

                    <ul class="tools group">
                        <li style="color:red;text-align:center;">
                            <span id="font-22">ราคา <?php echo $last['product_price']; ?> บาท</span>
                        </li>
                    </ul>

                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ol>
