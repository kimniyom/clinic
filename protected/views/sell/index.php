<?php
$UserModel = new Masuser();
$BranchModel = new Branch();
$Config = new Configweb_model();
$Profile = $UserModel->GetProfile();
$items = new Items();
$branchactive = Yii::app()->session['branch'];
$brancList = $BranchModel->ComboBranchDisabled($branchactive);
$itemlist = $items->GetItemSell();
$PatientModel = new Patient();
$PatientList = $PatientModel->GetPatient();

$sell_id = $Config->RandstrgenNumber(10);
?>
<div class="well">
    <div class="row">
        <div class="col-lg-6" style=" border-right: #999999 solid 1px;">
            <div class="row">
                <div class="col-lg-4">
                    รหัสขาย
                    <input type="text" class="form-control" id="sellcode" value="<?php echo $sell_id ?>" readonly="readonly"/>
                </div>
                <div class="col-lg-6">
                    ชื่อสมาชิก *ถ้ามี
                    <?php
                    $this->widget(
                            'booster.widgets.TbSelect2', array(
                        'name' => 'card',
                        'id' => 'card',
                        'data' => CHtml::listData($PatientList, 'card', 'name'),
                        'options' => array(
                            'placeholder' => 'สมาชิก',
                            'width' => '100%',
                        )
                            )
                    );
                    ?>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-5">
                    รหัสสินค้า
                    <div id="_item"></div>
                </div>
                <div class="col-lg-2">
                    จำนวน
                    <input type="text" class="form-control" id="number" value="1" onkeypress="return chkNumber()" style=" text-align: center;" readonly="readonly"/>
                </div>
                <div class="col-lg-4">
                    พนักงานขาย
                    <input type="text" class="form-control" id="user" readonly="readonly" value="<?php echo $Profile['name'] . " " . $Profile['lname'] ?>"/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    สาขา
                    <?php echo $brancList ?>
                </div>
                <div class="col-lg-6">
                    <button type="button" class="btn btn-success btn-block" onclick="sell()" style="margin-top: 20px;"><i class="fa fa-plus"></i> เพิ่มสินค้า</button>
                </div>
            </div>
            <br/>
            <p style=" color: #ff3300;">*ห้าม refresh หน้าจอก่อนสิ้นสุดการขาย</p>
        </div>

        <div class="col-lg-3">
            รับเงิน
            <input type="text" class="form-control" id="income" onkeypress="return chkNumber()" style=" text-align: center; font-weight: bold; font-size: 24px;" onkeyup="Income(this.value)"/>
            เงินทอน
            <input type="text" class="form-control" id="change" readonly="readonly" style=" text-align: center; color: #33cc00; font-weight: bold; font-size: 24px; background: #333333;"/>
            <hr style=" border-bottom: #999999 solid 1px;"/>
            <button type="button" class="btn btn-info btn-block" onclick="Check_bill()">
                <i class="fa fa-money"></i> ชำระเงิน</button>
        </div>

        <div class="col-lg-3" style=" border-left: #999999 solid 1px;">
            <div class="well" style=" text-align: center; background: #333333;">
                <h2 style=" color: #FFFFFF;">ราคารวม</h2>
                <input type="hidden" id="_total" value="0">
                <h1 id="total" style=" color: #ffcc00;">0</h1>
            </div>
            <?php $url = Yii::app()->createUrl('sell/bill', array("sell_id" => $sell_id)) ?>
            <!--
            <button type="button" class="btn btn-success btn-block" onclick="PopupBill('<?php //echo $url            ?>', '<?php //echo $sell_id            ?>')"><i class="fa fa-print"></i> พิมพ์ใบเสร็จ</button>
            -->
            <button type="button" class="btn btn-danger btn-block" onclick="javascript:window.location.reload()"><i class="fa fa-remove"></i> จบการขาย</button>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-bars"></i> รายการขาย</div>
    <div class="panel-body">
        <div id="orderlist"><h3 style=" text-align: center;">ยังไม่มีรายการขาย</h3></div>
    </div>
</div>

<script type="text/javascript">
    loaditems();
    $(document).ready(function () {
        $(".breadcrumb").hide();
    });
    function sell() {
        var url = "<?php echo Yii::app()->createUrl('sell/sell') ?>";
        var itemcode = $("#itemcode").val();
        var sellcode = $("#sellcode").val();
        var branch = $("#branch").val();
        var card = $("#card").val();
        var data = {itemcode: itemcode, sellcode: sellcode, card: card, branch: branch};
        if (itemcode == "") {
            alert("กรุณาเลือกสินค้า ...");
            return false;
        }
        $.post(url, data, function (datas) {
            $("#orderlist").html(datas);
            loaditems();
            loadorder();
        });
    }

    function confirmOrder() {
        var url = "<?php echo Yii::app()->createUrl('sell/logsell') ?>";
        var itemcode = $("#itemcode").val();
        var sellcode = $("#sellcode").val();
        var branch = $("#branch").val();
        var card = $("#card").val();
        var total = $("#_total").val();
        var income = $("#income").val();
        var change = $("#change").val();
        var data = {itemcode: itemcode, sellcode: sellcode, card: card, branch: branch, total: total, income: income, change: change};
        $.post(url, data, function (datas) {
            PrintBill(sellcode);
            //$("#orderlist").html(datas);
            //loaditems();
            //loadorder();
        });
    }

    function PrintBill(sellcode) {
        var url = "<?php echo Yii::app()->createUrl('sell/bill') ?>" + "&sell_id=" + sellcode;
        PopupBill(url, sellcode);
    }

    function loaditems() {
        var url = "<?php echo Yii::app()->createUrl('backend/items/comboitem') ?>";
        var data = {};
        $.post(url, data, function (datas) {
            $("#_item").html(datas);
        });
    }

    function loadorder() {
        //var loader = '<i class="fa-li fa fa-spinner fa-spin"></i>';
        var url = "<?php echo Yii::app()->createUrl('sell/loadorder') ?>";
        var sell_id = $("#sellcode").val();
        var data = {sell_id: sell_id};
        //$("#orderlist").html(loader);
        $.post(url, data, function (datas) {
            $("#orderlist").html(datas);
            Calculator();
        });
    }

    function Calculator() {
        var url = "<?php echo Yii::app()->createUrl('sell/calculator') ?>";
        var sellcode = $("#sellcode").val();
        var data = {sell_id: sellcode};
        $.post(url, data, function (response) {
            var datas = jQuery.parseJSON(response);
            $("#_total").val(datas.total);
            $("#total").text(formatThousands(datas.total) + ".-");
        });
    }

    function Income(value) {
        var total = parseInt($("#_total").val());
        var income = parseInt(value);

        if (income < total || isNaN(income)) {
            $("#change").val(0);
        } else {
            var changes = parseInt((income - total));
            $("#change").val(changes);
        }
    }

    function formatThousands(n, dp) {
        var s = '' + (Math.floor(n)), d = n % 1, i = s.length, r = '';
        while ((i -= 3) > 0) {
            r = ',' + s.substr(i, 3) + r;
        }
        return s.substr(0, i + 3) + r + (d ? '.' + Math.round(d * Math.pow(10, dp || 2)) : '');
    }

    //พิมพ์ใบเสร็จ
    function Bills() {
        var url = "<?php echo Yii::app()->createUrl('sell/bill') ?>";
        var sell_id = "<?php echo $sell_id ?>";
        var data = {sell_id: sell_id};
        $.post(url, data, function (datas) {
            //$("#popupbill").modal();
            //PrintElem("#bodybill");
            //$("#bodybill").html(datas);
            //PopupBill(datas);
            alert(datas);
        });
    }

    //ชำระเงิน
    function Check_bill() {
        //var url = $("#Urlcheckbill").val();
        //var orderID = $("#orderID").val();
        var total = parseInt($("#_total").val());
        //var distcount = $("#distcount").val();
        var income = parseInt($("#income").val());
        //var change = $("#change").val();

        if (total <= 0) {
            //alert("ยังไม่มีรายการสินค้า ...");
            swal("แจ้งเตือน!", "ยังไม่มีรายการสินค้า ...!", "warning");
            $("#income").focus();
            return false;
        }

        if (isNaN(income) || income <= 0) {
            //alert("ยังไม่ได้รับเงินจากลูกค้า ใส่จำนวนเงินที่ช่องรับเงิน");
            swal("แจ้งเตือน!", "ยังไม่ได้รับเงินจากลูกค้า ใส่จำนวนเงินที่ช่องรับเงิน ...!", "warning");
            $("#income").focus();
            return false;
        }

        if (income < total) {
            swal("แจ้งเตือน!", "ไม่พอจ่ายค่าสินค้า ...!", "warning");
            $("#income").focus();
            return false;
        }

        confirmOrder();

        /*
         var data = {
         orderID: orderID,
         total: total,
         distcount: distcount,
         income: income,
         change: change
         };
         $.post(url, data, function (response) {
         window.location.reload();
         //var datas = jQuery.parseJSON(response);
         //$("#total").val(datas.total);
         });
         */
    }


    function PopupBill(url, title) {
        // Fixes dual-screen position  
        //                        Most browsers      Firefox
        var w = 800;
        var h = 600;
        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

        var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        var left = ((width / 2) - (w / 2)) + dualScreenLeft;
        var top = ((height / 2) - (h / 2)) + dualScreenTop;
        var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

        // Puts focus on the newWindow
        if (window.focus) {
            newWindow.focus();
        }
    }
</script>



