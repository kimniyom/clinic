<style tyle="text/css">
    .croppic{
        max-width:400px;
        min-height:300px;
        background: #FFF;
    }
</style>

<!-- Crop Img -->
<link href="<?= Yii::app()->baseUrl ?>/assets/croppic-master/assets/css/main.css" rel="stylesheet">
<link href="<?= Yii::app()->baseUrl ?>/assets/croppic-master/assets/css/croppic.css" rel="stylesheet">
<script src="<?= Yii::app()->baseUrl ?>/assets/croppic-master/assets/js/jquery.mousewheel.min.js"></script>
<script src="<?= Yii::app()->baseUrl ?>/assets/croppic-master/croppic.min.js"></script>

<?php
$this->breadcrumbs = array(
    $product['type_name'] => array('backend/product/getproduct&type_id=' . $product['type_id']),
    $product['product_name'] => array('backend/product/detail_product&product_id=' . $product['product_id']),
    "จัดการรูปภาพ",
);
$product_id = $product['product_id'];
?>

<h4 style=" font-size: 20px; color: #ff0000;">
    <i class="fa fa-image"></i> รูปภาพหน้าปก
</h4>

<center>
    <div id="cropContaineroutput" class="croppic"></div>
    <br/><br/>
    <!--
    <input type="text" id="cropOutput" style="width:100%; padding:5px 4%; margin:20px auto; display:block; border: 1px solid #CCC;" />
    -->
</center>
<script>
    var croppicContaineroutputOptions = {
        uploadUrl: '<?php echo Yii::app()->createUrl('backend/product/Img_save_to_file') ?>',
        cropUrl: '<?php echo Yii::app()->createUrl('backend/product/img_crop_to_file/product_id/' . $product['product_id']) ?>',
        outputUrlId: 'cropOutput',
        modal: false,
        loaderHtml: '<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onBeforeImgUpload: function () {
            console.log('onBeforeImgUpload')
        },
        onAfterImgUpload: function () {
            console.log('onAfterImgUpload')
        },
        onImgDrag: function () {
            console.log('onImgDrag')
        },
        onImgZoom: function () {
            console.log('onImgZoom')
        },
        onBeforeImgCrop: function () {
            console.log('onBeforeImgCrop')
        },
        onAfterImgCrop: function () {
            var product = "<?php echo $product_id; ?>";
            window.location = "<?php echo Yii::app()->createUrl('backend/product/images/product_id/') ?>" + "/" + product;
            console.log('onAfterImgCrop')
        },
        onReset: function () {
            console.log('onReset')
        },
        onError: function (errormessage) {
            console.log('onError:' + errormessage)
        }
    }

    var cropContaineroutput = new Croppic('cropContaineroutput', croppicContaineroutputOptions);

</script>
