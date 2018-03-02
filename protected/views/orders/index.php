
<?php
/* @var $this OrdersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'ใบสั่งสินค้า (สาขา' . $branchModel->branchname . ")",
);
?>

<div class="row" style=" margin: 0px;">
    <div class="col-md-6 col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                :: ค้นหา ::
                <?php if ($branch != "99") { ?>
                    <a href="<?php echo Yii::app()->createUrl('orders/create', array('branch' => $branch)) ?>">
                        <button type="button" class="btn btn-default"><i class="fa fa-plus"></i> สร้างใบสั่งสินค้า</button>
                    </a>
                <?php } else { ?>
                    <button type="button" class="btn btn-default disabled"><i class="fa fa-plus"></i> สร้างใบสั่งสินค้า</button>
                <?php } ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
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
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <label>รหัสใบสั่ง</label>
                        <input type="text" id="ordercode" class="form-control" onkeypress="return chkNumber()" placeholder="กรอกเฉพาะตัวเลข ..."/>
                    </div>

                    <div class="col-md-12 col-lg-12">
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
                    <div class="col-md-6 col-lg-6">
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

                    <div class="col-md-6 col-lg-6">
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
                    <div class="col-md-12 col-lg-12">
                        <button type="button" class="btn btn-success btn-block" style="margin-top: 25px;" onclick="searchOrders()">ตกลง</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-9">
        <div id="result"></div>
    </div>
</div>
<script type="text/javascript">
    searchOrders();
    $(document).ready(function(){
        $("#datestart,#dateend").removeClass('ct-form-control');
        $("#datestart,#dateend").addClass('form-control');
    });
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
