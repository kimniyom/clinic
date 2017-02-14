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

<style type="text/css">
    #companysell tr td{
        border-bottom: #cccccc solid 1px;
    }
    #tablelistorder tfoot tr td{
        font-weight: bold;
        background: #f5f5f5;
    }
</style>
<div class="row">
    <div class="col-lg-8 col-md-12">
        <button type="button" class="btn btn-default" onclick="printDiv('printorder')">
            <i class="fa fa-print"></i> print
        </button>


        <div class="well" style=" border-radius: 0px; background: #FFFFFF; position: relative; max-width: 768px;" id="printorder">
            <div style=" text-align: center; margin-bottom: 10px;">
                <h4 style=" margin-bottom: 0px;"><?php echo $BranchModel['branchname']; ?></h4><br/>
                <?php echo $BranchModel['address']; ?><br/>
                <?php echo $BranchModel['contact']; ?><br/>
                <h4 style=" margin: 0px;">ใบสั่งซื้อสินค้า</h4>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <table id="companysell">
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
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div style=" padding: 10px;height: 100px;">
                        <table style=" border: #cccccc solid 1px; float: right;">
                            <tr style=" border-bottom: #cccccc solid 1px;">
                                <td>รหัสสั่งซื้อเลขที่ : </td>
                                <td><?php echo $order['order_id'] ?></td>
                            </tr>
                            <tr>
                                <td>วันที่สั่งซื้อ : </td>
                                <td><?php echo $order['create_date'] ?></td>
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

            <table style=" width: 100%;" class="table table-bordered" id="tablelistorder">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>รหัสสินค้า</th>
                        <th>ชื่อทางการตลาด</th>
                        <th>สินค้า</th>
                        <th style=" text-align: center;">จำนวน</th>
                        <th style="text-align: center;">หน่วยนับ</th>
                        <th style=" text-align: center;">ราคา/หน่วย</th>
                        <th style=" text-align: center;">ส่วนลด</th>
                        <th style="text-align: center;">จำนวนเงิน</th>
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
                            <td><?php echo $rs['product_id'] ?></td>
                            <td><?php echo $rs['product_nameclinic'] ?></td>
                            <td><?php echo $rs['product_name'] ?></td>
                            <td style=" text-align: center;"><?php echo number_format($rs['number']) ?></td>
                            <td style=" text-align: center;"><?php echo $rs['unitname'] ?></td>
                            <td style=" text-align: right;"><?php echo number_format($rs['costs'], 2) ?></td>
                            <td style=" text-align: center;"><?php echo $rs['distcountpercent'] ?> % </td>
                            <td style=" text-align: right;"><?php echo number_format($sumrow, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7" rowspan="5">
                            หมายเหตุ
                        </td>
                    </tr>
                    <tr>
                        <td>รวมเงิน</td>
                        <td style=" text-align: right;"><?php echo number_format($sumproduct, 2) ?></td>
                    </tr>
                    <tr>
                        <td>ส่วนลดคิดเป็นเงิน</td>
                        <td style=" text-align: right;"><?php echo number_format($sumdistcount, 2) ?></td>
                    </tr>
                    <tr>
                        <td>ราคาหลังหักส่วนลด</td>
                        <td style=" text-align: right;">
                            <?php
                            $priceresult = ($sumproduct - $sumdistcount);
                            echo number_format($priceresult, 2);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>ภาษี 7%</td>
                        <td style=" text-align: right;">
                            <?php
                            $tax = ($priceresult * 7) / 100;
                            $taxresult = number_format($tax, 2);
                            echo $taxresult;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7" style=" text-align: center;">
                            <?php
                            $pricetotal = ($priceresult + $tax);
                            echo "(" . $Thaibath->convert($pricetotal) . ")";
                            ?>
                        </td>
                        <td>รวมเงินทั้งสิ้น</td>
                        <td style=" text-align: right;"><?php echo number_format(sprintf('%.2f', $pricetotal), 2); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <?php if($order == '0'){ ?>
        <label>วัตถุดิบที่ต้องใช้</label>

        <table class="table" style=" margin-top: 10px;">
            <thead>
                <tr>
                    <th>วัตถุดิบ</th>
                    <th>จำนวน</th>
                    <th>คงเหลือ</th>
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
                        <td style=" text-align: right;"><?php echo number_format($rx['number']) ?></td>
                        <td style=" text-align: right;"><?php echo number_format($temtotal) ?> <?php echo $icon ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style=" text-align: center;">
                        <?php if ($sum == $a) { ?>
                        <button type="button" class="btn btn-success btn-block" onclick="Confirmorder('<?php echo $order_id ?>')">
                                <i class="fa fa-play"></i> 
                                <?php echo $sum . " " . $a; ?>ยืนยันการผลิต
                            </button>
                        <?php } else { ?>
                        <h4 style=" color: #ff0000;"><i class="fa fa-warning text-warning"></i> วัตถุดิบไม่เพียงพอ</h4>
                        <?php } ?>
                    </td>
                </tr>
            </tfoot>
        </table>
        <?php } else { ?>
        <div class="well" style=" text-align: center; text-align: left;">
            <h4 style="color:green;"><i class="fa fa-check"> ยืนยันรายการ</i></h4>
            <h4 style="color: orange;"><i class="fa fa-arrow-circle-o-right"> รอการจัดส่ง</i></h4>
            <h4 style="color: red;"><i class="fa fa-remove"> จัดส่งสินค้า</i></h4>
            <h4 style="color: red;"><i class="fa fa-remove"> สินค้าถึงผู้รับ</i></h4>
        </div>
        <?php } ?>
    </div>
</div>
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }

    function Confirmorder(order_id){
        var url = "<?php echo Yii::app()->createUrl('orders/confirmorder')?>";
        var data = {order_id: order_id};
        $.post(url,data,function(datas){
            window.location.reload();
        });
    }
</script>


