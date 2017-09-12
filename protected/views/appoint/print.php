<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <style type="text/css">
            table{
                border: #cccccc solid 1px;
                border-radius: 5px;
                color: #333333;
            }

        </style>
    </head>
    <body>
        <?php
        $Model = new Appoint();
        $web = new Configweb_model();
        ?>
        <img src="<?php echo Yii::app()->baseUrl ?>/uploads/logo/bill-logo.png" style=" width: 50px;"/>
        <font style=" color: #0099cc; font-size: 20px;"><?php echo $web->get_webname() ?></font>
        <hr/>
        <b>ใบนัดเลขที่ #<?php echo $appoint['id'] ?></b>
        <table style=" width: 100%;">
            <tr><td>คุณ : <?php echo $appoint['name'] . ' ' . $appoint['lname'] ?></td><tr/>
            <tr><td>วันที่นัด : <?php echo $web->thaidate($appoint['appoint']) ?></td><tr/>
            <tr><td>สาขา : <?php echo $appoint['branchname'] ?></td><tr/>
            <tr><td>ประเภทนัด : <?php echo $Model->Typeappoint($appoint['type']) ?></td><tr/>
            <tr><td style=" border: none;">อื่น ๆ : <?php echo $appoint['etc'] ?></td><tr/>
        </table>
        <br/><br/>

        <div style=" border-bottom: #333333 dashed 1px;">
            <img src="<?php echo Yii::app()->baseUrl ?>/images/Editing-Cut-icon.png"/>
        </div>
        <script type="text/javascript">
            printappoint();
            function printappoint() {
                window.print();
            }
        </script>
    </body>
</html>