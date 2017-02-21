<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>
            <?php
            $product_model = new Backend_product();
            $order_model = new Backend_orders();
            $UserModel = new Masuser();
            $MenuReport = new MenuReport();
            $MenuSetting = new MenuSetting();
            $MenuModel = new Menu();
            $AppointModel = new Appoint();
            $Profile = $UserModel->GetProfile();
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
        
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/css/button-color.css"/>
       
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/themes/backend/css/system.css"/>
        
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/backend/bootstrap/css/bootstrap.css" type="text/css" media="all" />
         <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/backend/bootstrap/css/bootstrap-theme.css" type="text/css" media="all" />
        <!--
        <link rel="stylesheet" href="<?//= Yii::app()->baseUrl; ?>/themes/backend/bootstrap-material/dist/css/bootstrap-material-design.css" type="text/css" media="all" />
        -->
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/assets/gallery_img/dist/magnific-popup.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/media/css/dataTables.bootstrap.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/extensions/Buttons/css/buttons.dataTables.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/extensions/Buttons/css/buttons.bootstrap.css" type="text/css" media="all" />
        
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/font-awesome-4.3.0/css/font-awesome.css"/>
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/font-awesome-4.3.0/css/font-awesome-animation.css"/>
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/backend/css/simple-sidebar.css"/>
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/assets/perfect-scrollbar/css/perfect-scrollbar.css"/>
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/css/card-css/card-css.css"/>

        <!-- Bootstrap CheckBox
        <link rel="stylesheet" href="<?//php echo Yii::app()->baseUrl; ?>/css/bootstrap-checkbox/awesome-bootstrap-checkbox.css" type="text/css" media="all" />
        -->
        <!--
        
        <script src="<?//= Yii::app()->baseUrl; ?>/themes/backend/bootstrap/js/bootstrap.js" type="text/javascript"></script>
        -->
        <!-- Magnific Popup core CSS file -->
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/assets/gallery_img/dist/jquery.magnific-popup.js"></script>
        <!-- Data table  -->
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/media/js/dataTables.bootstrap.js"></script>

         <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/extensions/dataTables.buttons.min.js"></script>
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/extensions/buttons.html5.min.js"></script>
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/extensions/buttons.print.min.js"></script>
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/extensions/jszip.min.js"></script>
        
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

        <!-- Sweetalert -->
        <!-- FancyBox -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/lib/sweet-alert/sweetalert.css" type="text/css" media="all" />
        <script src="<?php echo Yii::app()->baseUrl; ?>/lib/sweet-alert/sweetalert.min.js" type="text/javascript"></script>

        <!-- Uploadify -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/lib/uploadify/uploadify.css" type="text/css" media="all" />
        <script src="<?php echo Yii::app()->baseUrl; ?>/lib/uploadify/jquery.uploadify.js" type="text/javascript"></script>

        <!--
            SELECT2 Combobox
        -->
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/lib/select2-master/dist/css/select2.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/lib/select2-bootstrap-theme-master/dist/select2-bootstrap.css" type="text/css" media="all" />
        <script src="<?php echo Yii::app()->baseUrl; ?>/lib/select2-master/dist/js/select2.js" type="text/javascript"></script>

        <!--
            Notify
        -->
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/css/animate.css" type="text/css" media="all" />
        <script src="<?php echo Yii::app()->baseUrl; ?>/lib/notify/bootstrap-notify/bootstrap-notify.js" type="text/javascript"></script>

        <script type = "text/javascript" >
            $(document).ready(function () {
                var user = "<?php echo Yii::app()->user->id ?>";
                if (user == '') {
                    window.location = "<?php echo Yii::app()->createUrl('site/login') ?>";
                }

                Ps.initialize(document.getElementById('sidebar-wrapper'));
                /*
                 $(document).bind("contextmenu", function (e) {
                 return false;
                 });
                 */
            });

            function chkNumber(ele) {
                var vchar = String.fromCharCode(event.keyCode);
                if ((vchar < '0' || vchar > '9') && (vchar != '.'))
                    return false;
                //ele.onKeyPress = vchar;
            }

            function PopupCenter(url, title) {
                // Fixes dual-screen position  
                //                        Most browsers      Firefox
                var w = 1000;
                var h = 760;
                var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
                var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

                var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
                var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

                var left = ((width / 2) - (w / 2)) + dualScreenLeft;
                var top = ((height / 2) - (h / 2)) + dualScreenTop;
                var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

                // Puts focus on the newWindow
                if (window.focus) {
                    newWindow.focus();
                }
            }
        </script>

    </head>

    <body style="background: #fbfbfb;/* background:url('<?//php echo Yii::app()->baseUrl; ?>images/line-bg-advice.png')repeat-x fixed #fdfbfc;*/">
        <!--<div class="container" style="margin-bottom:5%;">-->
        <nav class="navbar navbar-inverse" role="navigation" style="z-index:1; border-radius:0px; margin-bottom:0px;"></nav>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="border-radius:0px; margin-bottom:0px; border-bottom: #000000 solid 0px; /*background: #2a323b;*/">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#menu-toggle" class="navbar-brand" id="menu-toggle"><i class="fa fa-bars"></i> menu</a>
                    <a class="navbar-brand" style=" margin-top: 0px; padding-top: 10px;">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $web->get_logoweb(); ?>" height="32px"/>
                    </a>
                    <a class="navbar-brand" href="#" style=" font-family: Th;font-size:28px;">
                        <?php echo $web->get_webname(); ?>(Admin)
                    </a>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li <?php
                        if (Yii::app()->session['navmenu'] == '1') {
                            echo "class='active'";
                        }
                        ?> onclick="set_navbar('1')">
                            <a href="<?php echo Yii::app()->createUrl('site/index') ?>">
                                <span class="glyphicon glyphicon-home"></span>
                                <font id="font-th">หน้าหลัก</font></a>
                        </li>
                        <?php
                        $ReportMenu = $MenuReport->Getrolemenu($Profile['user_id']);
                        if ($ReportMenu) {
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="glyphicon glyphicon-signal"></span>
                                    <font id="font-th">รายงาน </font><b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php
                                    foreach ($ReportMenu as $rp):
                                        $reportLink = $rp['url'];
                                        ?>
                                        <li><a href="<?php echo Yii::app()->createUrl($reportLink) ?>"> - <?php echo $rp['report_name'] ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php
                        $Settingmenu = $MenuSetting->Getrolesetting($Profile['user_id']);
                        if ($Settingmenu) {
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="fa fa-gear"></span>
                                    <font id="font-th">ตั้งค่าระบบ </font><b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php
                                    foreach ($Settingmenu as $st):
                                        $linlsetting = $st['url'];
                                        ?>
                                        <li><a href="<?php echo Yii::app()->createUrl($linlsetting) ?>"> - <?php echo $st['setting'] ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <li <?php
                        if (Yii::app()->session['navmenu'] == '2') {
                            echo "class='active'";
                        }
                        ?> onclick="set_navbar('2')">
                            <a href="#">
                                <span class="glyphicon glyphicon-book"></span>
                                <font id="font-th">คู่มือการใช้งาน</font></a>
                        </li>
                    </ul>
                    <?php if (!Yii::app()->user->isGuest) { ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="<?= Yii::app()->createUrl('site/logout/') ?>">
                                    <span class="glyphicon glyphicon-off"></span>
                                    <font id="font-th">ออกจากระบบ</font>
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>

        <div id="wrapper">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <!-- ###################### USER #################-->
                <div class="panel panel-info" id="panel-head">
                    <div class=" panel-heading" style="padding-top: 12px;">

                        <?php
                        if (!empty($Profile['images'])) {
                            $img_profile = "uploads/profile/" . $Profile['images'];
                        } else {
                            $img_profile = "images/use-icon.png";
                        }
                        ?>
                        
                        <img src="<?= Yii::app()->baseUrl; ?>/<?php echo $img_profile; ?>" style="border-radius:20px; padding:2px; border:#FFF solid 2px; height: 32px; background: #FFF;"> ผู้ใช้งาน
                    </div>
                    <div class="panel-body">
                        <div id="box-profile">
                            User : <?php echo Yii::app()->user->id . " " . Yii::app()->user->name ?><br>
                            สถานะ : <?php echo Yii::app()->session['status'] . ' (' . $Profile['status'] . ')'; ?><br/>
                            สาขา ​: <?php echo Yii::app()->session['branch'] . " " . $branchModel->Getbranch(Yii::app()->session['branch']) ?>
                        </div>
                    </div>
                    <div class="panel-footer" style="border-bottom:solid 1px #e5e5e5; border-radius:0px;">
                        <a href="<?= Yii::app()->createUrl('masuser/profile', array('id' => $Profile['id'])); ?>">ข้อมูลส่วนตัว</a>
                    </div>
                </div>
                <!-- ส่วนของ ผู้ดูแลระบบ -->

                <!-- ตั้งค่าร้านค้า -->
                <?php
                $MenuSystem = $MenuModel->Getrolemenu($Profile['user_id']);
                $i = 0;
                foreach ($MenuSystem as $mn):
                    $linkmenu = $mn['link'];
                    $icon = $mn['icon'];
                    $i ++;

                    if (Yii::app()->session['leftmenu'] == $i) {
                        $menuactove = "listmenuactive";
                    } else {
                        $menuactove = "";
                    }
                    ?>
                    <a href="<?php echo Yii::app()->createUrl($linkmenu) ?>" onclick="setactivemenu('<?php echo $i ?>')">
                        <div id="listmenu" class="<?php echo $menuactove; ?>">
                            <img src="<?php echo Yii::app()->baseUrl; ?>/images/<?php echo $icon ?>"
                                 height="32px"
                                 style="border-radius:20px; padding:2px; border:#FFF solid 2px;"/>
                                 <?php echo $mn['menu'] ?>
                        </div>
                    </a>
                <?php endforeach; ?>


                </a>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper" style="padding:0px;">
                <nav class="navbar navbar-default" id="heading-panel" role="navigation" style="margin-bottom:10px; border-radius: 0px; padding-top: 3px; border-left: none; border-right: none;">
                    <ul class="nav nav-pills pull-right" style="margin:5px;">
                        <?php
                        if ($product_model->stockproductalert() > 0) {
                            $classalertproduct = "fa fa-bell faa-flash animated faa-slow text-danger";
                            $alertproduct = "bg-alert";
                        } else {
                            $classalertproduct = "fa fa-bell";
                            $alertproduct = "";
                        }
                        ?>
                        <?php
                        if ($product_model->stockitemalert() > 0) {
                            $classalertitem = "fa fa-bell faa-flash animated text-danger";
                            $alertstock = "bg-alert";
                        } else {
                            $classalertitem = "fa fa-bell";
                            $alertstock = "";
                        }
                        ?>

                        <?php
                        if ($AppointModel->Countover() > 0) {
                            $classalertover = "fa fa-bell faa-flash animated text-danger";
                            $alertappoint = "bg-alert";
                        } else {
                            $classalertover = "fa fa-bell";
                            $alertappoint = "";
                        }
                        ?>
                        <li><a href="<?php echo Yii::app()->createUrl('backend/stock/expireproduct') ?>"><i class="<?php echo $classalertproduct ?>"></i> สินค้าใกล้หมด <span class="badge" id="<?php echo $alertproduct ?>"><?php echo $product_model->stockproductalert(); ?> </span></a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('backend/stock/expireitem') ?>"><i class="<?php echo $classalertitem ?>"></i> สินค้าใกล้หมดอายุ <span class="badge" id="<?php echo $alertstock ?>"><?php echo $product_model->stockitemalert(); ?> </span></a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('appoint/appointover') ?>"><i class="<?php echo $classalertover ?>"></i> ลูกค้าใกล้ถึงวันนัด <span class="badge" id="<?php echo $alertappoint ?>"><?php echo $AppointModel->Countover(); ?> </span></a></li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">

                            <ol class="breadcrumb " style=" margin-bottom: 10px; margin-top: 0px; border-radius: 0px; background: #FFFFFF;">

                                <?php if (isset($this->breadcrumbs)): ?>
                                    <?php
                                    $this->widget('zii.widgets.CBreadcrumbs', array(
                                        'homeLink' => CHtml::link('<i class=" glyphicon glyphicon-home"></i> หน้าหลัก', Yii::app()->createUrl('site/index')),
                                        'links' => $this->breadcrumbs,
                                    ));
                                    ?><!-- breadcrumbs -->
                                <?php endif ?>
                            </ol>
                            <?php
                            echo $content;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
        <!-- /#wrapper -->


        <!-- Menu Toggle Script -->
        <script>

            $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });

            function set_navbar(id) {
                var url = "<?php echo Yii::app()->createUrl('backend/backend/set_navbar') ?>";
                var data = {id: id};
                $.post(url, data, function (success) {
                    //window.location.reload();
                });
            }

            $(function () {
                $(".dropdown").hover(
                        function () {
                            $('.dropdown-menu', this).stop(true, true).fadeIn("fast");
                            $(this).toggleClass('open');
                            $('b', this).toggleClass("caret caret-up");
                        },
                        function () {
                            $('.dropdown-menu', this).stop(true, true).fadeOut("fast");
                            $(this).toggleClass('open');
                            $('b', this).toggleClass("caret caret-up");
                        });
            });

            $(document).on('click', '.panel-heading span.clickable', function (e) {
                var $this = $(this);
                if (!$this.hasClass('panel-collapsed')) {
                    $this.parents('.panel').find('.list-group').slideDown();
                    $this.addClass('panel-collapsed');
                    $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
                } else {
                    $this.parents('.panel').find('.list-group').slideUp();
                    $this.removeClass('panel-collapsed');
                    $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
                }
            });

            function setactivemenu(id) {
                var url = "<?php echo Yii::app()->createUrl('site/setactivemenu') ?>";
                var data = {menu: id};
                $.post(url, data, function () {

                });
            }
            
            
        </script>
    </body>
</html>
