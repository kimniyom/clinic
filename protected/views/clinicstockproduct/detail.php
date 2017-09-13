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
$branchModel = new Branch();
$branchname = $branchModel->Getbranch($branch);

$this->breadcrumbs = array(
    "คลังสินค้า" => Yii::app()->createUrl('storeclinic/index'),
    "รายการสินค้า (สาขา " . $branchname . ")" => array('index', 'branch' => $branch),
    $product['product_name']
);

//$ItemModel = new Items();
$Web = new Configweb_model();
$product_id = $product['product_id'];
?>

<?php $config = new Configweb_model(); ?>

<div class="well" id="font-th" style=" width:100%; margin-top:0px;text-align: left; background: #FFF; margin-bottom: 0px;">
    <div class="row">

        <div class="col-lg-8 col-md-6 col-xs-12" id="p-left">
            <?php if (Yii::app()->session['status'] == '1' || Yii::app()->session['status'] == '5' || Yii::app()->session['status'] == '6') { ?>
                <?php if (Yii::app()->session['branch'] == $branch) { ?>
                    <a href="<?php echo Yii::app()->createUrl('clinicstockproduct/update', array('id' => $product['id'])) ?>">
                        <button type="button" class="btn btn-primary">แก้ไข</button></a>
                    <button type="button" class="btn btn-danger" onclick="deleteproduct('<?php echo $product['id'] ?>')">ลบ</button>
                <?php } ?>
            <?php } ?>
            <br/>
            <font style=" color: #F00; font-size: 24px; font-weight: normal;">
            ชื่อสินค้า : <?= $product['product_nameclinic'] ?>
            </font><br/>
            <b>รหัสสินค้า</b> <?= $product['product_id'] ?><br/>
            <b>หมวดสินค้า</b> <?= $product['type_name'] ?><br/>
            <b>ประเภทสินค้า</b> <?= $product['subtypename'] ?><br/>

            <br/><font style=" font-size: 24px; color: #666666;">
            ต้นทุน <?= number_format($product['costs']) ?>.-  บาท
            </font> , <font style=" font-size: 24px; color: #F00;">
            ราคาขาย <?= number_format($product['product_price']) ?>.-  บาท
            </font>
            <br/>
            <b>รายละเอียดสินค้า</b>
            <?= $product['product_detail'] ?>
            <hr/>
            <b>อัพเดทล่าสุด</b> <?= $config->thaidate($product['d_update']); ?>
        </div>

        <div class="col-lg-4 col-md-6 col-xs-12" style=" padding-top: 20px;" id="p-right">
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
                <div id="img" style="width:200px; height:350px; background:#CCC; font-size:36px; text-align:center; padding-top:30px; margin-right:20px;">
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
</div>

<script type="text/javascript">
    checkheight();
    function deleteproduct(id) {
        var r = confirm("Are you sure ...");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('clinicstockproduct/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location = "<?php echo Yii::app()->createUrl('clinicstockproduct/index') ?>";
            });
        }
    }

    function checkheight() {
        var p_left = $("#p-left").height();
        var p_right = $("#p-right").height();
        //alert(p_left + " - " + p_right);
        if (p_left > p_right) {
            $("#p-right").removeClass("p-right");
            $("#p-left").addClass("p-left");
        } else {
            $("#p-left").removeClass("p-left");
            $("#p-right").addClass("p-right");
        }
    }


</script>

<script type="text/javascript">
    Setscreen();
    function Setscreen() {
        var screen = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = (screen - 138);
        $("#p-left").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
        $("#p-right").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
        //$("#patientbox").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF'});
        //$("#boxorders").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF', 'overflow': 'auto', 'padding-left': '10px'});
    }
</script>



