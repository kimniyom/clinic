<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.js"></script>

<script src="<?php echo Yii::app()->baseUrl ?>/assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl ?>/assets/uploadify/uploadify.css">

<script type="text/javascript">
    $(document).ready(function () {
        //load_data();
        $('#Filedata').uploadify({
            /*'buttonText': 'กรุณาเลือกรูปภาพ ...',*/
            'auto': true, //เปิดใช้การอัพโหลดแบบอัติโนมัติ
            buttonText: "อัพโหลดรูปภาพ",
            //'buttonImage': '<?//= Yii::app()->baseUrl ?>/images/image-up-icon.png',
            'swf': '<?= Yii::app()->baseUrl ?>/assets/uploadify/uploadify.swf', //โฟเดอร์ที่เก็บไฟล์ปุ่มอัพโหลด
            'uploader': "<?= Yii::app()->createUrl('backend/images/uploadify') ?>",
            'fileSizeLimit': '1MB', //อัพโหลดได้ครั้งละไม่เกิน 1024kb
            //'width': '128',
            //'height': '132',
            'fileTypeExts': '*.jpg;', //กำหนดชนิดของไฟล์ที่สามารถอัพโหลดได้
            'multi': true, //เปิดใช้งานการอัพโหลดแบบหลายไฟล์ในครั้งเดียว
            'queueSizeLimit': 5, //อัพโหลดได้ครั้งละ 5 ไฟล์
            'onUploadSuccess': function (file, data, response) {
                load_data();
            }
        });
    });

</script>

<?php
$title = "แก้ไขสินค้า " . $product['product_id'];
$this->breadcrumbs = array(
    'คลังสินค้า' => Yii::app()->createUrl('store/index'),
    'รายการสินค้า' => array('index'),
    $product['product_name'] => Yii::app()->createUrl('centerstockproduct/detail', array('product_id' => $product['product_id'])),
    $title,
);

$BranchModel = new Branch();
?>


<div class="wells" style="width:100%; margin-bottom: 0px;">
    <div class="row" style=" margin-bottom: 0px;">
        <div class="col-md-3 col-lg-3" id="p-left" style=" margin-bottom: 0px; border-right: #cccccc solid 1px;">
                    <div class="well" style=" border:#666666 dashed 2px; text-align: center; cursor: pointer;"
                         onclick="GetImages();">
                        <i class="fa fa-image fa-5x" style=" color: #cccccc;"></i><br/>
                        <i class="fa fa-plus"></i> <font id="font-20">เพิ่มรูปสินค้า</font>
                    </div>
                    <font id="font-20">รูปภาพสินค้า</font>
                    <div id="load_images_product"></div>
                </div>
        <div class="col-md-9 col-lg-9" id="p-right" style=" border-right:0px;">

                    <label for="">หมวดสินค้า*</label><br/>
                    <select id="product_type" style=" width: 50%;" onchange="Getsubproduct(this.value)">
                        <?php
                        $producttype = ProductType::model()->findAll("upper is null");
                        foreach ($producttype as $pt):
                            ?>
                            <option value="<?php echo $pt['id'] ?>" <?php
                            if ($pt['id'] == $product['type_id']) {
                                echo "selected";
                            }
                            ?>><?php echo $pt['type_name'] ?></option>
                                <?php endforeach; ?>
                    </select>


                    <div class="row">
                        <div class="col-lg-6"><label for="">ประเภทสินค้า*</label></div>
                        <div class="col-lg-6"><label for="">รหัสสินค้า*</label></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div id="boxsubproducttype" style=" width: 100%;">
                                <select id="subproducttype" style=" width: 100%;">
                                    <?php
                                    $type = $product['type_id'];
                                    $subproducttype = ProductType::model()->findAll("upper = '$type' ");
                                    foreach ($subproducttype as $st):
                                        ?>
                                        <option value="<?php echo $st['id'] ?>" <?php
                                        if ($st['id'] == $product['subproducttype']) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $st['type_name'] ?></option>
                                            <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" id="product_id" name="product_id" class="form-control" value="<?php echo $product['product_id']; ?>" readonly style="width:40%;"/>
                        </div>
                    </div>


                    <label for="" >ชื่อสินค้าบริษัท</label>
                    <input type="text" id="product_name" name="product_name" class="form-control" value="<?php echo $product['product_name'] ?>"/>

                    <label for="">ชื่อสินค้าคลินิก*</label>
                    <input type="text" id="product_nameclinic" name="product_nameclinic" class="form-control" style="width:100%;" value="<?php echo $product['product_nameclinic'] ?>"/>


                    <div class="row">
                        <div class="col-md-6 col-lg-3"><label for="">หน่วยนับ</label></div>
                        <div class="col-md-6 col-lg-3"><label for="">ราคาต้นทุน</label></div>
                        <div class="col-md-6 col-lg-3"><label for="">ราคาขาย</label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-3">
                            <?php
                            $this->widget('booster.widgets.TbSelect2', array(
                                //'model' => $model,
                                'asDropDownList' => true,
                                //'attribute' => 'itemid',
                                'name' => 'unit',
                                'id' => 'unit',
                                'data' => CHtml::listData(Unit::model()->findAll(""), 'id', 'unit'),
                                'value' => $product['unit_id'],
                                'options' => array(
                                    'allowClear' => true,
                                    //$model,
                                    //'oid',
                                    //'tags' => array('clever', 'is', 'better', 'clevertech'),
                                    'placeholder' => '== หน่วยนับ ==',
                                    'width' => '100%',
                                //'tokenSeparators' => array(',', ' ')
                                )
                            ));
                            ?>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <input type="number" id="costs" name="costs" class="form-control" onkeypress="return chkNumber()" required="required" value="<?php echo $product['costs'] ?>"/>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <input type="text" id="product_price" name="product_price" class="form-control" onkeypress="return chkNumber()" required="required" value="<?php echo $product['product_price'] ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">บริษัท</label><br/>
                            <?php
                            $this->widget('booster.widgets.TbSelect2', array(
                                //'model' => $model,
                                'asDropDownList' => true,
                                //'attribute' => 'itemid',
                                'name' => 'company',
                                'id' => 'company',
                                'data' => CHtml::listData(CenterStockcompany::model()->findAll(""), 'id', 'company_name'),
                                'value' => $product['company'],
                                'options' => array(
                                    'allowClear' => true,
                                    //$model,
                                    //'oid',
                                    //'tags' => array('clever', 'is', 'better', 'clevertech'),
                                    'placeholder' => '== บริษัท ==',
                                    'width' => '100%',
                                //'tokenSeparators' => array(',', ' ')
                                )
                            ));
                            ?>
                        </div>
                        <div class="col-lg-5" style=" padding-top: 22px;">
                            <div class="well well-sm" style=" text-align: center;">
                                <input type="radio" id="private" name="private" value="0" <?php
                                if ($product['private'] == '0') {
                                    echo "checked='checked'";
                                }
                                ?>/> คลินิกมองเห็น
                                &nbsp;&nbsp;<input type="radio" id="private" name="private" value="1" <?php
                                if ($product['private'] == '1') {
                                    echo "checked='checked'";
                                }
                                ?>/> คลินิกมองไม่เห็น
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <label for="textArea">รายละเอียด</label>
                            <textarea id="product_detail" name="product_detail" rows="3" class="form-control input-sm" required="required">
                                <?php echo $product['product_detail'] ?>
                            </textarea>
                        </div>
                    </div>
                    <div class="row" style=" margin-top: 10px;">
                        <div class="col-md-5 col-lg-5">
                            <div class="well well-sm" style=" text-align: left;">
                                <input type="radio" id="status" name="status" value="0" <?php
                                if ($product['status'] == '0') {
                                    echo "checked='checked'";
                                }
                                ?>/> ผลิต
                                &nbsp;&nbsp;<input type="radio" id="status" name="status" value="1" <?php
                                if ($product['status'] == '1') {
                                    echo "checked='checked'";
                                }
                                ?>/> เลิกผลิต
                            </div>
                        </div>
                    </div>


                </div>
            </div>
</div>

<hr style=" margin-top: 0px;"/>
<button type="button" class="btn btn-success pull-right" onclick="save_product()">
    <i class="fa fa-save"></i>
    แก้ไขข้อมูล
</button>
<center>
    <font style=" color: #ff0033; display: none;" id="f_error">กรอกข้อมูลไม่ครบ ..?</font>
</center>

<!--
    ##### Model Images #####
-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="popupImages" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="font-18">เลือกรูปภาพ</h4>
            </div>
            <div class="modal-body" style="height: 400px; overflow: auto;">
                <input id="Filedata" name="Filedata" type="file" multiple="true">
                <font id="font-16">* อัพโหลดได้ครั้งละไม่เกิน 5 ภาพ,นามสกุลไฟล์ .jpg,ขนาดไม่เกิน 1 MB </font>
                <hr/>
                <div id="load_images"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" onclick="GetvalImg()">เลือกรูปภาพ</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    loadimagesProduct();

    $(document).ready(function () {
        $("#product_type").select2({
            allowClear: true,
            theme: "bootstrap"
        });

        $("#subproducttype").select2({
            allowClear: true,
            theme: "bootstrap"
        });

    });

    function Getsubproduct(type_id) {
        //var type_id = $("#producttype").val();
        //alert(type_id);
        var url = "<?php echo Yii::app()->createUrl('producttype/getsubproduct') ?>";
        var data = {type_id: type_id};
        $.post(url, data, function (datas) {
            $("#boxsubproducttype").html(datas);
        });
    }

    //Modify By Kimniyom
    CKEDITOR.replace('product_detail', {
        image_removeLinkByEmptyURL: true,
        //extraPlugins: 'image',
        //removeDialogTabs: 'link:upload;image:Upload',
        //filebrowserBrowseUrl: 'imgbrowse/imgbrowse.php',
        //filebrowserUploadUrl: 'ckupload.php',
        toolbar: [
            //{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
            //{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
            //{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
            //{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
            '/',
            {name: 'basicstyles', groups: ['basicstyles', 'cleanup'], items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']},
            {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']},
            //{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            //{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
            '/',
            {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
            {name: 'colors', items: ['TextColor', 'BGColor']},
            {name: 'tools', items: ['Maximize', 'ShowBlocks']}
            //{ name: 'others', items: [ '-' ] },
            //{ name: 'about', items: [ 'About' ] }
        ],
        uiColor: '#eeeeee',
        filebrowserBrowseUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.html",
        filebrowserImageBrowseUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.html?Type=Images",
        filebrowserFlashBrowseUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.html?Type=Flash",
        filebrowserUploadUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
        filebrowserImageUploadUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
        filebrowserFlashUploadUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"
    });

    function set_active(status, product_id) {
        var url = "<?php echo Yii::app()->createUrl('backend/product/set_active') ?>";
        var data = {status: status, product_id: product_id};
        $.post(url, data, function (success) {

        });
    }

    function GetImages() {
        load_data();
        $("#popupImages").modal();
    }

    function load_data() {
        $("#load_images").html("<center><i class=\"fa fa-spinner fa-spin\"></i></center>");
        var url = "<?php echo Yii::app()->createUrl('backend/images/loadimages') ?>";
        var data = {};
        $.post(url, data, function (datas) {
            $("#load_images").html(datas);
        });
    }

    function loadimagesProduct() {
        $("#load_images_product").html("<center><i class=\"fa fa-spinner fa-spin\"></i></center>");
        var url = "<?php echo Yii::app()->createUrl('backend/product/get_images') ?>";
        var productID = "<?php echo $product['product_id'] ?>";
        var data = {product_id: productID};
        $.post(url, data, function (datas) {
            $("#load_images_product").html(datas);
            //checkheight();
        });
    }

    function save_product() {
        var url = "<?php echo Yii::app()->createUrl('centerstockproduct/save_update') ?>";
        var product_name = $("#product_name").val();
        var product_nameclinic = $("#product_nameclinic").val();
        var company = $("#company").val();
        //var product_num = $("#product_num").val();
        var product_price = $("#product_price").val();
        var product_id = "<?php echo $product['product_id'] ?>";
        var product_detail = CKEDITOR.instances.product_detail.getData();
        //var branch = $("#branch").val();
        var costs = $("#costs").val();
        var type_id = $("#product_type").val();
        var subproducttype = $("#subproducttype").val();
        var unit = $("#unit").val();
        var private = $("input:radio[name=private]:checked").val();
        var status = $("input:radio[name=status]:checked").val();
        if (type_id == '' || subproducttype == '' || product_name == '' || product_price == '' || costs == '' || unit == '') {
            $("#f_error").show().delay(5000).fadeOut(500);
            return false;
        }

        var data = {
            product_id: product_id,
            product_name: product_name,
            product_nameclinic: product_nameclinic,
            company: company,
            //product_num: product_num,
            product_price: product_price,
            product_detail: product_detail,
            costs: costs,
            type_id: type_id,
            subproducttype: subproducttype,
            unit: unit,
            private: private,
            status: status
        };

        $.post(url, data, function (success) {
            window.location = "<?php echo Yii::app()->createUrl('centerstockproduct/detail&product_id=') ?>" + product_id;
        });
    }

    function delete_images(id) {
        var r = confirm("คุณแน่ใจหรือไม่ ...?");
        var url = "<?php echo Yii::app()->createUrl('centerstockproduct/delete_images') ?>";
        var productID = "<?php echo $product['product_id'] ?>";
        var data = {id: id, product_id: productID};

        if (r == true) {
            $.post(url, data, function (datas) {
                //load_data();
                loadimagesProduct();
            });
        }
    }

    

</script>


<script type="text/javascript">

    Setscreen();
    function Setscreen() {
        var screen = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = (screen - 170);
        $("#p-left").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
        $("#p-right").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
        //$("#patientbox").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF'});
        //$("#boxorders").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF', 'overflow': 'auto', 'padding-left': '10px'});

    }


</script>
