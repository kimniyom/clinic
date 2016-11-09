<?php
$title = "เพิ่มสินค้า";
$this->breadcrumbs = array(
    $type_name => array('backend/product/getproduct&type_id=' . $type_id),
    $title,
);

$web = new Configweb_model();
?>

<div class="well" style="width:100%;">
    <form class="form-horizontal">
        <fieldset>
            <legend>
                <span class="label label-warning">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/add-product-icon.png"/>
                    เพิ่มข้อมูลสินค้า
                </span>
            </legend>

            <label for="">รหัสสินค้า</label>
            <input type="text" id="product_id" name="product_id" class="form-control" value="<?php echo $product_id; ?>" readonly style="width:40%;"/>

            <label for="">ชื่อสินค้า</label>
            <input type="text" id="product_name" name="product_name" class="form-control" style="width:100%;" required="required"/>

            <br/>
            <label>วันที่หมดอายุ</label>
            <div class="row">
                <?php
                $monthname = $web->MonthFull();
                $monthval = $web->Monthval();
                ?>

                <div class="col-sm-2">
                    <select id="day" name="day" class="form-control">
                        <option value="">วันที่</option>
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            if (strlen($i) <= 1) {
                                $day = "0" . $i;
                            } else {
                                $day = $i;
                            }
                            ?>
                            <option value="<?php echo $day; ?>" <?php
                            if ($i == date('d')) {
                                echo "selected";
                            }
                            ?>><?php echo $day; ?></option>
                                <?php } ?>
                    </select>
                </div>

                <div class="col-sm-4">
                    <select id="month" name="month" class="form-control">
                        <option value="">เดือน</option>
                        <?php for ($i = 0; $i <= 11; $i++) { ?>
                            <option value="<?php echo $monthval[$i]; ?>"><?php echo $monthname[$i]; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-sm-4">
                    <select id="year" name="year" class="form-control">
                        <option value="">ปี</option>
                        <?php
                        $yearnow = date("Y");
                        for ($i = ($yearnow + 10); $i >= $yearnow - 10; $i--) {
                            ?>
                            <option value="<?php echo $i; ?>"><?php echo $i + 543; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <hr/>
            <button type="button" class="btn btn-success" onclick="save_product()">
                <i class="fa fa-save"></i>
                บันทึกข้อมูล
            </button>

            <font style=" color: #ff0033; display: none;" id="f_error">กรอกข้อมูลไม่ครบ ..?</font>
            <!--
            <button id="save_regis" name="save_regis" class="btn btn-success"
                    onclick="save_product();">
                <span class="glyphicon glyphicon-save"></span> <b>บันทึกข้อมูล</b></button>
            -->

        </fieldset>
    </form>
</div>



<script>

    //Modify By Kimniyom
    CKEDITOR.replace('product_detail', {
        image_removeLinkByEmptyURL: true,
        //extraPlugins: 'image',
        //removeDialogTabs: 'link:upload;image:Upload',
        //filebrowserBrowseUrl: 'imgbrowse/imgbrowse.php',
        //filebrowserUploadUrl: 'ckupload.php',
        //uiColor: '#AADC6E',
        filebrowserBrowseUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.html",
        filebrowserImageBrowseUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.html?Type=Images",
        filebrowserFlashBrowseUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.html?Type=Flash",
        filebrowserUploadUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
        filebrowserImageUploadUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
        filebrowserFlashUploadUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"
    });</script>

<script type="text/javascript">
    checkheight();
    //loadimagesProduct();
    function GetImages() {
        load_data();
        $("#popupImages").modal();
    }

    function save_product() {
        var url = "<?php echo Yii::app()->createUrl('backend/product/save_product') ?>";
        var product_name = $("#product_name").val();
        var type_id = "<?php echo $type_id ?>";
        var product_num = $("#product_num").val();
        var product_price = $("#product_price").val();
        var product_id = $("#product_id").val();
        var product_detail = CKEDITOR.instances.product_detail.getData();
        var year = $("#year").val();
        var month = $("#month").val();
        var day = $("#day").val();
        var expire = (year + "-" + "-" + month + "-" + day);
        alert(expire);
        if (product_name == '' || product_price == '' || product_detail == '' || product_num == '') {
            $("#f_error").show().delay(5000).fadeOut(500);
            return false;
        }

        var data = {
            product_id: product_id,
            product_name: product_name,
            type_id: type_id,
            product_num: product_num,
            product_price: product_price,
            product_detail: product_detail
        };

        $.post(url, data, function (success) {
            window.location = "<?php echo Yii::app()->createUrl('backend/product/detail_product&product_id=') ?>" + product_id;
        });
    }

</script>
