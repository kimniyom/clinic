<style type="text/css">
    table tr td{ height:30px;}
    #im-resize{height: 75px; padding: 5px; margin-bottom: 5px;}
    #cart_box{
        float: right; margin-top: 0px; padding-top: 15px;
        position:fixed; top:10px; right:20px;z-index:3;
    }
</style>

<script type="text/javascript">
    function set_group_img(img) {
        $("#img_group").html("<img src='<?php echo Yii::app()->baseUrl ?>/uploads" + "/" + img + " ' width='80%' style='margin-right:20px;' />");
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover();

        $('.img_zoom').magnificPopup({
            delegate: 'a', // child items selector, by clicking on it popup will open
            type: 'image',
            gallery: {
                enabled: true
            }
            // other options
        });

    });
</script>


<?php
$this->breadcrumbs = array(
    "คลังสินค้า" => Yii::app()->createUrl('store/index'),
    "รายการสินค้า" => array('index'),
    $product['product_name']
);

//$ItemModel = new Items();
$Web = new Configweb_model();
$product_id = $product['product_id'];
?>

<?php $config = new Configweb_model(); ?>

<div class="wells" style=" width:100%; margin-top:20px;text-align: left;">
    <div class="row">

        <div class="col-lg-6 col-md-12 col-xs-12">

            <font style=" color: #F00; font-size: 24px; font-weight: normal;">
            <img src="<?php echo Yii::app()->baseUrl; ?>/images/yellow-tag-icon.png"/>
            <?= $product['product_name'] ?>
            </font><br/>
            <b>รหัสสินค้า</b> <?= $product['product_id'] ?><br/>
            <b>ประเภทสินค้า</b> <?= $product['type_name'] ?><br/>
            <b>อัพเดทล่าสุด</b> <?= $config->thaidate($product['d_update']); ?>
            <font style=" font-size: 24px;">
            ราคา <?= number_format($product['product_price']) ?>.-  บาท
            </font>
        </div>

        <div class="col-lg-6 col-md-12 col-xs-12" style=" padding-top: 20px;">
            <?php
            $product_model = new Product();
            $img_title = $product_model->firstpictures($product['product_id']);
            if (!empty($img_title)) {
                $img = "uploads/product/" . $img_title;
            } else {
                $img = "images/No_image_available.jpg";
            }
            if ($img != "") {
                ?>
                <center>
                    <img src="<?= Yii::app()->baseUrl ?>/<?= $img; ?>" class="img-responsive thumbnail" alt="Responsive image" id="img-cart"/>
                </center>     
            <?php } else { ?>
                <div id="img" style="width:400px; height:350px; background:#CCC; font-size:36px; text-align:center; padding-top:30px; margin-right:20px;">
                    NO<br />Images 
                </div>
            <?php } ?>
            <br/>
            <?php if ($img != "No-Camera-icon.png") { ?>
                <div class=" row">
                    <div class=" col-lg-12">
                        <!-- Img -->
                        <?php if ($img != "") { ?>
                            <div class="img_zoom">
                                <center>
                                    <?php foreach ($images as $rs): ?>
                                        <!--
                                            <a href="javascript:void(0);" onclick="set_group_img('<?//php echo $rs->images ?>');" style=" text-decoration: none;">
                                        -->
                                        <a class="image-link" href="<?php echo Yii::app()->baseUrl; ?>/uploads/product/<?= $rs['images'] ?>">
                                            <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/product/<?= $rs['images'] ?>" class="btn btn-default" id="im-resize" style=" background: #FFF;"/></a>
                                    <?php endforeach; ?>
                                </center>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <hr/>
    <h4 style="font-weight:bold; font-size: 24px; color: #F00;">
        <i class="fa fa-tag"></i> รายละเอียด
    </h4>
    <div class="well" style=" background: #cccccc;">
        <div class="row" id="etc_product">
            <div class="col-lg-12 col-md-12">
                <?= $product['product_detail'] ?>
            </div>
        </div>
    </div>
</div>

