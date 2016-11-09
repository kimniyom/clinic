<style type="text/css">
    #title-bar-tab{
        position: absolute;
        top: 0px;
        right: 0px;
    }
    #article-box{
        height: 50px;
        overflow: hidden;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $(".breadcrumb").hide();

        var width = $(window).width();
        if (width > 768) {
            $("#banner_home").show();
            var style = {
                "height": "120px"
            };
            $(".article-img").css(style);
        } else {
            $("#banner_home").hide();
            var style = {
                "height": "auto"
            };
            $(".article-img").css(style);
        }
    });

    $(window).resize(function () {
        var widths = $(window).width();
        if (widths > 768) {
            $("#banner_home").show();
            var style = {
                "height": "120px"
            };
            $(".article-img").css(style);
        } else {
            $("#banner_home").hide();
            var style = {
                "height": "auto"
            };
            $(".article-img").css(style);
        }
    });
</script>

<!-- Banner -->
<?php
$config = new Configweb_model();
if (isset($banner)) {
    ?>
    <div style="margin-left:10px; margin-top: 5px; padding-bottom: 0px; margin-bottom: 0px; box-shadow: none;" id="banner_home">
        <ul class="bxslider" style="z-index: 0; text-align: center; max-height: 200px; overflow: hidden;">
            <?php
            $images = $config->_get_banner_show();
            foreach ($images as $img_ban):
                ?>
                <li style="text-align: center; max-height: 200px;"><img src="<?php echo Yii::app()->baseUrl; ?>/uploads/banner/<?= $img_ban['banner_images'] ?>"/></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php } ?>
<!-- End Banner -->

<!-- Alam -->
<?php 
$order_model = new Orders();
if (!empty(Yii::app()->session['status'])): 
    ?>
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <a href="<?= Yii::app()->createUrl('frontend/orders/informpayment') ?>">
                <button type="button" class="btn btn-default" style="width:100%;">
                    รอชำระเงิน
                    <label class="label label-danger"><?php echo $order_model->count_informpayment(Yii::app()->session['pid']) ?></label>
                </button></a>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <a href="<?= Yii::app()->createUrl('frontend/orders/verify') ?>">
                <button type="button" class="btn btn-default " style="width:100%;">
                    รอตรวจสอบยอดเงิน
                    <label class="label label-danger"><?php echo $order_model->count_verify(Yii::app()->session['pid']) ?></label>
                </button></a>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <a href="<?= Yii::app()->createUrl('frontend/orders/waitsend') ?>">
                <button type="button" class="btn btn-default" style="width:100%;">รอการจัดส่ง
                    <label class="label label-danger"><?php echo $order_model->count_wait_send(Yii::app()->session['pid']) ?></label>
                </button></a>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <a href="<?= Yii::app()->createUrl('frontend/orders/send') ?>">
                <button type="button" class="btn btn-default" style="width:100%;">
                    ส่งสินค้าเรียบร้อย
                    <label class="label label-success"><?php echo $order_model->count_send(Yii::app()->session['pid']) ?></label>
                </button></a>
        </div>
    </div><br/>
<?php endif; ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <font id="font-22">สินค้ามาใหม่</font>
    </div>
    <ol class="dribbbles group" style="padding-left: 0px; margin-top:10px;">
        <?php
        $product_model = new Product();
        $i = 0;
        foreach ($last_product as $last):
            $i++;
            $img_title = $product_model->firstpictures($last['product_id']);
            if (!empty($img_title)) {
                $img = "uploads/product/" . $img_title;
            } else {
                $img = "images/No_image_available.jpg";
            }

            $link = Yii::app()->createUrl('frontend/product/detail/id/' . $config->url_encode($last['product_id']));
            ?>
            <?php if ($i == "1") { ?>
                <li id="screenshot-<?php echo $i; ?>" class="col-lg-6 col-md-6 col-sm-12" style="text-align:center; margin-bottom:15px;">
                    <div class="dribbble" id="box_list_product">
                        <div class="dribbble-shot">
                            <div class="dribbble-img">
                                <a class="dribbble-link" href="#">
                                    <div data-picture data-alt="Retinabbble - Chrome extension for dribbble">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/new-full.png" id="title-bar-tab">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img; ?>" style="max-width:80%;"/>
                                    </div>
                                </a>
                                <a class="dribbble-over hvr-pop" href="<?php echo $link ?>" id="hover-box-product">
                                    <?php echo $last['product_name']; ?><br/>
                                    <span id="font-22">ราคา <?php echo $last['product_price']; ?> บาท</span>
                                </a>
                            </div>
                            <ul class="tools group">
                                <li style="color:red;text-align:center; margin-bottom:6px;">
                                    <span id="font-22">ราคา <?php echo $last['product_price']; ?> บาท</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php } else { ?>
                <li id="screenshot-<?php echo $i; ?>" class="col-lg-3 col-md-3 col-sm-4 col-xs-6" style="text-align:center; margin-bottom:15px;">
                    <div class="dribbble" id="box_list_product">
                        <div class="dribbble-shot">
                            <div class="dribbble-img">
                                <a class="dribbble-link" href="#">
                                    <div data-picture data-alt="Retinabbble - Chrome extension for dribbble">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/new-full.png" id="title-bar-tab">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img; ?>"/>
                                    </div>
                                </a>
                                <a class="dribbble-over hvr-pop" href="<?php echo $link ?>" id="hover-box-product">
                                    <?php echo $last['product_name']; ?><br/>
                                    <font style="color:yellow;">ราคา <?php echo $last['product_price']; ?> บาท</font>
                                </a>
                            </div>
                            <ul class="tools group">
                                <li style="color:red;text-align:center;">
                                    <span>ราคา <?php echo $last['product_price']; ?> บาท</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php } ?>
        <?php endforeach; ?>
    </ol>
</div>
<br />

<div class="panel panel-default">
    <div class="panel-heading">
        <font id="font-22">สินค้าแนะนำ</font>
    </div>
    <ol class="dribbbles group" style="padding-left: 0px; margin-top:10px;">
        <?php
        $b = 0;
        foreach ($sale_product as $sale):
            $b++;
            $img_title = $product_model->firstpictures($sale['product_id']);
            if (!empty($img_title)) {
                $img = "uploads/product/" . $img_title;
            } else {
                $img = "images/No_image_available.jpg";
            }
            $link = Yii::app()->createUrl('frontend/product/detail/id/' . $config->url_encode($sale['product_id']));
            ?>
            <?php if ($b == "1") { ?>
                <li id="screenshot-<?php echo $b; ?>" class="col-lg-6 col-md-6 col-sm-12" style="text-align:center; margin-bottom:15px;">
                    <div class="dribbble" id="box_list_product">
                        <div class="dribbble-shot">
                            <div class="dribbble-img">
                                <a class="dribbble-link" href="#">
                                    <div data-picture data-alt="Retinabbble - Chrome extension for dribbble">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/hot-full.png" id="title-bar-tab">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img; ?>" style="max-width:90%;"/>
                                    </div>
                                </a>
                                <a class="dribbble-over hvr-pop" href="<?php echo $link ?>" id="hover-box-product">
                                    <?php echo $sale['product_name']; ?><br/>
                                    <span id="font-22">ราคา <?php echo $sale['product_price']; ?> บาท</span>
                                </a>
                            </div>
                            <ul class="tools group">
                                <li style="color:red;text-align:center; margin-bottom:6px;">
                                    <span id="font-22">ราคา <?php echo $sale['product_price']; ?> บาท</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php } else { ?>
                <li id="screenshot-<?php echo $i; ?>" class="col-lg-3 col-md-3 col-sm-4 col-xs-6" style="text-align:center; margin-bottom:15px;">
                    <div class="dribbble" id="box_list_product">
                        <div class="dribbble-shot">
                            <div class="dribbble-img">
                                <a class="dribbble-link" href="#">
                                    <div data-picture data-alt="Retinabbble - Chrome extension for dribbble">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/hot-full.png" id="title-bar-tab">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img; ?>"/>
                                    </div>
                                </a>
                                <a class="dribbble-over hvr-pop" href="<?php echo $link ?>" id="hover-box-product">
                                    <?php echo $last['product_name']; ?><br/>
                                    <font style="color:yellow;">ราคา <?php echo $sale['product_price']; ?> บาท</font>
                                </a>
                            </div>
                            <ul class="tools group">
                                <li style="color:red;text-align:center;">
                                    <span>ราคา <?php echo $sale['product_price']; ?> บาท</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php } ?>
        <?php endforeach; ?>
    </ol>
</div>


<!-- บทความ -->
<font id="font-22"><i class="fa fa-newspaper-o"></i> บทความใหม่</font>
<a href="<?php echo Yii::app()->createUrl('frontend/article') ?>">
    <div class="btn btn-default pull-right">ทั้งหมด</div></a>
<hr/>
<div class="row">
    <?php
    $article_model = new Backend_article();
    $article = $article_model->Get_article_limit("6");
    $a = 0;
    foreach ($article as $art):
        $a++;
        if (!empty($art['images'])) {
            $img_art = "uploads/article/" . $art['images'];
        } else {
            $img_art = "images/No_image_available.jpg";
        }
        $link = Yii::app()->createUrl('frontend/article/view/id/' . $config->url_encode($art['id']));
        ?>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_art; ?>" class="img-responsive article-img"/>
                <div class="caption"id="article-box">
                    <p><?php echo $art['title']; ?></p>
                </div>
                <p style=" text-align: right;">
                    <a href="<?php echo $link; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-angle-double-right"></i> รายละเอียด</a></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.bxslider').bxSlider({
            auto: true,
            speed: 500
        });
    });
</script>
