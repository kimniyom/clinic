<style type="text/css">
    #del{ cursor:pointer;}
</style>
<script>
    $(document).ready(function () {
        load_address();
        load_order();
    });

    function load_address() {
        var url = "<?php echo Yii::app()->createUrl('frontend/user/address') ?>";
        var pid = "<?php echo Yii::app()->session['pid'] ?>";
        var data = {pid: pid};
        $.post(url, data, function (result) {
            $("#address_user").html(result);
        });
    }
</script>

<script type="text/javascript">
    function del_list_order(id) {
        var r = confirm("คุณแน่ใจหรือไม่ที่จะลบรายการนี้ ...?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('frontend/orders/del_list_order') ?>";
            var data = {id: id};

            $.post(url, data, function (success) {
                load_order();
                load_cart_list();
                load_box_cart();
            }
            );// endpost
        }
    }

    function load_order() {
        $("#order_list_load").html("<center><i class=\"fa fa-spinner fa-spin\"></i></center>");
        var url = "<?php echo Yii::app()->createUrl('frontend/orders/order_list_load') ?>";
        var order_id = "<?php echo $order_id ?>";
        var data = {order_id: order_id};

        $.post(url, data, function (result) {
            $("#order_list_load").html(result);
        });// endpost
    }
    function set_active_transport(id, order_id) {
        $("#order_list_load").html("<center><i class=\"fa fa-spinner fa-spin\"></i></center>");
        var url = "<?php echo Yii::app()->createUrl('frontend/orders/set_active_transport') ?>";
        var data = {id: id, order_id: order_id};

        $.post(url, data, function (result) {
            load_order();
        });// endpost
    }
</script>

<?php
$this->breadcrumbs = array(
    "รายการสินค้า",
);
?>

<br/>
<div style="color: #ff3300;" id="font-rsu-18">
    *โปรดตรวจสอบรายการสินค้าและที่อยู่ของคุณให้ชัดเจน จากนั้นกดปุ่ม "ยืนยันการสั่งซื้อสินค้า"
</div>
<br/>
<div class=" panel panel-default">
    <div class=" panel-heading">
        <i class="fa fa-cart-plus"></i> รายการสินค้าของคุณ
    </div>
    <div class=" panel-body" id="order_list_load">

    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-train"></i>
        ข้อมูลที่อยู่จัดส่ง (กรุณาตรวจสอบความถูกต้อง)
    </div>
    <div class="panel-body">
        <div id="address_user"></div>
    </div>
    <div class="panel-footer">
        <?php
        $user = new User();
        $confirm = $user->Check_address_true(Yii::app()->session['pid']);
        if (!empty($confirm)) {
            ?>
            <center>
                <?php if ($count > 0) { ?>
                    <a href="<?= Yii::app()->createUrl('frontend/orders/payments', array('order_id' => $order_id)) ?>">
                        <div class="btn btn-success">ยืนยันการสั่งซื้อสินค้า
                            <i class="glyphicon glyphicon-share-alt"></i>
                        </div>
                    </a>
                <?php } else { ?>
                    <center>
                        <i class="fa fa-warning"></i> ไม่มีสินค้าในรายการสั่งซื้อนี้
                    </center>
                <?php } ?>
            </center>
        <?php } else { ?>
            <center>
                <i class="fa fa-warning"></i> ข้อมูลที่อยู่ไม่ครบถ้วนกรุณาตรวจสอบ
            </center>
        <?php } ?>

    </div>
</div>
