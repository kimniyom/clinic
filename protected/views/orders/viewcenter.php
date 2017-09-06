<style type="text/css" media="print">
    #tablelistorder tr th{
        background-color: #000000;
    }

</style>

<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs = array(
    'Orders' => array('index', 'branch' => $order['branch']),
    $order['order_id'],
);
$companySell = Companycenter::model()->find("id = '1'");
$Thaibath = new Thaibaht();
$order_id = $order['order_id'];
$ItemModel = new CenterStockitem();
?>


<!--
    ##### POPUP ListORder ######
-->
<div class="modal fade" tabindex="-1" role="dialog" id="popuporderlist">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">วัตถุดิบที่ต้องใช้</h4>
            </div>
            <div class="modal-body">
                <table class="table  table-striped table-bordered" style=" margin-top: 10px;">
                    <thead>
                        <tr>
                            <th>วัตถุดิบ</th>
                            <th style=" text-align: center;">จำนวน</th>
                            <?php if ($order['status'] == '0') { ?>
                                <th>คงเหลือ</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sum = 0;
                        $a = 0;
                        foreach ($items as $rx):
                            $a++;
                            $temtotal = $ItemModel->Gettotalitem($rx['itemid']);
                            if ($temtotal >= $rx['number']) {
                                $sum = $sum + 1;
                                $icon = "<i class='fa fa-check text-success'></i>";
                            } else {
                                $sum = 0;
                                $icon = "<i class='fa fa-remove text-danger'></i>";
                            }
                            ?>
                            <tr>
                                <td><?php echo $rx['itemname'] ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rx['number']) ?> <?php echo $rx['unit'] ?></td>
                                <?php if ($order['status'] == '0') { ?>
                                    <td style=" text-align: right;"><?php echo number_format($temtotal) ?> <?php echo $rx['unit'] ?> <?php echo $icon ?></td>
                                <?php } ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php if ($order['status'] == '0') { ?>
                <div class="modal-footer">
                    <?php if ($sum == $a) { ?>
                        <button type="button" class="btn btn-success" onclick="Confirmorder('<?php echo $order_id ?>')">
                            <i class="fa fa-play"></i> 
                            ยืนยันการผลิต
                        </button>
                    <?php } else { ?>
                        <h4 style=" color: #ff0000;"><i class="fa fa-warning text-warning"></i> วัตถุดิบไม่เพียงพอ</h4>
                    <?php } ?>
                </div>
            <?php } ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--
    ##### ENDPOPUP  ListORder ######
-->
<div

    <div class="row">
        <div class="col-lg-9 col-md-12">
            <a href="<?php echo Yii::app()->createUrl('orders/print', array("order_id" => $order_id)) ?>" target="_blank">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-print"></i> พิมพ์ใบสั่งซื้อ
                </button>
            </a>
            <a href="<?php echo Yii::app()->createUrl('orders/bill', array("order_id" => $order_id)) ?>" target="_blank">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-print"></i> พิมพ์ใบส่งของ
                </button>
            </a>

            <button type="button" class="btn btn-default" onclick="checkitem()">
                <i class="fa fa-check"></i> วัตถุดิบที่ต้องใช้ 
            </button>

            <div class="dropdown" style=" float: left; margin-right: 5px;">
                <button class="btn btn-default dropdown-toggle" type="button" id="btnstatus" data-toggle="dropdown">
                    อัพเดทสถานะ
                    <span class="caret"></span>
                </button>

                <?php if ($order['status'] == '0' || $order['status'] == '1') { ?>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <?php if ($order['status'] == '0') { ?>
                            <li><a href="javascript:checkitem()">ยืนยันการผลิต</a></li>
                        <?php } ?>
                        <?php if ($order['status'] == '1') { ?>
                            <li><a href="javascript:updatestatus('2')">ส่งสินค้า</a></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
            <div id="boxordersss">
                <div class="well" style=" border-radius: 0px; background: #FFFFFF; position: relative; max-width: 768px;" id="boxorders">
                    <div style=" text-align: center; margin-bottom: 10px;">
                        <h4 style=" margin-bottom: 0px;"><?php echo $BranchModel['branchname']; ?></h4><br/>
                        <?php echo $BranchModel['address']; ?><br/>
                        <?php echo $BranchModel['contact']; ?><br/>
                        <h4 style=" margin: 0px;">ใบสั่งซื้อสินค้า</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <div>
                                <table id="companysell" style=" width: 100%; border: #cccccc solid 2px;">
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
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div style=" padding: 0px;height: 100px; width: 200px;">
                                <table style="border: #cccccc solid 2px; float: right; width: 100%;">
                                    <tr style=" border-bottom: #cccccc solid 2px;">

                                        <td style=" text-align: center;" colspan="2">
                                            รหัสสั่งซื้อเลขที่ :
                                            <div style="text-align: center; margin-left: 10px;" id="<?php echo $order['order_id'] ?>"></div>
                                            <?php
                                            //echo $order['order_id'];

                                            $optionsArray = array(
                                                'elementId' => $order['order_id'], /* id of div or canvas */
                                                'value' => $order['order_id'], /* value for EAN 13 be careful to set right values for each barcode type */
                                                'type' => 'code39', /* supported types  ean8, ean13, upc, std25, int25, code11, code39, code93, code128, codabar, msi, datamatrix */
                                                'settings' => array(
                                                    /* "1" Bars color */
                                                    'barWidth' => "1",
                                                    'barHeight' => "20",
                                                ),
                                            );
                                            $this->widget('ext.Yii-Barcode-Generator.Barcode', $optionsArray);
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>วันที่สั่งซื้อ : </td>
                                        <td style=" text-align: right;"><?php echo $order['create_date'] ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div>
                        <label>ชื่อผู้ติดต่อ</label> <?php echo $BranchModel['menagers'] ?> 
                        <label>โทรศัพท์</label> <?php echo $BranchModel['telmenager'] ?>
                    </div>


                    <table style=" width: 100%; border: #cccccc solid 2px;" class="" id="tablelistorder">
                        <thead>
                            <tr>
                                <th style="border-bottom: #cccccc solid 2px;background-color: #f4f4f4;">#</th>
                                <th style="border-left:#cccccc solid 2px; border-bottom: #cccccc solid 2px; background-color: #f4f4f4; -webkit-print-color-adjust: exact; ">รหัสสินค้า</th>
                                <th style="border-left:#cccccc solid 2px; border-bottom: #cccccc solid 2px; background: #f4f4f4;">ชื่อทางการตลาด</th>
                                <th style="border-left:#cccccc solid 2px; border-bottom: #cccccc solid 2px; background: #f4f4f4;">สินค้า</th>
                                <th style="text-align: center;border-left:#cccccc solid 2px; border-bottom: #cccccc solid 2px;background: #f4f4f4;">จำนวน</th>
                                <th style="text-align: center;border-left:#cccccc solid 2px; border-bottom: #cccccc solid 2px;background: #f4f4f4;">หน่วยนับ</th>
                                <th style="text-align: center;border-left:#cccccc solid 2px; border-bottom: #cccccc solid 2px;background: #f4f4f4;">ราคา/หน่วย</th>
                                <th style="text-align: center;border-left:#cccccc solid 2px; border-bottom: #cccccc solid 2px;background: #f4f4f4;">ส่วนลด</th>
                                <th style="text-align: center;border-left:#cccccc solid 2px; border-bottom: #cccccc solid 2px;background: #f4f4f4;">จำนวนเงิน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sumdistcount = 0;
                            $sumproduct = 0;
                            $i = 0;
                            foreach ($orderlist as $rs):
                                $i++;
                                $sumrow = ($rs['costs'] * $rs['number']);
                                $sumproduct = ($sumproduct + $sumrow);
                                $sumdistcount = ($sumdistcount + $rs['distcountprice']);
                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td style="border-left:#cccccc solid 2px;"><?php echo $rs['product_id'] ?></td>
                                    <td style="border-left:#cccccc solid 2px;"><?php echo $rs['product_nameclinic'] ?></td>
                                    <td style="border-left:#cccccc solid 2px;"><?php echo $rs['product_name'] ?></td>
                                    <td style=" text-align: center;border-left:#cccccc solid 2px;"><?php echo number_format($rs['number']) ?></td>
                                    <td style=" text-align: center;border-left:#cccccc solid 2px;"><?php echo $rs['unitname'] ?></td>
                                    <td style=" text-align: right;border-left:#cccccc solid 2px;"><?php echo number_format($rs['costs'], 2) ?></td>
                                    <td style=" text-align: center;border-left:#cccccc solid 2px;"><?php echo $rs['distcountpercent'] ?> % </td>
                                    <td style=" text-align: right;border-left:#cccccc solid 2px;"><?php echo number_format($sumrow, 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr style="border-top: #cccccc solid 2px;">
                                <td colspan="6" rowspan="5" id="bold-right" valign="top" style=" border-right:#cccccc solid 2px; border-bottom: #cccccc solid 2px;">
                                    หมายเหตุ
                                </td>
                            </tr>
                            <tr>
                                <td style="border-bottom: #cccccc solid 2px; background: #f4f4f4; border-top: #cccccc solid 2px;" colspan="2">รวมเงิน</td>
                                <td style=" text-align: right;border-left:#cccccc solid 2px; border-bottom: #cccccc solid 2px; background: #f4f4f4; border-top: #cccccc solid 2px;"><?php echo number_format($sumproduct, 2) ?></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: #cccccc solid 2px; background: #f4f4f4;" colspan="2">ส่วนลดคิดเป็นเงิน</td>
                                <td style=" text-align: right;border-left:#cccccc solid 2px; border-bottom: #cccccc solid 2px; background: #f4f4f4;"><?php echo number_format($sumdistcount, 2) ?></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: #cccccc solid 2px; background: #f4f4f4;" colspan="2">ราคาหลังหักส่วนลด</td>
                                <td style=" text-align: right;border-left:#cccccc solid 2px; border-bottom: #cccccc solid 2px; background: #f4f4f4;">
                                    <?php
                                    $priceresult = ($sumproduct - $sumdistcount);
                                    echo number_format($priceresult, 2);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-bottom: #cccccc solid 2px;background: #f4f4f4;" colspan="2">ภาษี 7%</td>
                                <td style=" text-align: right;border-left:#cccccc solid 2px; border-bottom: #cccccc solid 2px;background: #f4f4f4;">
                                    <?php
                                    $tax = ($priceresult * 7) / 100;
                                    $taxresult = number_format($tax, 2);
                                    echo $taxresult;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" style=" text-align: center;border-right:#cccccc solid 2px; background: #f4f4f4;">
                                    <?php
                                    $pricetotal = ($priceresult + $tax);
                                    echo "(" . $Thaibath->convert($pricetotal) . ")";
                                    ?>
                                </td>
                                <td colspan="2" style="background: #f4f4f4;">รวมเงินทั้งสิ้น</td>
                                <td style=" text-align: right;border-left:#cccccc solid 2px; border-bottom: #cccccc solid 2px; background: #f4f4f4;"><?php echo number_format(sprintf('%.2f', $pricetotal), 2); ?></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
            <h4>สถานะ</h4>
            <div class="well" style=" text-align: center; text-align: left; background: #FFFFFF;">
                <?php if ($order['status'] == '1') { ?>
                    <h4><i class="fa fa-check text-success"></i> ยืนยันรายการ</h4>
                    <h4><i class="fa fa-remove text-danger"></i> จัดส่งสินค้า</h4>
                    <h4><i class="fa fa-remove text-danger"></i> สินค้าถึงผู้รับ</h4>
                <?php } else if ($order['status'] == '2') { ?>
                    <h4><i class="fa fa-check text-success"></i> ยืนยันรายการ</h4>
                    <h4><i class="fa fa-check text-success"></i> จัดส่งสินค้า</h4>
                    <h4><i class="fa fa-remove text-danger"></i> สินค้าถึงผู้รับ</h4>
                <?php } else if ($order['status'] == '3') { ?>
                    <h4><i class="fa fa-check text-success"></i> ยืนยันรายการ</h4>
                    <h4><i class="fa fa-check text-success"></i> จัดส่งสินค้า</h4>
                    <h4><i class="fa fa-check text-success"></i> สินค้าถึงผู้รับ</h4>
                <?php } ?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            var status = "<?php echo $order['status'] ?>";
            if (status == '2' || status == '3') {
                $("#btnstatus").removeClass("btn btn-default dropdown-toggle");
                $("#btnstatus").addClass("btn btn-default dropdown-toggle disabled");
            }
        });

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }

        function Confirmorder(order_id) {
            var url = "<?php echo Yii::app()->createUrl('orders/confirmorder') ?>";
            var data = {order_id: order_id};
            $.post(url, data, function (datas) {
                window.location.reload();
            });
        }

        function checkitem() {
            $("#popuporderlist").modal();
        }

        function updatestatus(status) {
            var url = "<?php echo Yii::app()->createUrl('orders/updatestatus') ?>";
            var order_id = "<?php echo $order_id ?>";
            var data = {order_id: order_id, status: status};
            $.post(url, data, function (datas) {
                window.location.reload();
            });

        }
    </script>

    <script type="text/javascript">

        Setscreen();
        function Setscreen() {
            var screen = $(window).height();
            //var contentboxsell = $("#content-boxsell").height();
            var screenfull = (screen - 208);
            $("#boxorders").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
            //$("#patientbox").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF'});
            //$("#boxorders").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF', 'overflow': 'auto', 'padding-left': '10px'});

        }


    </script>

