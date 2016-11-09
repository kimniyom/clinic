<style type="text/css">
    #font-18{color: #999999;}
</style>
<?php
echo $chartmonth;
echo $chartvisit;
echo $charttype;
?>

<?php
$this->breadcrumbs = array(
    $user['name'] . ' ' . $user['lname']
);
$config = new Configweb_model();
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-user"></i> ID <?php echo $user['pid'] ?>
    </div>
    <div class="row" style="margin:0px;">
        <div class="col-md-3 col-lg-3" style="text-align: center;">
            <?php
            if (!empty($user['images'])) {
                $img_profile = "uploads/profile/" . $user['images'];
            } else {
                if ($user['sex'] == 'ชาย') {
                    $img_profile = "images/Big-user-icon.png";
                } else if ($user['sex'] == 'หญิง') {
                    $img_profile = "images/Big-user-icon-female.png";
                } else {
                    $img_profile = "images/Big-user.png";
                }
            }
            ?>
            <center>
                <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_profile; ?>" class="img-responsive img-thumbnail" id="img_profile" style=" margin-top: 5px; max-height: 200px;"/>
                <br/><br/>
                <div class="well" style="border-radius:0px; text-align: left; padding-left: 30px; padding-bottom: 0px;">
                    <input type="file" name="file_upload" id="file_upload" />
                    <p id="font-16" style=" color: #ff0000; text-align: center; margin-bottom: 0px;">(ไม่เกิน 2MB)</p>
                </div>
            </center>
            <div id="font-18" style="color: #ff6600;">
                <font id="font-rsu-20" style=" color: #000020;"><?php echo $user['alias']; ?></font><br/>
                เป็นสมาชิกเมื่อ <br/><?php echo $config->thaidate($user['create_date']); ?>
            </div>
        </div>
        <div class="col-md-9 col-lg-9" style="padding-right: 0px;">
            <div class="well" style="margin: 5px; background: none;" id="font-20">
                <div class="btn btn-default btn-sm pull-right" id="font-rsu-14" onclick="popup_edit_profile();">แก้ไขข้อมูล</div>
                ชื่อ - สกุล <p class="label" id="font-18"><?php echo $user['name'] . ' ' . $user['lname'] ?></p><br/>
                นามแฝง <p class="label" id="font-18"><?php
                    if (isset($user['alias'])) {
                        echo $user['alias'];
                    } else {
                        echo "-";
                    }
                    ?></p><br/>
                เพศ <p class="label" id="font-18"><?php
                    if (isset($user['sex'])) {
                        echo $user['sex'];
                    } else {
                        echo "-";
                    }
                    ?></p><br/>
                อายุ <p class="label" id="font-18"><?php
                    if (isset($user['birth'])) {
                        echo $config->get_age($user['birth']);
                    } else {
                        echo "-";
                    }
                    ?></p> ปี<br/>
                อีเมล์ <p class="label" id="font-18"><?php
                    if (isset($user['email'])) {
                        echo $user['email'];
                    } else {
                        echo "-";
                    }
                    ?></p><br/>

                เบอร์โทรศัพท์ <p class="label" id="font-18"><?php
                    if (isset($user['tel'])) {
                        echo $user['tel'];
                    } else {
                        echo "-";
                    }
                    ?></p><br/><br/>

                ที่อยู่ <br/>
                <div class="btn btn-default btn-sm pull-right" id="font-rsu-14" onclick="edit_address_profile();">แก้ไขที่อยู่</div>
                <ul style=" padding-top: 5px;">
                    <?php
                    echo "<li>เลขที่ ";
                    if (isset($user['number'])) {
                        echo ($user['number']);
                    } else {
                        echo "-";
                    } "</li>";
                    echo "<li>อาคาร ";
                    if (isset($user['building'])) {
                        echo ($user['building']);
                    } else {
                        echo "-";
                    } "</li>";
                    echo "<li>ชั้น ";
                    if (isset($user['class'])) {
                        echo ($user['class']);
                    } else {
                        echo "-";
                    }
                    echo " ห้อง ";
                    if (isset($user['room'])) {
                        echo ($user['room']);
                    } else {
                        echo "-";
                    } "</li>";
                    echo "<li>ต. ";
                    if (isset($user['tambon_name'])) {
                        echo ($user['tambon_name']);
                    } else {
                        echo "-";
                    }
                    echo " &nbsp;&nbsp;อ. ";
                    if (isset($user['ampur_name'])) {
                        echo ($user['ampur_name']);
                    } else {
                        echo "-";
                    }
                    echo " &nbsp;&nbsp;จ. ";
                    if (isset($user['changwat_name'])) {
                        echo ($user['changwat_name']);
                    } else {
                        echo "-";
                    } "</li>";
                    echo "<li>รหัสไปรษณีย์ ";
                    if (isset($user['zipcode'])) {
                        echo ($user['zipcode']);
                    } else {
                        echo "-";
                    } "</li>";
                    ?>
                </ul>
            </div>
        </div>

    </div>

    <div class="panel panel-default" style=" margin: 5px;">
        <div class="panel-heading">
            <i class="fa fa-list-alt"></i> ประวัติการซื้อสินค้า(ไม่รวมค่าจัดส่ง)
        </div>
        <?php if (!empty($order)) { ?>
            <table class="table" id="font-20">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="text-align: center;">ดูสินค้า</th>
                        <th>รหัสการสั่ง</th>
                        <th style="text-align: center;">วันที่</th>
                        <th style="text-align: center;">จำนวน</th>
                        <th style="text-align: right;">ราคารวม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $sumprice = 0;
                    foreach ($order as $orders):
                        $i++;
                        $sumprice = $sumprice + $orders['price_total'];
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td style=" text-align: center;">
                                <div class="btn btn-info btn-xs" onclick="Get_list_basket('<?php echo $orders['order_id'] ?>');"><i class="fa fa-eye"></i></div>
                            </td>
                            <td><?php echo $orders['order_id']; ?></td>
                            <td style="text-align: center;"><?php echo $config->thaidate($orders['order_date']); ?></td>
                            <td style="text-align: center;"><?php echo $orders['product_total']; ?></td>
                            <td style="text-align: right; background: #eaeaea; color: #ff0000;"><?php echo number_format($orders['price_total'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align:center; background: #eaeaea;"><label>รวม</label></td>
                        <td style="text-align:right; background: #999999; color: #ffff00;"><label><?php echo number_format($sumprice, 2); ?></label></td>
                    </tr>
                </tfoot>
            </table>
        <?php } else { ?>
            <center>ยังไม่มีการสั่งซื้อ</center>
        <?php } ?>
    </div>

    <div class="panel panel-default" style=" margin: 5px;">
        <div class="panel-heading"><i class="fa fa-bars"></i> การซื้อในแต่ละเดือนที่ผ่านมา</div>
        <div class="row" style="margin:0px;">
            <div class="col-lg-6 col-md-6">
                <div id="chart-month"></div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div id="chart-month-visit"></div>
            </div>
        </div>
    </div>

    <div class="panel panel-default" style=" margin: 5px;">
        <div class="panel-heading"><i class="fa fa-bars"></i> การซื้อในแต่ละประเภท</div>
        <div id="chart-type"></div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#file_upload').uploadify({
            'buttonText': 'เลือกรูปภาพ ...',
            //'swf ': '<?//php echo Yii::app()->baseUrl; ?>/assets/uploadify/uploadify.swf',
            'sef': '<?php echo Yii::app()->getRequest()->serverName . "/shopping_cart/assets/uploadify/uploadify.swf?preventswfcaching=1442560451655"; ?>',
            'uploader': '<?php echo Yii::app()->createUrl('frontend/user/save_upload', array('pid' => $user['pid'])) ?>',
            'auto': true,
            'fileSizeLimit': '2MB',
            'fileTypeExts': ' *.jpg; *.png',
            'uploadLimit': 1,
            'onUploadSuccess': function (data) {
                window.location.reload();
            }
        });
    });

    function Get_list_basket(order_id) {
        $("#h_order").text(order_id);
        var url = "<?php echo Yii::app()->createUrl('frontend/orders/get_list_basket') ?>";
        var data = {order_id: order_id};
        $.post(url, data, function (result) {
            $("#basket").html(result);
            $("#popup_basket").modal();
        });
    }

    function upload_profile(pid) {
        var url = "<?php echo Yii::app()->createUrl('frontend/user/upload_profile') ?>";
        var data = {pid: pid};
        $.post(url, data, function (result) {
            $("#upload_profile").html(result);
            $("#popup_upload").modal();
        });
    }

    function edit_address_profile() {
        $("#show_address").html("<center><i class=\"fa fa-spinner fa-spin\"></i></center>");
        var url = "<?php echo Yii::app()->createUrl('frontend/user/get_address_profile') ?>";
        var pid = "<?php echo Yii::app()->session['pid'] ?>";
        var data = {pid: pid};
        $.post(url, data, function (result) {
            $("#edit_address_profile").modal();
            $("#show_address_profile").html(result);
        });
    }

    function popup_edit_profile() {
        $("#update_profile").html("<center><i class=\"fa fa-spinner fa-spin\"></i></center>");
        var url = "<?php echo Yii::app()->createUrl('frontend/user/update') ?>";
        var pid = "<?php echo Yii::app()->session['pid'] ?>";
        var data = {pid: pid};
        $.post(url, data, function (result) {
            $("#popup_update_profile").modal();
            $("#update_profile").html(result);
        });
    }
</script>
