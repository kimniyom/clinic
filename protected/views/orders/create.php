<style type="text/css">
    #companysell tr td{
        border-bottom: #cccccc solid 1px;
    }
</style>
<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs = array(
    'ใบสั่งสินค้า (สาขา' . $branchModel->branchname . ")" => array('index', "branch" => $branch),
    'สร้างใบสั่ง (สาขา' . $branchModel->branchname . ")",
);

$companySell = Companycenter::model()->find("id = '1'");
$BranchModel = Branch::model()->find("id = '$branch'");
?>
<div class="panel panel-default" style=" margin-bottom: 0px;">
    <div class="panel-body" style=" border-radius: 0px; position: relative;" id="boxorders">
        <div style=" text-align: center;">
            <h4 style=" margin-bottom: 0px;"><?php echo $BranchModel['branchname']; ?></h4><br/>
            <?php echo $BranchModel['address']; ?><br/>
            <?php echo $BranchModel['contact']; ?><br/>
            <h4 style=" margin: 0px;">ใบสั่งซื้อสินค้า</h4>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <table id="companysell">
                    <tr>
                        <td>ผู้ขาย : <?php echo $companySell['companyname'] ?></td>
                    </tr>
                    <tr>
                        <td>ที่อยู่ : <?php echo $companySell['address'] ?></td>
                    </tr>
                    <tr>
                        <td>ติดต่อ : คุณ <?php echo $companySell['memager'] ?> โทร. <?php echo $companySell['tel'] ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div style=" padding: 10px; position: relative; height: 100px;" class="box-codenumber">
                    <table style=" border: #cccccc solid 1px; float: right;" class="box-codenumber">
                        <tr style=" border-bottom: #cccccc solid 1px;">
                            <td>รหัสสั่งซื้อเลขที่ : </td>
                            <td><?php echo $order_id ?></td>
                        </tr>
                        <tr>
                            <td>วันที่สั่งซื้อ : </td>
                            <td><?php echo date('d/m/Y') ?></td>
                        </tr>
                    </table>
                </div
            </div>
        </div>
    </div>
    <hr/>
    <div>
        <label>ชื่อผู้ติดต่อ</label> <?php echo $BranchModel['menagers'] ?> 
        <label>โทรศัพท์</label> <?php echo $BranchModel['telmenager'] ?>
    </div>
    <div class="well">
        <div class="row">
            <div class="col-md-6 col-lg-3">
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
                        'width' => '100%',
                    //'tokenSeparators' => array(',', ' ')
                    )
                ));
                ?>
            </div>
            <div class="col-lg-3 col-md-6">
                <label for="">ประเภทสินค้า*</label>
                <div id="boxsubproducttype" style=" width: 100%;">
                    <select id="subproducttype" class="form-control">
                        <option value=""></option>
                    </select>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <label for="">สินค้า*</label><br/>
                <div id="boxproduct" style=" width: 100%;">
                    <select id="product" class="form-control">
                        <option value=""></option>
                    </select>
                </div>
            </div>

            <!--
            <div class="col-lg-6">
                <label for="">รหัสสินค้า*</label>
                <input type="text" id="product_id" name="product_id" class="form-control" style="width:40%;" readonly="readonly"/>
            </div>
            -->
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-6">
                <label for="">จำนวน*</label><br/>
                <input type="text" class="form-control" id="number" value="1"/>
            </div>
            <!--
            <div class="col-md-3 col-lg-3">
                <label for="">ส่วนลด%</label>
                <input type="text" class="form-control" id="distcountpersent" value="0"/>
            </div>
            -->
            <div class="col-lg-1 col-md-2">
                <button type="button" class="btn btn-block btn-primary" style=" margin-top: 25px;" onclick="AddproductInlist()"><i class="fa fa-plus"></i> เพิ่ม</button>
            </div>
        </div>
    </div>
    <div id="orderlist" class="table table-responsive"></div>

</div>
<div class=" panel-footer" style=" padding: 5px;">
    <div class="row" style=" margin: 0px;">
        <div class="col-md-3 col-lg-3 col-sm-6 col-xs-6">
            <button type="button" class="btn btn-success btn-block" onclick="Saveorder()"><i class="fa fa-save"></i> บันทึกแบบฟอร์ม</button>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-6 col-xs-6">
            <button type="button" class="btn btn-danger btn-block" onclick="window.location.reload()"><i class="fa fa-remove"></i> ยกเลิก</button>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    //loadimagesProduct();
    $(document).ready(function () {
        $("#producttype").change(function () {
            var type_id = $("#producttype").val();
            var url = "<?php echo Yii::app()->createUrl('producttype/getsubproductorder') ?>";
            var data = {type_id: type_id};
            $.post(url, data, function (datas) {
                $("#boxsubproducttype").html(datas);
            });
        });
    });

    function combotype() {

        var type_id = "";
        var url = "<?php echo Yii::app()->createUrl('producttype/getsubproductorder') ?>";
        var data = {type_id: type_id};
        $.post(url, data, function (datas) {
            $('#producttype').select2("val", "");
            $("#boxsubproducttype").html(datas);
        });
    }

    function loadimagesProduct() {
    }

    function loaddata() {
        var url = "<?php echo Yii::app()->createUrl('orders/loaddata') ?>";
        var order_id = "<?php echo $order_id ?>";
        var data = {order_id: order_id};
        $.post(url, data, function (datas) {
            $("#orderlist").html(datas);
        });
    }

    function AddproductInlist() {
        var url = "<?php echo Yii::app()->createUrl('listorder/save') ?>";
        //var product_name = $("#product_name").val();
        //var product_nameclinic = $("#product_nameclinic").val();
        //var company = $("#company").val();
        //var type_id = $("#producttype").val();
        //var subproducttype = $("#subproducttype").val();
        //var product_price = $("#product_price").val();
        var product = $("#product").val();
        var order_id = "<?php echo $order_id ?>";
        var number = $("#number").val();
        //var distcount = $("#distcountpersent").val();
        var distcount = 0;
        //var private = $("input:radio[name=private]:checked").val();
        if (product == '' || number == '' || product == null) {
            sweetAlert("แจ้งเตือน...", "กรอกข้อมูลไม่ครบ!", "warning");
            return false;
        }

        var data = {
            product_id: product,
            order_id: order_id,
            number: number,
            distcount: distcount
        };

        $.post(url, data, function (success) {
            loaddata();
            combotype();
        });
    }

    function Saveorder() {
        var url = "<?php echo Yii::app()->createUrl('orders/save') ?>";
        var order_id = "<?php echo $order_id ?>";
        var branch = "<?php echo $branch ?>";
        var data = {
            order_id: order_id,
            branch: branch
        };

        var urlcheck = "<?php echo Yii::app()->createUrl('orders/checklistorder') ?>";
        var daracheck = {order_id: order_id};
        $.post(urlcheck, daracheck, function (datas) {
            if (datas > 0) {
                $.post(url, data, function (success) {
                    var url = "<?php echo Yii::app()->createUrl('orders/view', array('order_id' => $order_id)) ?>";
                    window.location = url;
                });
            } else {
                alert("ไม่มีรายการสินค้าในใบสั่งซื้อ");
                return false;
            }
        });


    }

</script>

<script type="text/javascript">
    Setscreen();
    function Setscreen() {
        var screen = $(window).height();
        var screenfull = (screen - 150);
        $("#boxorders").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});

        var w = window.innerWidth;
        if (w <= 786) {
            $("#companysell").css({'width': '100%'});
            $(".box-codenumber").css({'width': '100%', 'margin': '0px', 'padding': '0px', 'border-top': '0px'});
        }
    }
</script>
