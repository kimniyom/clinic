<?php
/* @var $this OrdersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'ใบสั่งซื้อสินค้า',
);

?>

<h1>ใบสั่งซื้อสินค้า</h1>
<a href="<?php echo Yii::app()->createUrl('orders/create', array('branch' => $branch)) ?>">
    <button type="button" class="btn btn-default"><i class="fa fa-plus"></i> สร้างใบสั่งซื้อสินค้า</button>
</a>
<br/><br/>
<div class="row">
    <div class="col-md-3 col-lg-2">
        <label>รหัสใบสั่งซื้อ</label>
        <input type="text" id="ordercode" class="form-control" onkeypress="return chkNumber()" placeholder="กรอกเฉพาะตัวเลข ..."/>
    </div>
    <div class="col-md-6 col-lg-3">
        <label>เริ่มต้นวันที่</label>
        <div>
            <?php
            $this->widget(
                    'booster.widgets.TbDatePicker', array(
                //'model' => $model,
                //'attribute' => 'birth',
                'value' => date("Y-m-d"),
                'id' => 'datestart',
                'name' => 'datestart',
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
    <div class="col-md-6 col-lg-3">
        <label>สิ้นสุดวันที่</label>
        <div>
            <?php
            $this->widget(
                    'booster.widgets.TbDatePicker', array(
                //'model' => $model,
                //'attribute' => 'birth',
                'value' => date("Y-m-d"),
                'id' => 'dateend',
                'name' => 'dateend',
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
    <div class="col-md-6 col-lg-2">
        <label>สถานะ</label>
        <select class="form-control" id="status">
            <option value="">ทั้งหมด</option>
            <option value="0">รอการยืนยันจากปลายทาง</option>
            <option value="1">ยืนยันการสั่งซื้อ</option>
            <option value="2">จัดส่งสินค้า</option>
            <option value="3">สินค้าถึงผู้รับ</option>
        </select>
    </div>
    <div class="col-md-2 col-lg-1">
        <button type="button" class="btn btn-success btn-block" style="margin-top: 25px;" onclick="searchOrders()">ตกลง</button>
    </div>
</div>
<hr/>
<div id="result">
    
</div>

<script type="text/javascript">
    searchOrders();
    function searchOrders() {
        var loading = '<i class="fa fa-spinner fa-spin fa-fw"></i>';
        $("#result").html(loading);
        var url = "<?php echo Yii::app()->createUrl('orders/search') ?>";
        var datestart = $("#datestart").val();
        var dateend = $("#dateend").val();
        var status = $("#status").val();
        var ordercode = $("#ordercode").val();
        var branch = "<?php echo $branch ?>";
        var data = {datestart: datestart, dateend: dateend, branch: branch,status: status,order_id: ordercode};
        $.post(url, data, function (datas) {
            $("#result").html(datas);
        });
    }
    
    function Deleteorder(order_id){
        var r = confirm("Are yoou sure ...?");
        if(r == true){
            var url = "<?php echo Yii::app()->createUrl('orders/deleteorder')?>";
            var data = {order_id: order_id};
            $.post(url,data,function(datas){
                searchOrders();
            });
        }
    }
</script>
