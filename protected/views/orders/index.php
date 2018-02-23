<style type="text/css">
    fieldset.scheduler-border {
        border: 1px groove #eeeeee !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #eeeeee;
        box-shadow:  0px 0px 0px 0px #eeeeee;
    }

    legend.scheduler-border {
        width:inherit; /* Or auto */
        padding:0 10px; /* To give a bit of padding on the left and right */
        border-bottom:none;
    }
</style>
<?php
/* @var $this OrdersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'ใบสั่งสินค้า (สาขา' . $branchModel->branchname . ")",
);
?>


<fieldset class="scheduler-border">
    <legend class="scheduler-border">
        :: ค้นหา ::
        <?php if ($branch != "99") { ?>
            <a href="<?php echo Yii::app()->createUrl('orders/create', array('branch' => $branch)) ?>">
                <button type="button" class="btn btn-default"><i class="fa fa-plus"></i> สร้างใบสั่งสินค้า</button>
            </a>
        <?php } ?>
    </legend>
    <div class="row">
        <div class="col-md-6 col-lg-3 col-sm-6">
            <label>สาขา</label>
            <?php
            $this->widget(
                    'booster.widgets.TbSelect2', array(
                'name' => 'branch',
                'id' => 'branch',
                'data' => CHtml::listData($BranchList, 'id', 'branchname'),
                'value' => $branch,
                'options' => array(
                    'placeholder' => 'เลือกสาขา',
                    'width' => '100%',
                    'allowClear' => true,
                )
                    )
            );
            ?>
        </div>
        <div class="col-md-3 col-lg-2 col-sm-6">
            <label>รหัสใบสั่ง</label>
            <input type="text" id="ordercode" class="form-control" onkeypress="return chkNumber()" placeholder="กรอกเฉพาะตัวเลข ..."/>
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

    </div>
    <div class="row" style=" margin-top: 10px;">
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
        <div class="col-md-2 col-lg-1">
            <button type="button" class="btn btn-success btn-block" style="margin-top: 25px;" onclick="searchOrders()">ตกลง</button>
        </div>
    </div>
</fieldset>

<div id="result"></div>

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
        var branch = $("#branch").val();
        var data = {datestart: datestart, dateend: dateend, branch: branch, status: status, order_id: ordercode};
        $.post(url, data, function (datas) {
            $("#result").html(datas);
        });
    }

    function Deleteorder(order_id) {
        var r = confirm("Are yoou sure ...?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('orders/deleteorder') ?>";
            var data = {order_id: order_id};
            $.post(url, data, function (datas) {
                searchOrders();
            });
        }
    }
</script>
