<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/backend/bootstrap/css/bootstrap.css" type="text/css" media="all" />
        <script src="<?= Yii::app()->baseUrl; ?>/themes/backend/js/jquery-1.9.1.js" type="text/javascript"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/backend/bootstrap/js/bootstrap.js" type="text/javascript"></script>
        <style type="text/css">
            body{
                padding: 20px;
                font-size: 12px;
            }
            #bill table {
                background: #ffffff;
                color: #666666;
                font-size: 12px;
            }

            #bill{
                color: #666666;
                padding-bottom: 60px;
            }

            #divleft{
                width: 40%;
                border: #cccccc solid 1px; padding:5px;
                float: left;
            }

            #divright{
                float: right;
                width: 40%;
                border: #cccccc solid 1px; padding:5px;
            }
        </style>
    </head>
    <body>
        <?php
        /*
          s.service_date,
          p.card,
          p.`name`,
          p.lname,
          e.`name` AS empname,
          e.lname AS emplname,
          ed.`name` AS doctorname,ed.lname AS doctorlname,
          po.position AS positionemp,pod.position AS positiondoctor
         */
//$User = new Masuser();
//$BranchModel = new Branch();
        $Config = new Configweb_model();
        $Branch = $detail['branch'];
//$card = $detail['card'];
//$patient = Patient::model()->find("card = '$card' ");
        $logo = Logo::model()->find("branch = '$Branch'")['logo'];
        ?>



        <div id="bill" style=" background: #ffffff; border: #000 solid 1px;padding: 50px;">
            <div style=" text-align: center; color: #999999; font-size: 20px;">ใบเสร็จ</div>
            <div id="head-bill" style=" text-align: left;">
                <div style=" float: left">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $logo ?>" style=" width: 48px;"/>
                </div>
                <div style=" float: left;">
                    <h4><?php echo $Config->get_webname(); ?></h4>
                    <?php echo $detail['branchname'] ?>
                </div>
            </div>
            <hr/>


            <div style="divleft">
                <table style=" border: #cccccc solid 1px; width: 100%;">
                    <tr>
                        <td style=" width: 60%; border-right: #cccccc solid 1px; padding: 5px;">
                            สาขา : <?php echo $detail['branchname'] ?><br/>
                            ลูกค้า : คุณ <?php echo $detail['name'] . " " . $detail['lname'] ?>
                        </td>
                        <td style=" padding: 5px; text-align: right;">
                            <div class="pull-right">
                                วันที่ : <?php echo $Config->thaidate($detail['service_date']) ?><br/>
                                รหัส : <?php echo $detail['service_id'] ?>

                            </div>
                        </td>
                    </tr>
                </table>

            </div>




            <br/>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="text-align: center; width: 5%;">#</th>
                        <th>รายการ</th>
                        <th style=" text-align: center; width: 10%;">จำนวน</th>
                        <th style=" text-align: center; width: 10%;">ราคา / หน่วย</th>
                        <th style=" text-align: center; width: 10%;">รวม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sum = 0;
                    $i = 0;
                    foreach ($listdetail as $rs):
                        $i++;
                        $sum = ($sum + $rs['total']);
                        ?>
                        <tr>
                            <td style=" text-align: center;"><?php echo $i ?></td>
                            <td><?php echo $rs['detail'] ?></td>
                            <td style=" text-align: center;"><?php echo $rs['number'] ?></td>
                            <td style="text-align: right;">​<?php echo number_format($rs['price'], 2) ?></td>
                            <td style="text-align: right;">​<?php echo number_format($rs['total'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td style=" text-align: right; font-weight: bold;" colspan="4">รวม</td>
                        <td style="text-align: right;"><?php echo number_format($sum, 2); ?></td>
                    </tr>
                    <!--
                    <tr>
                        <td style=" text-align: right; font-weight: bold;" colspan="4">ส่วนลด</td>
                        <td style="text-align: right;"><?php //echo number_format($logsell['distcount'], 2);   ?></td>
                    </tr>
                    <tr>
                        <td style=" text-align: right; font-weight: bold;" colspan="4">ราคาหักส่วนลด</td>
                        <td style="text-align: right;"><?php //echo number_format($logsell['totalfinal'], 2);   ?></td>
                    </tr>
                    <tr>
                        <td style=" text-align: right; font-weight: bold;" colspan="4">รับเงิน</td>
                        <td style="text-align: right;"><?php //echo number_format($logsell['income'], 2);   ?></td>
                    </tr>
                    <tr>
                        <td style=" text-align: right; font-weight: bold;" colspan="4">เงินทอน</td>
                        <td style="text-align: right;"><?php //echo number_format($logsell['change'], 2);   ?></td>
                    </tr>
                    -->
                </tfoot>
            </table>
            <br/>

            <div style=" text-align: center; width: 30%; float: left;">
                <?php echo $detail['doctorname'] . " " . $detail['doctorlname'] ?><br/>
                (<?php echo $detail['positiondoctor'] ?>)<br/> 
            </div>

            <div style=" text-align: center; width: 30%; float: right;">
                <?php echo $detail['empname'] . " " . $detail['emplname'] ?><br/>
                (<?php echo $detail['positionemp'] ?>)<br/> 
            </div>
        </div>

        <script type="text/javascript">
            //alert("1234");
            prints();
            function prints() {
                window.print();
            }


        </script>
    </body>
</html>


