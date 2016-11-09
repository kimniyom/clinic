
<script src="<?= Yii::app()->baseUrl ?>/assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl ?>/assets/uploadify/uploadify.css">



<script type="text/javascript">
    $(document).ready(function () {
        load_data();
        $('#Filedata').uploadify({
            /*'buttonText': 'กรุณาเลือกรูปภาพ ...',*/
            'auto': true, //เปิดใช้การอัพโหลดแบบอัติโนมัติ
            'buttonImage': '<?= Yii::app()->baseUrl ?>/images/image-up-icon.png',
            'swf': '<?= Yii::app()->baseUrl ?>/assets/uploadify/uploadify.swf', //โฟเดอร์ที่เก็บไฟล์ปุ่มอัพโหลด
            'uploader': "<?= Yii::app()->createUrl('backend/product/upload', array('product_id' => $product['product_id'])) ?>",
            'fileSizeLimit': '1MB', //อัพโหลดได้ครั้งละไม่เกิน 1024kb
            'width': '128',
            'height': '132',
            'fileTypeExts': '*.jpg; *.png', //กำหนดชนิดของไฟล์ที่สามารถอัพโหลดได้
            'multi': true, //เปิดใช้งานการอัพโหลดแบบหลายไฟล์ในครั้งเดียว
            'queueSizeLimit': 5, //อัพโหลดได้ครั้งละ 5 ไฟล์
            'onUploadSuccess': function (file, data, response) {
                load_data();
            }
        });
    });

    function load_data() {
        $("#load_images").html("<center><i class=\"fa fa-spinner fa-spin\"></i></center>");
        var url = "<?php echo Yii::app()->createUrl('backend/product/get_images') ?>";
        var product_id = "<?php echo $product['product_id']; ?>";

        var data = {product_id: product_id};
        $.post(url, data, function (datas) {
            $("#load_images").html(datas);
        });
    }

    function delete_images(id, images) {
        var r = confirm("คุณแน่ใจหรือไม่ ...?");
        var url = "<?php echo Yii::app()->createUrl('backend/product/delete_images') ?>";
        var data = {id: id, images: images};

        if (r == true) {
            $.post(url, data, function (datas) {
                load_data();
            });
        }
    }
</script>


<?php
$this->breadcrumbs = array(
    $product['type_name'] => array('backend/product/getproduct&type_id=' . $product['type_id']),
    $product['product_name'] => array('backend/product/detail_product&product_id=' . $product['product_id']),
    "จัดการรูปภาพ",
);
?>

<h4 style=" font-size: 20px; color: #ff0000;">
    <i class="fa fa-image"></i> จัดการรูปภาพ
</h4>

<div class="row">
    <div class="col-lg-4" style="text-align: center;">
        <?php if(empty($imgtitle['images'])){ ?>
        <img src="<?php echo Yii::app()->baseUrl ?>/images/No_image_available.jpg" class="img-responsive img-thumbnail" style=" width: 100%;"/>
        <?php } else { ?>
        <img src="<?php echo Yii::app()->baseUrl ?>/uploads/product_thumb/<?php echo $imgtitle['images'] ?>" class="img-responsive img-thumbnail" style=" width: 100%;"/>
        <?php } ?>
        <br/><br/>
        <a href="<?php echo Yii::app()->createUrl('backend/product/images_title/type_id/' . $product['type_id'] . '/product_id/' . $product['product_id']) ?>">
            <button type="button" class="btn btn-default"><i class="fa fa-plus"></i> รูปภาพหน้าปก</button>
        </a>
    </div>
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">อัลบั้มรูป</div>
            <div class="panel-body">
                <div class="upload">
                    <form>
                        <div class="row">
                            <div class="col-lg-5"></div>
                            <div class="col-lg-7">
                                <input id="Filedata" name="Filedata" type="file" multiple="true">
                                <br/>
                                อัพโหลดได้เฉพาะ jpg , png<br/>
                                อัพโหลดได้ไม่เกินครั้งละ 2MB<br/>
                                อัพโหลดได้ไม่เกินครั้งละ 5 ไฟล์<br/>
                                รูปภาพจะแสดงผลได้ดีที่ขนาด 640 x 640 พิกเซล
                            </div>
                        </div>
                        <!--
                        <div style="width:300px; float:left;">
                        <a href="javascript:$('#Filedata').uploadify('upload')" style="float:left; cursor:pointer;">
                            <input type="button" class="btn btn-success" value="อัพโหลดรูปภาพ"/>
                        </a>
                        </div>
                        -->
                    </form>
                </div>

                <!-- Load Resole -->
                <br/>
                <div class=" row" id="load_images"></div>

            </div>
        </div>
    </div>
</div>



