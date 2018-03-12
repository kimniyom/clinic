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
            echo $time;
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

       <?php echo $table ?>
    </body>
    <html


