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
            $branchModel = new Branch();
            echo $web->get_webname();
            ?>
        </title>
        <style type="text/css">
            body{
                overflow-x: hidden;
            }
            body table tbody tr td{
                /*color: #ff9900;*/
            }

            body table tbody tr td a{
                color: #ff9900;
            }
            
        </style>
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/themes/backend/css/template.css"/>

        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/themes/backend/css/system.css"/>
        
        <!--
        <link rel="stylesheet" href="<?//= Yii::app()->baseUrl; ?>/themes/backend/bootstrap/css/bootstrap.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?//= Yii::app()->baseUrl; ?>/themes/backend/bootstrap/css/bootstrap-theme.css" type="text/css" media="all" />
        -->
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/backend/bootstrap-material/dist/css/bootstrap-material-design.css" type="text/css" media="all" />
        

        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/media/css/dataTables.bootstrap.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/extensions/Buttons/css/buttons.dataTables.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/extensions/Buttons/css/buttons.bootstrap.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/extensions/FixedColumns/css/fixedColumns.bootstrap.css" type="text/css" media="all" />
        
        
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/font-awesome-4.3.0/css/font-awesome.css"/>
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/font-awesome-4.3.0/css/font-awesome-animation.css"/>
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/assets/perfect-scrollbar/css/perfect-scrollbar.css"/>
        

        <!-- Data table  -->
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/media/js/dataTables.bootstrap.js"></script>

        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/extensions/dataTables.buttons.min.js"></script>
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/extensions/buttons.html5.min.js"></script>
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/extensions/buttons.print.min.js"></script>
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/extensions/jszip.min.js"></script>
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/extensions/pdfmake.min.js"></script>
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/extensions/vfs_fonts.js"></script>
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/extensions/FixedColumns/js/dataTables.fixedColumns.js"></script>
        
        <!-- highcharts -->
        <script src="<?= Yii::app()->baseUrl; ?>/lib/Highcharts-5.0.5/code/highcharts.js"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/lib/Highcharts-5.0.5/code/themes/grid-light.js"></script>
        <!--
        <script src="<?//= Yii::app()->baseUrl; ?>/assets/highcharts/themes/dark-unica.js"></script>
        -->
        <script src="<?= Yii::app()->baseUrl; ?>/assets/perfect-scrollbar/js/perfect-scrollbar.js"></script>

        <!-- DatePicker -->
        <!--
        <link rel="stylesheet" href="<?//php echo Yii::app()->baseUrl; ?>/lib/bootstrap-datepicker/css/bootstrap-datepicker.css" type="text/css" media="all" />
        <script src="<?//php echo Yii::app()->baseUrl; ?>/lib/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="<?//php echo Yii::app()->baseUrl; ?>/lib/bootstrap-datepicker/locales/bootstrap-datepicker.th.min.js" type="text/javascript"></script>-->


        <!--
            SELECT2 Combobox
        -->
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/lib/select2-master/dist/css/select2.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/lib/select2-bootstrap-theme-master/dist/select2-bootstrap.css" type="text/css" media="all" />
        <script src="<?php echo Yii::app()->baseUrl; ?>/lib/select2-master/dist/js/select2.js" type="text/javascript"></script>


        <script type = "text/javascript" >
            $(document).ready(function () {
                var user = "<?php echo Yii::app()->user->id ?>";
                if (user == '') {
                    window.close();
                }
            });

            function chkNumber(ele) {
                var vchar = String.fromCharCode(event.keyCode);
                if ((vchar < '0' || vchar > '9') && (vchar != '.'))
                    return false;
                //ele.onKeyPress = vchar;
            }
        </script>

    </head>

    <body>
        <!-- Page Content -->
        <div id="page-content-wrapper" style="padding:0px;">
            <div class="container" style=" padding: 10px;">
                <?php
                echo $content;
                ?>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
        <!-- /#wrapper -->
    </body>
</html>
