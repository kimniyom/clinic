<link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/backend/bootstrap/css/bootstrap.css" type="text/css" media="all" />
<script src="<?= Yii::app()->baseUrl; ?>/themes/backend/js/jquery-1.9.1.js" type="text/javascript"></script>
<script src="<?= Yii::app()->baseUrl; ?>/themes/backend/bootstrap/js/bootstrap.js" type="text/javascript"></script>

<?php
$User = new Masuser();
$BranchModel = new Branch();
$Config = new Configweb_model();
$Employee = $User->GetDetailUser($detail['user_id']);
$Branch = $detail['branch'];
$card = $detail['card'];
$patient = Patient::model()->find("card = '$card' ");
?>

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

<div id="bill" style=" background: #ffffff; border: #000 solid 1px;padding: 20px;">
    <div id="head-bill" style=" text-align: center;">
        <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $Config->get_logoweb() ?>"/><br/>
        <h2><?php echo $Config->get_webname(); ?></h2>
    </div>
    <hr/>


    <div style="divleft">
        <table style=" border: #cccccc solid 1px; width: 100%;">
            <tr>
                <td style=" width: 60%; border-right: #cccccc solid 1px; padding: 5px;">
                    สาขา : <?php echo Branch::model()->find("id = '$Branch' ")['branchname'] ?><br/>
                    ลูกค้า : คุณ <?php echo $patient['name'] . " " . $patient['lname'] ?>
                </td>
                <td style=" padding: 5px; text-align: right;">
                    <div class="pull-right">
                        วันที่ : <?php echo $Config->thaidate($detail['date_sell']) ?><br/>
                        รหัสบิล : <?php echo $detail['sell_id'] ?>

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
            foreach ($order as $rs):
                $i++;
                $priceRow = ($rs['product_price'] * $rs['total']);
                $sum = $sum + $priceRow;
                ?>
                <tr>
                    <td style=" text-align: center;"><?php echo $i ?></td>
                    <td><?php echo $rs['product_name'] ?></td>
                    <td style=" text-align: center;"><?php echo $rs['total'] ?></td>
                    <td style="text-align: right;">​<?php echo number_format($rs['product_price'], 2) ?></td>
                    <td style="text-align: right;">​<?php echo number_format($priceRow, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td style=" text-align: right; font-weight: bold;" colspan="4">รวม</td>
                <td style="text-align: right;"><?php echo number_format($sum, 2); ?></td>
            </tr>
            <tr>
                <td style=" text-align: right; font-weight: bold;" colspan="4">รับเงิน</td>
                <td style="text-align: right;"><?php echo number_format($logsell['income'], 2); ?></td>
            </tr>
            <tr>
                <td style=" text-align: right; font-weight: bold;" colspan="4">เงินทอน</td>
                <td style="text-align: right;"><?php echo number_format($logsell['change'], 2); ?></td>
            </tr>

        </tfoot>
    </table>
    <br/>

    <div style=" text-align: right;">
        พนักงานขาย<br/> 
        <?php echo $Employee['pername'] . $Employee['name'] . " " . $Employee['lname'] ?><br/>
    </div>
</div>

<script type="text/javascript">
    //alert("1234");
    prints();
    function prints() {
        window.print();
    }
</script>

