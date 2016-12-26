<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.js"></script>
<?php
$title = "เพิ่มสินค้า";
$this->breadcrumbs = array(
    "คลังสินค้ากลาง" => Yii::app()->createUrl('store/index'),
    "คลังสินค้า" => array('index'),
    $title,
);

$web = new Configweb_model();
$BranchModel = new Branch();
?>

<div class="wells" style="width:100%; margin-bottom: 10px;">
    <form class="form-horizontal">
        <fieldset>
            <legend>
                <span class="label label-success">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/add-product-icon.png"/>
                    เพิ่มสินค้าเข้าคลัง
                </span>
            </legend>

            <div class="row">
                <div class="col-md-3 col-lg-3" id="p-left">
                    <div id="load_images_product"></div>
                </div>
                <div class="col-md-9 col-lg-9" id="p-right">
                    <label for="">หมวดสินค้า*</label><br/>
                    <?php
                    $this->widget('booster.widgets.TbSelect2', array(
                        //'model' => $model,
                        'asDropDownList' => true,
                        //'attribute' => 'itemid',
                        'name' => 'producttype',
                        'id' => 'producttype',
                        'data' => CHtml::listData(ProductType::model()->findAll("upper is null"), 'id', 'type_name'),
                        //'value' => $model,
                        'options' => array(
                            'allowClear' => true,
                            //$model,
                            //'oid',
                            //'tags' => array('clever', 'is', 'better', 'clevertech'),
                            'placeholder' => '== หมวดสินค้า ==',
                            'width' => '50%',
                        //'tokenSeparators' => array(',', ' ')
                        )
                    ));
                    ?><br/>
                    <label for="">ประเภทสินค้า*</label><br/>
                    <div id="boxsubproducttype" style=" width: 50%;">
                        <select id="subproducttype" class="form-control">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">สินค้า*</label><br/>
                            <div id="boxproduct" style=" width: 100%;">
                                <select id="product" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="">รหัสสินค้า*</label>
                            <input type="text" id="product_id" name="product_id" class="form-control" style="width:40%;" readonly="readonly"/>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-3"><label for="">ราคาต้นทุน*</label></div>
                        <div class="col-md-6 col-lg-3"><label for="">ราคาขาย*</label></div>
                        <div class="col-md-6 col-lg-3"><label for="">จำนวนนำเข้า*</label></div>
                        <div class="col-md-6 col-lg-3"><label for="">ราคารวม</label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <input type="number" id="costs" name="costs" class="form-control" onkeypress="return chkNumber()" required="required" readonly="readonly"/>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <input type="text" id="product_price" name="product_price" class="form-control" onkeypress="return chkNumber()" required="required" readonly="readonly"/>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <input type="text" id="number" name="number" class="form-control" onkeypress="return chkNumber()" required="required" onkeyup="Calculator()"/>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <input type="text" id="total" name="total" class="form-control" readonly="readonly"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-3"><label for="">ล๊อตที่</label></div>
                        <div class="col-md-6 col-lg-3"><label for="">วันที่ผลิต</label></div>
                        <div class="col-lg-1"></div>
                        <div class="col-md-6 col-lg-3"><label for="">วันที่หมดอายุ</label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <?php $lotnumber = date("Ymd") ?>
                            <input type="text" id="lotnumber" name="lotnumber" class="form-control" required="required" readonly="readonly" value="<?php echo $lotnumber ?>"/>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div>
                                <?php
                                $this->widget(
                                        'booster.widgets.TbDatePicker', array(
                                    //'model' => $model,
                                    //'attribute' => 'birth',
                                    'id' => 'generate',
                                    'name' => 'generate',
                                    'options' => array(
                                        'language' => 'th',
                                        'type' => 'date',
                                        'format' => 'yyyy-mm-dd',
                                    )
                                        )
                                );
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-md-6 col-lg-3">
                            <div>
                                <?php
                                $this->widget(
                                        'booster.widgets.TbDatePicker', array(
                                    //'model' => $model,
                                    //'attribute' => 'birth',
                                    'id' => 'expire',
                                    'name' => 'expire',
                                    'options' => array(
                                        'language' => 'th',
                                        'type' => 'date',
                                        'format' => 'yyyy-mm-dd',
                                    )
                                        )
                                );
                                ?>
                            </div>
                        </div>
                    </div>

                    <label for="textArea">รายละเอียด</label>
                    <div class="well" id="product_detail" style=" min-height: 100px;"></div>


                    <div class="panel panel-default">
                        <div class="panel-heading">วัตถุดิบที่ต้องใช้</div>
                        <div id="item"></div>
                        <div class="panel-footer">
                            <button type="button" class="btn btn-default" onclick="cutstock()">ตัดสต๊อก</button>
                        </div>
                    </div>


                    <hr/>
                    <button type="button" class="btn btn-success" onclick="save_product()">
                        <i class="fa fa-save"></i>
                        เพิ่มสินค้าเข้าคลัง
                    </button>

                    <font style=" color: #ff0033; display: none;" id="f_error">กรอกข้อมูลไม่ครบ ..?</font>
                    <!--
                    <button id="save_regis" name="save_regis" class="btn btn-success"
                            onclick="save_product();">
                        <span class="glyphicon glyphicon-save"></span> <b>บันทึกข้อมูล</b></button>
                    -->
                </div>
            </div>
        </fieldset>
    </form>
</div>

<script type="text/javascript">
    checkheight();
    settexbox();
    //loadimagesProduct();
    $(document).ready(function () {
        $("#producttype").change(function () {
            var type_id = $("#producttype").val();
            var url = "<?php echo Yii::app()->createUrl('centerstoreproduct/getsubproduct') ?>";
            var data = {type_id: type_id};
            $.post(url, data, function (datas) {
                $("#boxsubproducttype").html(datas);
            });
        });
    });

    function settexbox() {

        var product = $("#product").val();
        if (product != '') {
            $("#number").removeAttr("disabled");
            $("#generate").removeAttr("disabled");
            $("#expire").removeAttr("disabled");

            setnulltextbox();
        }

        if (product != null) {
            $("#number").removeAttr("disabled");
            $("#generate").removeAttr("disabled");
            $("#expire").removeAttr("disabled");

            setnulltextbox();
        }

        if (product == '') {
            $("#number").attr("disabled", "disabled");
            $("#generate").attr("disabled", "disabled");
            $("#expire").attr("disabled", "disabled");

            setnulltextbox();
        }

        if (product == null) {
            $("#number").attr("disabled", "disabled");
            $("#generate").attr("disabled", "disabled");
            $("#expire").attr("disabled", "disabled");

            setnulltextbox();
        }
    }

    function setnulltextbox() {
        $("#number").val("");
        $("#generate").val("");
        $("#expire").val("");
        $("#total").val("");

        Calculator();
    }

    function getitem(number) {
        var product_id = $("#product_id").val();
        var url = "<?php echo Yii::app()->createUrl('centerstockmix/getitem') ?>";
        var data = {product_id: product_id, number: number};
        $.post(url, data, function (datas) {
            $("#item").html(datas);
        });
    }

    function save_product() {
        var url = "<?php echo Yii::app()->createUrl('centerstoreproduct/saveproduct') ?>";
        var product_id = $("#product_id").val();
        var number = $("#number").val();
        var lotnumber = $("#lotnumber").val();
        var generate = $("#generate").val();
        var expire = $("#expire").val();

        if (number == '' || lotnumber == '' || generate == '' || expire == '') {
            $("#f_error").show().delay(5000).fadeOut(500);
            return false;
        }

        var data = {
            product_id: product_id,
            number: number,
            lotnumber: lotnumber,
            generate: generate,
            expire: expire
        };

        $.post(url, data, function (success) {
            window.location = "<?php echo Yii::app()->createUrl('centerstoreproduct/index') ?>";
        });
    }


    function loadimagesProduct() {
        $("#load_images_product").html("<center><i class=\"fa fa-spinner fa-spin\"></i></center>");
        var url = "<?php echo Yii::app()->createUrl('centerstoreproduct/getimages') ?>";
        var productID = $("#product_id").val();
        var data = {product_id: productID};
        $.post(url, data, function (datas) {
            $(".btn btn-danger").hide();
            $("#load_images_product").html(datas);
            checkheight();
        });
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

    function Calculator() {
        var number = parseInt($("#number").val());
        var costs = parseInt($("#costs").val());
        var total = (costs * number);
        $("#total").val(total);
        getitem(number);
    }

    function formatThousands(n, dp) {
        var s = '' + (Math.floor(n)), d = n % 1, i = s.length, r = '';
        while ((i -= 3) > 0) {
            r = ',' + s.substr(i, 3) + r;
        }
        return s.substr(0, i + 3) + r + (d ? '.' + Math.round(d * Math.pow(10, dp || 2)) : '');
    }


    function cutstock() {
        var url = "<?php echo Yii::app()->createUrl('centerstoreproduct/cutstock') ?>";
        var productID = $("#product_id").val();
        var number = $("#number").val();
        var data = {product_id: productID,number: number};
        $.post(url, data, function (datas) {
            getitem(number);
        });
    }
</script>

