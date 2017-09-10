<style type="text/css">
    #companysell tr td{
        border-bottom: #cccccc solid 1px;
    }
</style>
<?php
/* @var $this OrdersController */
/* @var $model Orders */
$branch = $order['branch'];
$this->breadcrumbs = array(
    'ใบสั่งซื้อสินค้า' => array('index', "branch" => $branch),
    'แก้ไขใบสั่งซื้อ',
);

$companySell = Companycenter::model()->find("id = '1'");
$BranchModel = Branch::model()->find("id = '$branch'");
?>

<div class="panel panel-default" style=" margin-bottom: 0px;">
    <div class="panel-body" id="boxorders">
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
                <div style=" padding: 10px; position: relative; height: 100px;">
                    <table style=" border: #cccccc solid 1px; float: right;">
                        <tr style=" border-bottom: #cccccc solid 1px;">
                            <td>รหัสสั่งซื้อเลขที่ : </td>
                            <td><?php echo $order_id ?></td>
                        </tr>
                        <tr>
                            <td>วันที่สั่งซื้อ : </td>
                            <td><?php echo $order['create_date'] ?></td>
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
                <button type="button" class="btn btn-block btn-success" style=" margin-top: 25px;" onclick="AddproductInlist()">เพิ่ม</button>
            </div>
        </div>
    </div>
    <div id="orderlist">
        ​​
    </div>
</div>
<div class="panel-footer">
    <button type="button" class="btn btn-success" onclick="Saveorder()"><i class="fa fa-pencil"></i> แก้ไขแบบฟอร์ม</button>
</div>
</div>

<script type="text/javascript">
    loaddata();
    $(document).ready(function () {
        $("#producttype").change(function () {
            var type_id = $("#producttype").val();
            var url = "<?php echo Yii::app()->createUrl('producttype/getsubproduct') ?>";
            var data = {type_id: type_id};
            $.post(url, data, function (datas) {
                $("#boxsubproducttype").html(datas);
            });
        });
    });

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
        var distcount = $("#distcountpersent").val();
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
        });
    }

    function Saveorder() {
        
        var url = "<?php echo Yii::app()->createUrl('orders/view', array('order_id' => $order_id)) ?>";
        window.location = url;
    }

</script>

<script type="text/javascript">

    Setscreen();
    function Setscreen() {
        var screen = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = (screen - 155);
        $("#boxorders").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
        //$("#patientbox").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF'});
        //$("#boxorders").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF', 'overflow': 'auto', 'padding-left': '10px'});

    }


</script>
