<?php
$title = "แก้ไขสินค้า " . $product['product_id'];
$BranchModel = new Branch();
$this->breadcrumbs = array(
    'คลังสินค้า' => Yii::app()->createUrl('storeclinic/index'),
    'รายการสินค้า (สาขา' . $BranchModel->Getbranch($product['branch']) . ")" => array('index', "branch" => $product['branch']),
    $product['product_name'] => Yii::app()->createUrl('clinicstockproduct/detail', array('product_id' => $product['product_id'], 'branch' => $product['branch'])),
    $title,
);
?>

<div class="wells" style="width:100%;">
    <div class="row">
        <div class="col-md-3 col-lg-3" id="p-left">

            <font id="font-20">รูปภาพสินค้า</font>
            <div id="load_images_product"></div>
        </div>
        <div class="col-md-9 col-lg-9" id="p-right">

            <label for="">หมวดสินค้า*</label><br/>
            <select id="product_type" style=" width: 50%;" onchange="Getsubproduct(this.value)" disabled="disabled">
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
                        <select id="subproducttype" style=" width: 100%;" disabled="disabled">
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

            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <label>สินค้า</label>
                    <?php
                    $product_id = $product['product_id'];
                    $products = CenterStockproduct::model()->findAll("");
                    ?>
                    <select id="product" style=" width: 100%;" disabled="disabled">
                        <?php
                        foreach ($products as $pt):
                            ?>
                            <option value="<?php echo $pt['product_id'] ?>" <?php
                            if ($pt['product_id'] == $product['product_id']) {
                                echo "selected";
                            }
                            ?>><?php echo $pt['product_nameclinic'] ?></option>
                                <?php endforeach; ?>
                    </select>

                </div>
            </div>
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
                    <input type="number" id="costs" name="costs" class="form-control" onkeypress="return chkNumber()" required="required" value="<?php echo $product['costs'] ?>" readonly="readonly"/>
                </div>
                <div class="col-md-4 col-lg-3">
                    <input type="text" id="product_price" name="product_price" class="form-control" onkeypress="return chkNumber()" required="required" value="<?php echo $product['product_price'] ?>"/>
                </div>
            </div>


            <label for="textArea">รายละเอียด</label>
            <div id="product_detail" name="product_detail" class="well">
                <?php echo $product['product_detail'] ?>
            </div>


            <!--
            <button id="save_regis" name="save_regis" class="btn btn-success"
                    onclick="save_product();">
                <span class="glyphicon glyphicon-save"></span> <b>บันทึกข้อมูล</b></button>
            -->
        </div>
    </div>
    <hr style=" margin-top: 0px; padding-top: 0px;"/>
    <div class="row">
        <div class="col-md-9 col-lg-9">
            <center><font style=" color: #ff0033; display: none;" id="f_error">กรอกข้อมูลไม่ครบ ..?</font></center>
        </div>
        <div class="col-md-3 col-lg-3">
            <button type="button" class="btn btn-success pull-right" onclick="save_product()" style=" margin-top: 0px;">
                <i class="fa fa-save"></i>
                แก้ไขข้อมูล
            </button>
        </div>
    </div>
</div>

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

        $("#product").select2({
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
            checkheight();
        });
    }

    function save_product() {
        var url = "<?php echo Yii::app()->createUrl('clinicstockproduct/save_update') ?>";
        var id = "<?php echo $product['id'] ?>";
        //var product_name = $("#product_name").val();
        //var product_nameclinic = $("#product_nameclinic").val();
        //var company = $("#company").val();
        //var product_num = $("#product_num").val();
        var product_price = $("#product_price").val();
        var product_id = "<?php echo $product['product_id'] ?>";
        //var product_detail = CKEDITOR.instances.product_detail.getData();
        //var branch = $("#branch").val();
        //var costs = $("#costs").val();
        //var type_id = $("#product_type").val();
        //var subproducttype = $("#subproducttype").val();
        var unit = $("#unit").val();
        //var private = $("input:radio[name=private]:checked").val();
        if (product_price == '' || unit == '') {
            $("#f_error").show().delay(5000).fadeOut(500);
            return false;
        }

        var data = {
            id: id,
            //product_id: product_id,
            //product_name: product_name,
            //product_nameclinic: product_nameclinic,
            //company: company,
            //product_num: product_num,
            product_price: product_price,
            //product_detail: product_detail,
            //costs: costs,
            //type_id: type_id,
            //subproducttype: subproducttype,
            unit: unit
                    //private: private
        };

        $.post(url, data, function (success) {
            var branch = "<?php echo $product['branch'] ?>";
            window.location = "<?php echo Yii::app()->createUrl('clinicstockproduct/detail&product_id=') ?>" + product_id + "&branch=" + branch;
        });
    }

    function delete_images(id) {
        confirm("คุณไม่ได้รับสิทธ์ให้ลบได้");
        return false;
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
        var screenfull = (screen - 165);
        $("#p-left").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
        $("#p-right").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
        //$("#patientbox").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF'});
        //$("#boxorders").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF', 'overflow': 'auto', 'padding-left': '10px'});

    }


</script>

