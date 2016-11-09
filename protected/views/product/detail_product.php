<style type="text/css">
    table tr td{ height:30px;}
    #im-resize{ width: auto; max-height: 75px; padding: 5px; margin-bottom: 5px;}
</style>

<script type="text/javascript">
    function add_cart(order_id, product_id, price) {
        var url = "<?= Yii::app()->createUrl('frontend/orders/add_cart') ?>";
        var num = $("#num").val();
        var price_total = (price * num);

        var data = {
            order_id: order_id,
            product_id: product_id,
            price: price,
            num: num,
            price_total: price_total
        };

        if (num == '' || num == '0') {
            alert("กรุณากรอกจำนวน");
            return false;
        }
        $.post(url, data,
                function (success) {
                    //alert('เพิ่มสินค้าในตะกร้าแล้ว');
                    $("#num").val(1);
                    Add_cart_success();
                    //window.location.reload();
                }
        ); // End post
    }

    function Add_cart_success() {
        //$('.add-to-cart').on('click', function () {
        var cart = $('.shopping-cart');
        //var imgtodrag = $(this).parent('.item').find("img").eq(0);
        var imgtodrag = $("#img-cart").eq(0);
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                    .offset({
                        top: imgtodrag.offset().top,
                        left: imgtodrag.offset().left
                    })
                    .css({
                        'opacity': '0.5',
                        'position': 'absolute',
                        'height': '150px',
                        'width': '150px',
                        'z-index': '100'
                    })
                    .appendTo($('body'))
                    .animate({
                        'top': cart.offset().top + 10,
                        'left': cart.offset().left + 10,
                        'width': 75,
                        'height': 75
                    }, 1000, 'easeInOutExpo');

            setTimeout(function () {
                cart.effect("shake", {
                    times: 2
                }, 200);
            }, 1500);

            imgclone.animate({
                'width': 0,
                'height': 0
            }, function () {
                $(this).detach();
            });
            load_inbox_cart();
            load_box_cart();
        }
        //});
    }

</script>

<script type="text/javascript">
    function set_group_img(img) {
        $("#img_group").html("<img src='<?php echo Yii::app()->baseUrl ?>/uploads" + "/" + img + " ' width='80%' style='margin-right:20px;' />");
    }
</script>

<?php
$config = new Configweb_model();
$this->breadcrumbs = array(
    $product['type_name'] => array('frontend/product/view/type/' . $config->url_encode($product['type_id'])),
    $product['product_name'],
);
?>
<br/>
<div class="well" style=" width:100%; margin-top:0px; background:#FFF; text-align: left; border:none; box-shadow: none;">
    <div class="row">
        <div class="col-lg-12">
            <font style=" color: #F00; font-size: 24px; font-weight: normal;" id="font-rsu-18">
            <img src="<?php echo Yii::app()->baseUrl; ?>/images/yellow-tag-icon.png"/>
            <?= $product['product_name'] ?>
            </font>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-4 col-md-12 col-xs-12" id="font-20">
            <b>รหัสสินค้า</b> <?= $product['product_id'] ?><br/>
            <b>ประเภทสินค้า</b> <?= $product['type_name'] ?><br/>
            <b>อัพเดทล่าสุด</b> <?= $config->thaidate($product['d_update']); ?><br/><br/>
            <div class="row">
                <div class="well" style=" background: none;">
                    <?php if (Yii::app()->session['status'] != '') { ?>
                        <table style="width: 100%;">
                            <tr>
                                <td><b style=" font-size: 16px;">จำนวน</b></td>
                                <td>
                                    <select id="num" name="num" class="form-control">
                                        <?php for ($i = 1; $i <= 100; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td style=" text-align: center;">
                                    <button class="btn btn-danger add-to-cart" type="button"
                                            onclick="add_cart('<?= Yii::app()->session['order_id'] ?>', '<?php echo $product['product_id'] ?>', '<?php echo $product['product_price'] ?>');">
                                        <span class="glyphicon glyphicon-shopping-cart"></span> 
                                        <b style=" font-size: 16px;">หยิบใส่ตะกร้า</b>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    <?php } else { ?>
                        <center>
                            <b>เข้าสู่ระบบก่อนสั่งสินค้า</b>
                        </center>
                    <?php } ?>
                    <?php $price = $product['product_price']; ?>
                </div>
            </div>

            <center>
                <font style="color:#000; font-size: 24px;">
                ราคา
                <span class="badge btn-danger" style="font-size: 24px;"><?= number_format($product['product_price']) ?>.-</span>  บาท
                </font>
            </center>
        </div>

        <div class="col-lg-8 col-md-12 col-xs-12" style=" padding-top: 10px;">
            <?php
            $product_model = new Product();
            $img_title = $product_model->get_images_product_title($product['product_id']);
            if (!empty($img_title)) {
                $img = "uploads/product_thumb/" . $img_title['images'];
            } else {
                $img = "images/No_image_available.jpg";
            }
            ?>
            <center>
                <img src="<?= Yii::app()->baseUrl ?>/<?= $img; ?>" class="img-responsive" alt="Responsive image" id="img-cart"/>
            </center>     
        </div>
    </div>
    <br/>

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
                            <a class="image-link" href="<?php echo Yii::app()->baseUrl; ?>/uploads/<?= $rs['images'] ?>">
                                <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/<?= $rs['images'] ?>" class="btn btn-default" id="im-resize"/></a>
                        <?php endforeach; ?>
                    </center>
                </div>
            <?php } ?>
        </div>
    </div>

    <hr/>

    <div class="row">

        <ul class="nav nav-tabs" role="tablist" id="font-rsu-18">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">รายละเอียด</a></li>
            <li role="presentation"><a href="#comment" aria-controls="comment" role="tab" data-toggle="tab" onclick="load_comment()">ความคิดเห็น</a></li>
            <li role="presentation"><a href="#payment" aria-controls="payment" role="tab" data-toggle="tab" onclick="loadpayment()">วิธีการสั่งซื้อ</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" style=" border:solid 1px #dddddd; border-top:none; padding: 10px;">
            <div role="tabpanel" class="tab-pane active" id="home"> 
                <p id="font-rsu-20">รายละเอียด</p>
                <div id="box-article">
                    <?= $product['product_detail'] ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="comment"></div>
            <div role="tabpanel" class="tab-pane" id="payment">
                
            </div>
        </div>
    </div>
</div>

<!-- สินค้าที่เกียวข้อง -->
<div class="panel panel-default" style="margin:0px;">
    <div class="panel-heading">
        <img src="<?php echo Yii::app()->baseUrl; ?>/images/full-shopping-cart-icon.png" width="28"/> สินค้าอื่น ๆ
    </div>
    <div class="panel-body">
        <ol class="dribbbles group" style="padding-left: 0px;">
            <?php
            $i = 0;
            foreach ($near as $ne):
                $i++;
                $link = Yii::app()->createUrl('frontend/product/detail/id/' . $config->url_encode($ne['product_id']));
                $img_n = $product_model->get_images_product_title($ne['product_id']);
                if (!empty($img_n)) {
                    $img_product_n = "uploads/product_thumb/" . $img_n['images'];
                } else {
                    $img_product_n = "images/No_image_available.jpg";
                }
                ?>
                <li id="screenshot-<?php echo $i; ?>" class="col-lg-3 col-md-3 col-sm-6 col-xs-6" style="text-align:center; margin-bottom:15px;">
                    <div class="dribbble" id="box_list_product">
                        <div class="dribbble-shot">
                            <div class="dribbble-img">
                                <a class="dribbble-link" href="<?php echo $link; ?>">
                                    <div data-picture data-alt="kimniyom">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_product_n; ?>"/>
                                    </div>
                                </a>
                                <a class="dribbble-over" href="<?php echo $link ?>" id="hover-box-product">    
                                    <?php echo $ne['product_name']; ?><br/>
                                    <font style="color:#ffff00;">ราคา <?php echo $ne['product_price']; ?> บาท</font>
                                </a>
                            </div>

                            <ul class="tools group">
                                <li style="color:red;">
                                    <span id="font-22">ราคา <?php echo $ne['product_price']; ?> บาท</span>
                                </li>
                            </ul>

                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</div>


<script type="text/javascript">
    //load_comment();
    function load_comment() {
        $("#comment").html("<center><i class='fa fa-spinner fa-spin fa-2x'></i></center>");
        var product_id = "<?php echo $product['product_id'] ?>";
        var url = "<?php echo Yii::app()->createUrl('frontend/comment') ?>";
        var data = {product_id: product_id};

        $.post(url, data, function (result) {
            $("#comment").html(result);
        });
    }

    function send_comment() {
        var product_id = "<?php echo $product['product_id'] ?>";
        var pid = "<?php echo Yii::app()->session['pid'] ?>";
        var box_comment = $("#box_comment").val();
        var url = "<?php echo Yii::app()->createUrl('frontend/comment/send_comment') ?>";
        var data = {product_id: product_id, pid: pid, box_comment: box_comment};
        if (box_comment == '') {
            $("#box_comment").focus();
            return false;
        }
        $.post(url, data, function (result) {
            load_comment();
        });
    }
    
    function loadpayment(){
        $("#payment").html("<center><i class='fa fa-spinner fa-spin fa-2x'></i></center>");
        var url = "<?php echo Yii::app()->createUrl('frontend/payment/loadpayment') ?>";
        var data = {a: 1};

        $.post(url, data, function (result) {
            $("#payment").html(result);
        });
    }
</script>

