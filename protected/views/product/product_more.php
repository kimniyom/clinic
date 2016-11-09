<ol class="dribbbles group" style="padding-left: 0px;">
    <?php
    $config = new Configweb_model();
    $product_model = new Product();
    $i = 0;
    foreach ($product as $last):
        $i++;
        $img_title = $product_model->firstpictures($last['product_id']);
        if(!empty($img_title)){
            $img = "uploads/product/".$img_title;
        } else {
            $img = "images/No_image_available.jpg";
        }
        $link = Yii::app()->createUrl('frontend/product/detail/id/' . $config->url_encode($last['product_id']));
        ?>
        <li id="screenshot-<?php echo $i; ?>" class="col-xs-6 col-sm-4  col-md-4 col-lg-4" style="text-align:center; margin-bottom:15px;">
            <div class="dribbble" id="box_list_product">
                <div class="dribbble-shot">
                    <div class="dribbble-img">
                        <a class="dribbble-link" href="<?php echo $link; ?>">
                            <div data-picture data-alt="Retinabbble - Chrome extension for dribbble">
                                <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img; ?>" class="img-responsive"/>
                            </div>
                        </a>
                        <a class="dribbble-over hvr-pop" href="<?php echo $link ?>" id="hover-box-product">    
                            <?php echo $last['product_name']; ?><br/>
                            <span id="font-18">ราคา <?php echo $last['product_price']; ?> บาท</span>
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
