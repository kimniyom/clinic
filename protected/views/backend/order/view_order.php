<style type="text/css">
    #label-bold{padding:5px; font-weight: bold;}
</style>

<?php $web = new Configweb_model();?>
<div class="well">
    <div class="row">
            <div class="col-lg-9 col-md-9">
                <h4 class="list-group-item-heading" id="font-rsu-20">
                    #<?php echo $order['order_id']; ?><br/>
                    วันที่ <?php echo $web->thaidate($order['order_date']); ?>
                </h4>
                <p class="list-group-item-text">
                    ผู้สั่งซื้อ <?php echo $order['name'] . ' ' . $order['lname']; ?><br/>
                    เบอร์โทรศัพทธ์ <?php echo $order['tel'] ?><br/>
                    จำนวน <?php echo $order['PRODUCT_TOTAL']; ?> รายการ<br/>
                    <label class="alert alert-danger" id="label-bold">
                        ราคารวม <?php echo number_format($order['PRICE_TOTAL'], 2); ?> บาท 
                    </label><br/>

                    ข้อความ <?php echo $order['msg'] ?><br/>
                    </p>
                    <br/>
                    <p class="list-group-item-text">
                        วันที่โอนเงิน <?php echo $web->thaidate($order['date_payment']); ?>
                        เวลา <?php echo $order['time_payment'] ?> <br/>
                        ธนาคาร <?php echo $order['bank_name'] ?> </br>
                        สาขา <?php echo $order['bank_branch'] ?><br/>
                        <label class="alert alert-danger" id="label-bold">
                            จำนวนเงินที่โอน <?php echo number_format($order['money'],2) ?> บาท
                        </label>
                    </p>
            </div>
            <div class="col-lg-3 col-md-3" style='text-align:center;'>
                <center>
                <img src="<?php echo Yii::app()->baseUrl;?>/uploads/slip/<?php echo $order['slip']?>" 
                class="img-resize img-responsive img-thumbnail">
                </center>
                <a href="javascript:show_slip('<?php echo $order['slip']?>');" class="btn">
                    <i class='fa fa-search-plus fa-2x'></i>
                </a>
            </div>
    </div>
</div>

<h4>รายการสั่งซื้อ</h4>
<table width="100%" class="table table-bordered">
    <thead>
        <tr>
            <td>#</td>
            <td>รูป</td>
            <td>ชื่อสินค้า</td>
            <td style="text-align: center;">ราคา</td>
            <td style="text-align: center;">จำนวน</td>
            <td style="text-align: center;">ราคารวม</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $totalall = 0;
        $i = 1;
        $product_model = new Product();
        foreach ($basket as $products):
            $img = $product_model->get_last_img($products['product_id']);
            ?>
            <tr>
                <td><?= $i++ ?></td>
                <td style=" width: 10%;">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/<?php echo $img; ?>" class="img-resize img-thumbnail" width="100%"/>
                </td>
                <td><?= $products['product_name']; ?></td>
                <td style=" text-align: right;"><?= number_format($products['product_price']); ?></td>
                <td style="text-align: center;"><?= $products['product_num']; ?></td>
                <td style="text-align: right;"><?= number_format(($products['product_price'] * $products['product_num']), 2); ?></td>
                <?php
                $total = (($products['product_price'] * $products['product_num']));
                $totalall = $totalall + $total;
                ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr style="color:#ff3300;">
            <td colspan="5" align="center"><font style="text-decoration:underline;">รวมค่าสินค้า </font></td>
            <td style=" text-align: right;"><font style="text-decoration:underline;"><?= number_format($totalall, 2) ?></font> </td>
        </tr>
    </tfoot>
</table>

<script type="text/javascript">
    function show_slip(slip){
        var url = "<?php echo Yii::app()->baseUrl;?>/uploads/slip/" + slip;
        var img = "<a href='javascript:close_popup()' class='pull-right'><i class='fa fa-remove fa-2x' style='color:red;'>"
                    + "</i></a/><br/><img src='" + url + "'class='img-resize img-thumbnail' width='100%'/>";

        $("#overlay_popup").fadeIn();
        $("#show_slip").html(img);
    }

    function close_popup(){
        $('#overlay_popup').fadeOut();
    }

    function confirm_order(){
        var url = "<?php echo Yii::app()->createUrl('backend/orders/confirm_order')?>";
        var order_id = "<?php echo $order['order_id']?>";
        var data = {order_id: order_id};

        $.post(url,data,function(success){
            window.location.reload();
        });
    }
</script>
