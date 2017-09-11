<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>
            <?php
            $web = new Configweb_model();
            echo "order-" . $order_id;
            ?>
        </title>

        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/themes/backend/css/template.css"/>

        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/themes/backend/css/system.css"/>

        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/backend/bootstrap/css/bootstrap.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/backend/bootstrap/css/bootstrap-theme.css" type="text/css" media="all" />

        <style type="text/css">
            table thead tr th{
                height: 30px; padding: 2px;
                font-size: 16px;
            }
            table tbody tr td{
                height: 30px; padding: 2px;
                font-size: 16px;
            }

            table tfoot tr td{
                height: 30px; padding: 2px;
                font-size: 16px;
            }

            #companysell tr td{
                padding: 5px; font-size: 16px;
            }

            #companysellbarcode tr td{
                padding: 7px; font-size: 16px;
            }
        </style>

    </head>
    <body>

        <?php
        /* @var $this OrdersController */
        /* @var $model Orders */

        $companySell = Companycenter::model()->find("id = '1'");
        $Thaibath = new Thaibaht();
        ?>
        <div style=" position: fixed; left: 20px; top: 20px;">
            <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $companySell['logo'] ?> " width="100" />
        </div>

        <div style="border-radius: 0px; padding: 10px; background: #FFFFFF; border: #999999 solid 1px; position: relative;" id="printorder">

            <div style=" text-align: center; margin-bottom: 10px; font-size: 20px; color: #000;">
                <h4 style=" margin-bottom: 0px;font-size: 28px; color: #000; font-weight: bold;"><?php echo $companySell['companyname'] ?></h4>
                <?php echo $companySell['address']; ?><br/>
                โทร. <?php echo $companySell['tel']; ?>
                เลขผู้เสียภาษี <?php echo $companySell['tax']; ?><br/>
                <h4 style=" margin: 0px; font-size: 24px; font-weight: bold; color: #000;">ใบส่งของ</h4>
            </div>
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <table id="companysell" style=" width: 100%; border: #999999 solid 2px;">
                        <tr>
                            <td>ผู้รับ : <?php echo $BranchModel['menagers'] ?></td>
                        </tr>
                        <tr>
                            <td>ที่อยู่ : <?php echo $BranchModel['branchname'] . " " . $BranchModel['address'] ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $BranchModel['contact'] ?></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <div style=" padding: 0px;height: 100px; float: right; margin-right: 20px;" id="companysellbarcode">
                        <table style=" border: #999999 solid 2px; float: right; width: 100%;">
                            <tr>
                                <td style="border-bottom: #999999 solid 2px;">รหัสสั่งซื้อ :</td>
                                <td style=" text-align: center; border-bottom: #999999 solid 2px;" >   
                            <barcode code="<?php echo $order_id; ?>" type="c39" size="0.5" height="1.0" />
                            <br/><?php echo $order_id; ?>
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
            


            <table style=" width: 100%; border: #999999 solid 2px;" class="table" id="tablelistorder">
                <thead>
                    <tr>
                        <th style="border-bottom: #999999 solid 2px; background: #f4f4f4;">#</th>
                        <th style="border-left:#999999 solid 2px; border-bottom: #999999 solid 2px; background: #f4f4f4;">รหัสสินค้า</th>
                        <th style="border-left:#999999 solid 2px; border-bottom: #999999 solid 2px; background: #f4f4f4;">ชื่อทางการตลาด</th>
                        <th style="border-left:#999999 solid 2px; border-bottom: #999999 solid 2px; background: #f4f4f4;">สินค้า</th>
                        <th style="text-align: center;border-left:#999999 solid 2px; border-bottom: #999999 solid 2px;background: #f4f4f4;">จำนวน</th>
                        <th style="text-align: center;border-left:#999999 solid 2px; border-bottom: #999999 solid 2px;background: #f4f4f4;">หน่วยนับ</th>
                        <th style="text-align: center;border-left:#999999 solid 2px; border-bottom: #999999 solid 2px;background: #f4f4f4;">ราคา/หน่วย</th>
                        <th style="text-align: center;border-left:#999999 solid 2px; border-bottom: #999999 solid 2px;background: #f4f4f4;">จำนวนเงิน</th>
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
                            <td style="border-left:#999999 solid 2px;"><?php echo $rs['product_id'] ?></td>
                            <td style="border-left:#999999 solid 2px;"><?php echo $rs['product_nameclinic'] ?></td>
                            <td style="border-left:#999999 solid 2px;"><?php echo $rs['product_name'] ?></td>
                            <td style=" text-align: center;border-left:#999999 solid 2px;"><?php echo number_format($rs['number']) ?></td>
                            <td style=" text-align: center;border-left:#999999 solid 2px;"><?php echo $rs['unitname'] ?></td>
                            <td style=" text-align: right;border-left:#999999 solid 2px;"><?php echo number_format($rs['costs'], 2) ?></td>
                            <td style=" text-align: right;border-left:#999999 solid 2px;"><?php echo number_format($sumrow, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" rowspan="5" id="bold-right" valign="top" style=" border-right:#999999 solid 2px; border-top: #999999 solid 2px;">
                            หมายเหตุ
                        </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: #999999 solid 2px; background: #f4f4f4;border-top: #999999 solid 2px;" colspan="2">รวมเงิน</td>
                        <td style=" text-align: right;border-left:#999999 solid 2px; border-bottom: #999999 solid 2px; background: #f4f4f4;border-top: #999999 solid 2px;"><?php echo number_format($sumproduct, 2) ?></td>
                    </tr>
                    <tr style="border-top: #999999 solid 2px;">
                        <td style="border-bottom: #999999 solid 2px; background: #f4f4f4;" colspan="2">ส่วนลด <?php echo $order['distcount'] ?> %</td>
                        <td style=" text-align: right;border-left:#999999 solid 2px; border-bottom: #999999 solid 2px; background: #f4f4f4;"><?php echo number_format($order['distcountprice'], 2) ?></td>
                    </tr>
                    <tr>
                        <td style="border-bottom: #999999 solid 2px; background: #f4f4f4;" colspan="2">ราคาหลังหักส่วนลด</td>
                        <td style=" text-align: right;border-left:#999999 solid 2px; border-bottom: #999999 solid 2px; background: #f4f4f4;">
                            <?php
                            $priceresult = ($sumproduct - $order['distcountprice']);
                            echo number_format($priceresult, 2);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: #999999 solid 2px;background: #f4f4f4;" colspan="2">ภาษี 7%</td>
                        <td style=" text-align: right;border-left:#999999 solid 2px; border-bottom: #999999 solid 2px;background: #f4f4f4;">
                            <?php
                            $tax = ($priceresult * 7) / 100;
                            $taxresult = number_format($tax, 2);
                            echo $taxresult;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style=" text-align: center;border-right:#999999 solid 2px; background: #f4f4f4; border-top: #999999 solid 2px;">
                            <?php
                            $pricetotal = number_format(($priceresult + $tax), 2);
                                $priceCovert = str_replace(",", "", $pricetotal);
                                if (substr($priceCovert, -2) == "00") {
                                    $priceCoverts = str_replace(".00", "", $priceCovert);
                                } else {
                                    $priceCoverts = $priceCovert;
                                }
                                echo "(" . $Thaibath->convert($priceCoverts) . ")";
                            ?>
                        </td>
                        <td colspan="2" style="background: #f4f4f4;">รวมเงินทั้งสิ้น</td>
                        <td style=" text-align: right;border-left:#999999 solid 2px; border-bottom: #999999 solid 2px; background: #f4f4f4;"><?php echo number_format(sprintf('%.2f', $priceCovert), 2); ?></td>
                    </tr>
                </tfoot>
            </table>
            <div style="float: left; width: 30%; height: 100px; border: #999999 solid 3px; padding: 5px; position: relative; font-size: 20px; text-align: center; margin-right: 20px;">
                สินค้าอยู่ในสภาพถูกต้องครบถ้วน<br/><br/><br/>
                <div style="position: fixed; width: 100%; bottom: 5px; text-align: center; border-top: #000000 dotted 1px; height: 30px;">
                    คลังสินค้า / ผู้ตรวจสอบ<br/>
                    วันที่ ............./................../................
                </div>
            </div>
            <div style="float: left; width: 30%; height: 100px; border: #999999 solid 3px; padding: 5px; position: relative; font-size: 20px; text-align: center; margin-left: 10px;">
                <font style=" color: #FFFFFF;">1</font><br/><br/><br/>
                <div style="position: fixed; width: 100%; bottom: 5px; text-align: center; border-top: #000000 dotted 1px; height: 30px;">
                    ผู้ส่งของ<br/>
                    วันที่ ............./................../................
                </div>
            </div>
            <div style="float: right; width: 30%; height: 100px; border: #999999 solid 3px; padding: 5px; position: relative; font-size: 20px; text-align: center;">
                <?php echo $companySell['companyname'] ?><br/><br/><br/>
                <div style="position: fixed; width: 100%; bottom: 5px; text-align: center; border-top: #000000 dotted 1px; height: 30px;">
                    ผู้มีอำนาจลงนาม<br/>
                    วันที่ ............./................../................
                </div>
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
        </script>
    </body>
    <html


