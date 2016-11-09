
<?php
$this->breadcrumbs = array(
    "ตรวจสอบยอดเงิน"
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <font id="font-rsu-18" style="color: #ff3300">
        <img src="<?php echo Yii::app()->baseUrl; ?>/images/search-b-icon.png"/>
        รอตรวจสอบยอดเงิน</font>
    </div>
    <div class="panel-body">
        <?php
        $i = 0;
        $web = new Configweb_model();
        foreach ($order as $rs): $i++;
            ?>
            <div class="list-group" id="font-22">
                <a class="list-group-item">
                    <h4 class="list-group-item-heading" id="font-20">
                        #<?php echo $rs['order_id']; ?>
                        สั่งซื้อวันที่ <?php echo $web->thaidate($rs['order_date']); ?>
                    </h4>
                    <p class="list-group-item-text">
                        <button type="button" class="btn pull-right" id="font-22"
                                style=" margin-top: 10px; color: #FFFFFF;"
                                onclick="get_detail_order('<?php echo $rs['order_id'] ?>')">
                            <i class="fa fa-check-circle-o"></i>
                            ตรวจสอบรายการนี้
                        </button>
                        ผู้สั่งซื้อ <?php echo $rs['name'] . ' ' . $rs['lname']; ?><br/>
                        จำนวน <?php echo $rs['PRODUCT_TOTAL']; ?> รายการ<br/>
                        <label class="badge" id="font-rsu-18">ราคารวม <?php echo number_format($rs['PRICE_TOTAL'], 2); ?> บาท </label><br/>
                        หลักฐาน <?php if (!empty($rs['slip'])) { ?>
                            <i class="fa fa-check" style="color: #00ff00;"></i>
                        <?php } else { ?>
                            <i class="fa fa-remove" style="color:red;"></i>
                        <?php } ?>
                        วันที่แจ้งชำระ <?php echo $web->thaidate($rs['date_payment']) . ' ' . $rs['time_payment'] ?> 
                        <label class="badge" id="font-rsu-18">ยอด <?php echo number_format($rs['money'], 2); ?> บาท </label>
                    </p>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- POPUP -->
<div class="modal fade" id="popup_detail_order">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ตรวจสอบรายการแจ้งชำระ</h4>
            </div>
            <div class="modal-body" id="show_detail_order"></div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    function get_detail_order(order_id) {
        $("#show_detail_order").html("<br/><center><i class=\"fa fa-refresh fa-spin fa-2x\"></i></center>");
        var url = "<?php echo Yii::app()->createUrl('backend/orders/get_detail_order') ?>";
        var data = {order_id: order_id};

        $.post(url, data, function (result) {
            $("#popup_detail_order").modal();
            $("#show_detail_order").html(result);
        });
    }
</script>
