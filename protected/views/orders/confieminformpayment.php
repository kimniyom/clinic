<script type="text/javascript">
    $(document).ready(function () {
        $('#file_upload').uploadify({
            'buttonText': 'เลือกไฟล์ ...',
            'swf ': '<?php echo Yii::app()->baseUrl; ?>/assets/uploadify/uploadify.swf',
            'uploader': '<?php echo Yii::app()->createUrl('frontend/orders/uploadslip', array('order_id' => $order_id)) ?>',
            'auto': false,
            'fileSizeLimit': '1024KB',
            'fileTypeExts': ' *.jpg; *.png',
            'uploadLimit': 1,
            'onSelect': function (file) {
                $("#slip").val(file.name);
                //alert('The file ' + file.name + ' was added to the queue.');
            },
            'onCancel': function (file) {
                $("#slip").val("");
            }
        });
    });

    function set_bank(bank_id) {
        $("#bank_id").val(bank_id);
    }

    function check_form() {
        var url = "<?php echo Yii::app()->createUrl('frontend/orders/save_payment') ?>";
        var order_id = "<?php echo $order_id ?>";
        var payment_id = $("#bank_id").val();
        var year = $("#year").val();
        var month = $("#month").val();
        var day = $("#day").val();
        var hour = $("#hour").val();
        var minute = $("#minute").val();
        var money = $("#money").val();
        var date_payment = year + "-" + month + "-" + day;
        var time_payment = hour + ":" + minute;
        var slip = $("#slip").val();
        var message_order = $("#message_order").val();
        var data = {
            order_id: order_id,
            payment_id: payment_id,
            money: money,
            date_payment: date_payment,
            time_payment: time_payment,
            slip: slip,
            message_order: message_order
        };
        if (payment_id == '' || date_payment == '' || hour == '' || minute == '' || money == '' || slip == '') {
            alert("กรอกข้อมูลไม่ครบ");
            return false();
        }

        $.post(url, data, function (success) {
            $('#file_upload').uploadify('upload', '*');
            alert("ระบบได้รับแจ้งการชำระเงินของท่านแล้ว ขอบคุณที่ใช้บริการของเราค่ะ");
            window.location = "<?php echo Yii::app()->createUrl('frontend/orders/verify') ?>";
        });
    }
</script>

<?php
$this->breadcrumbs = array(
    "รอชำระเงิน" => Yii::app()->createUrl('frontend/orders/informpayment'),
    "แจ้งชำระเงิน"
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        แจ้งชำระเงินรหัสสั่งซื้อ (<?php echo $order_id; ?>)
    </div>
    <table class="table table-striped" id="font-20">
        <tr>
            <td style=" width: 30%; padding-top: 10%;">บัญชีที่โอน*</td>
            <td>
                <input type="hidden" id="bank_id" name="bank_id"/>
                <table class="table table-bordered" id="font-18" style=" background: none; margin-bottom: 0px;">
                    <tbody>
                        <?php
                        foreach ($bank as $banks):
                            ?>
                            <tr>
                                <td style="text-align: center;">
                                    <div class="radio radio-warning" style=" margin: 0px;">
                                        <input id="bank" name="bank" class="styled" type="radio"  onclick="set_bank('<?php echo $banks['id'] ?>');">
                                        <label for="radio"></label>
                                    </div>  
                                </td>
                                <td style=" width: 8%;">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/<?php echo $banks['bank_img']; ?>" class="img-resize img-thumbnail" width="100%"/>
                                </td>
                                <td><?= $banks['bank_name']; ?></td>
                                <td style="text-align: center;"><?= $banks['bookbank_number']; ?></td>
                                <td>สาขา <?= $banks['bank_branch']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>วันที่ชำระเงิน*</td>
            <td>
                <div class="col-lg-4" style=" margin-left: 0px; padding-left: 0px;">
                    <select id="day" name="day" class="form-control input-sm">
                        <?php
                        $daynow = date("d");
                        for ($i = 1; $i <= 31; $i++):
                            if (strlen($i) < 2) {
                                $day = "0" . $i;
                            } else {
                                $day = $i;
                            }
                            ?>
                            <option value="<?php echo $day; ?>" <?php
                            if ((int) $day == (int) $daynow) {
                                echo "selected";
                            }
                            ?>>
                                        <?php echo $day; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-lg-4">
                    <select id="month" name="month" class="form-control input-sm">
                        <?php
                        $web = new Configweb_model();
                        $monthname = $web->MonthFullArray();
                        $monthnow = date("m");
                        for ($i = 1; $i <= 12; $i++):
                            if (strlen($i) < 2) {
                                $month = "0" . $i;
                            } else {
                                $month = $i;
                            }
                            ?>
                            <option value="<?php echo $month; ?>" <?php
                            if ((int) $month == (int) $monthnow) {
                                echo "selected";
                            }
                            ?>>
                                        <?php echo $monthname[$i]; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-lg-4">
                    <select id="year" name="year" class="form-control input-sm">
                        <?php
                        $Yearnow = date("Y");
                        for ($i = $Yearnow; $i >= $Yearnow - 0; $i--):
                            ?>
                            <option value="<?php echo $i; ?>" <?php
                            if ($i == $Yearnow) {
                                echo "selected";
                            }
                            ?>>
                                        <?php echo ($i + 543); ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <td>เวลา(โดยประมาณ)*</td>
            <td>

                <div class="col-lg-4" style=" margin-left: 0px; padding-left: 0px;">
                    <select id="hour" name="hour" class="form-control input-sm">
                        <option value="">== ชั่วโมง ==</option>
                        <?php
                        $Hnow = date("H");
                        for ($i = 0; $i <= 24; $i++):
                            if (strlen($i) < 2) {
                                $H = "0" . $i;
                            } else {
                                $H = $i;
                            }
                            ?>
                            <option value="<?php echo $H; ?>">
                                <?php echo $H; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-lg-4">
                    <select id="minute" name="minute" class="form-control input-sm">
                        <option value="">== นาที ==</option>
                        <?php
                        $Minitnow = date("i");
                        for ($i = 0; $i <= 59; $i++):
                            if (strlen($i) < 2) {
                                $Minit = "0" . $i;
                            } else {
                                $Minit = $i;
                            }
                            ?>
                            <option value="<?php echo $Minit; ?>">
                                <?php echo $Minit; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-lg-4"></div>

            </td>
        </tr>
        <tr>
            <td>จำนวนเงิน*</td>
            <td>
                <div class="col-lg-6" style=" margin-left: 0px; padding-left: 0px;">
                    <input type="text" id="money" name="money" class="form-control input-sm" onkeypress="return chkNumber();"/>
                </div>
            </td>
        </tr>
        <tr>
            <td>หลักฐานการโอน*</td>
            <td>
                <input type="hidden" id="slip" name="slip" />
                <div class="col-lg-12" style=" margin-left: 0px; padding-left: 0px;">
                    <input type="file" name="file_upload" id="file_upload" />
                    (ไฟล์นามสกุล jpg,png ไม่เกิน 1MB)
                </div>
            </td>
        </tr>
        <tr>
            <td>ข้อความ</td>
            <td>
                <div class="col-lg-12" style=" margin-left: 0px; padding-left: 0px;">
                    <textarea id="message_order" name="message_order" class="form-control" rows="5"></textarea>
                </div>
            </td>
        </tr>
    </table>

    <div class="panel-footer">
        <center>
            <div class="btn btn-success" onclick="check_form()"><i class="fa fa-save"></i> ยืนยันการชำระเงิน</div>
        </center>
    </div>
</div>



