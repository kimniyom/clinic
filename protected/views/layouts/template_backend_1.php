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
            $web = new Configweb_model();
            echo $web->get_webname();
            ?>
        </title>
        <style type="text/css">
            body{
                overflow-x: hidden;
            }
        </style>
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/backend/css/system.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/backend/bootstrap/css/bootstrap.css" type="text/css" media="all" />
        <!--
                <link rel="stylesheet" href="<?//= Yii::app()->baseUrl; ?>/themes/backend/css/bootstrap-theme.css" type="text/css" media="all" />
        -->
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/assets/gallery_img/dist/magnific-popup.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/assets/DataTables-1.10.7/media/css/dataTables.bootstrap.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/assets/DataTables-1.10.7/extensions/TableTools/css/dataTables.tableTools.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/font-awesome-4.3.0/css/font-awesome.css"/>
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/backend/css/simple-sidebar.css"/>
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/assets/perfect-scrollbar/css/perfect-scrollbar.css"/>
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/css/card-css/card-css.css"/>
        <!-- Bootstrap CheckBox
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap-checkbox/awesome-bootstrap-checkbox.css" type="text/css" media="all" />
        -->
        <script src="<?= Yii::app()->baseUrl; ?>/themes/backend/js/jquery-1.9.1.js" type="text/javascript"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/backend/bootstrap/js/bootstrap.js" type="text/javascript"></script>
        <!-- Magnific Popup core CSS file -->
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/assets/gallery_img/dist/jquery.magnific-popup.js"></script>
        <!-- Data table  -->
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/assets/DataTables-1.10.7/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/assets/DataTables-1.10.7/media/js/dataTables.bootstrap.js"></script>
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/assets/DataTables-1.10.7/extensions/TableTools/js/dataTables.tableTools.js"></script>
        <!-- highcharts -->
        <script src="<?= Yii::app()->baseUrl; ?>/assets/highcharts/highcharts.js"></script>
        <!--
        <script src="<?//= Yii::app()->baseUrl; ?>/assets/highcharts/themes/dark-unica.js"></script>
        -->
        <script src="<?= Yii::app()->baseUrl; ?>/assets/perfect-scrollbar/js/perfect-scrollbar.js"></script>

        <!-- Uploadify -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/uploadify/uploadify.css" type="text/css" media="all" />
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                Ps.initialize(document.getElementById('sidebar-wrapper'));
                $(document).bind("contextmenu", function (e) {
                    return false;
                });
            });

            function chkNumber(ele) {
                var vchar = String.fromCharCode(event.keyCode);
                if ((vchar < '0' || vchar > '9') && (vchar != '.'))
                    return false;
                //ele.onKeyPress = vchar;
            }
        </script>

    </head>

    <body style="/*background:url('<?//php echo Yii::app()->baseUrl; ?>images/line-bg-advice.png')repeat-x fixed #fdfbfc;*/">
        <!--<div class="container" style="margin-bottom:5%;">-->
        <nav class="navbar navbar-default" role="navigation" style="z-index:1; border-radius:0px; margin-bottom:0px;"></nav>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="border-radius:0px; margin-bottom:0px; background: #2a323b;;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#menu-toggle" class="navbar-brand" id="menu-toggle"><i class="fa fa-bars"></i></a>
                    <a class="navbar-brand" style=" margin-top: 0px; padding-top: 10px;">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $web->get_logoweb(); ?>" height="24px"/>
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
                            <a href="<?php echo Yii::app()->createUrl('frontend/main') ?>">
                                <span class="glyphicon glyphicon-home"></span>
                                <font id="font-th">หน้าหลัก</font></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-signal"></span>
                                <font id="font-th">รายงาน </font><b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo Yii::app()->createUrl('backend/report/mas_report_list') ?>"> - รายงานยอดขาย</a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('backend/report/mas_report_order') ?>"> - รายงานการสั่งซื้อสินค้า</a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('backend/report/mas_report_type') ?>"> - รายงานการสั่งซื้อสินค้า(แยกประเภท)</a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('backend/report/mas_report_sale') ?>"> - รายงานรายได้</a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('backend/report/mas_report_user') ?>"> - รายงานการเข้าเป็นสมาชิก</a></li>
                            </ul>
                        </li>
                        <li <?php
                        if (Yii::app()->session['navmenu'] == '2') {
                            echo "class='active'";
                        }
                        ?> onclick="set_navbar('2')">
                            <a href="<?php echo Yii::app()->createUrl('frontend/main') ?>">
                                <span class="glyphicon glyphicon-book"></span>
                                <font id="font-th">คู่มือการใช้งาน</font></a>
                        </li>
                        <?php
                        $msg = new Backend_message();
                        $msg_short = $msg->Get_message_short();
                        ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="ข้อความ">
                                <span class="label" style="top: 5px; position: absolute; left: 5px; background: #666666;">
                                    <?php echo $msg->Count_message(); ?>
                                </span>
                                <font id="font-th"> &nbsp;ข้อความ</font>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu" style=" padding-top: 0px; padding-bottom: 0px;">
                                <?php foreach ($msg_short as $s_msg): ?>
                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl('backend/message/detail/id/' . $s_msg['id']) ?>">
                                            <div id="msg_limit">
                                                <i class="fa fa-comment-o"></i>
                                                <?php echo $s_msg['message'] ?>
                                            </div>
                                            <font style="font-size:10px;">
                                            <i class="fa fa-user"></i> <?php echo $s_msg['name'] . ' ' . $s_msg['lname'] ?>
                                            <i class="fa fa-calendar"></i> <?php echo $web->thaidate($s_msg['date_send']) ?>
                                            </font>
                                        </a>
                                    </li>
                                    <li class="divider" style=" padding: 0px; margin: 0px;"></li>
                                <?php endforeach; ?>
                                <li style=" text-align: center; font-size: 16px;">
                                    <a href="<?php echo Yii::app()->createUrl('backend/message') ?>"><i class="fa fa-list-ul" style=" margin:10px auto;"></i> ดูทั้งหมด</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="<?= Yii::app()->createUrl('site/logout/') ?>">
                                <span class="glyphicon glyphicon-off"></span>
                                <font id="font-th">ออกจากระบบ</font>
                            </a>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>

        <div id="wrapper">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <!-- ###################### USER #################-->
                <div class="panel panel-default" id="panel-head">
                    <div class=" panel-heading" id="panel">
                        <img src="<?= Yii::app()->baseUrl; ?>/images/use-icon.png" style="border-radius:20px; padding:2px; border:#FFF solid 2px;"> ผู้ใช้งาน
                    </div>
                    <div class="panel-body">
                        ชื่อ : <?= Yii::app()->session['username']; ?><br>
                        สถานะ : <?php echo "ผู้ดูแลระบบ"; ?><br/>
                    </div>
                    <div class="panel-footer" style="border-bottom:solid 1px #eeeeee; border-radius:0px;">
                        <a href="<?= Yii::app()->createUrl('frontend/user/from_edit_register/'); ?>">ข้อมูลส่วนตัว</a>
                    </div>
                </div>
                <!-- ส่วนของ ผู้ดูแลระบบ -->

                <!-- ตั้งค่าร้านค้า -->
                <a href="<?php echo Yii::app()->createUrl('branch/index') ?>">
                    <div id="listmenu">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/clinic-icon.png"
                             height="32px"
                             style="border-radius:20px; padding:2px; border:#FFF solid 2px; background: #FFFFFF;"/>
                        ข้อมูลสาขา
                    </div>
                </a>

                <div class="panel panel-default" id="panel-head">
                    <div class="panel-heading" id="panel">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/users-icon.png"
                             height="32px"
                             style="border-radius:20px; padding:2px; border:#FFF solid 2px;"/>
                        ข้อมูลพนักงาน
                        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
                    </div>
                    <div class="list-group">
                        <a href="<?= Yii::app()->createUrl('position/index') ?>" class="list-group-item">
                            <i class="fa fa-user"></i> ตำแหน่งพนักงาน
                        </a>
                        <a href="<?= Yii::app()->createUrl('backend/user/register') ?>" class="list-group-item">
                            <i class="fa fa-user"></i> ลงทะเบียนพนักงาน
                        </a>
                        <a href="<?= Yii::app()->createUrl('backend/user/userall') ?>" class="list-group-item">
                            <i class="fa fa-group"></i> รายชื่อพนักงาน
                        </a>
                    </div>
                </div>
                <!-- ตั้งค่าร้านค้า -->
                <div class="panel panel-default" id="panel-head">
                    <div class="panel-heading" id="panel">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $web->get_logoweb(); ?>"
                             height="32px"
                             style="border-radius:20px; padding:2px; border:#FFF solid 2px;"/>
                        ข้อมูลร้านค้า
                        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
                    </div>
                    <div class="list-group">
                        <a href="<?= Yii::app()->createUrl('backend/contact') ?>" class="list-group-item">
                            <i class="fa fa-phone-square"></i> ข้อมูลติดต่อ
                        </a>
                        <a href="<?= Yii::app()->createUrl('backend/about') ?>" class="list-group-item">
                            <i class="fa fa-user-secret"></i> เกี่ยวกับเรา
                        </a>
                        <a href="<?= Yii::app()->createUrl('backend/banner') ?>" class="list-group-item">
                            <i class="fa fa-image"></i>  จัดการภาพ Banner
                        </a>
                        <a href="<?= Yii::app()->createUrl('backend/logo') ?>" class="list-group-item">
                            <i class="fa fa-smile-o"></i>  จัดการ โลโก้ เว็บ
                        </a>
                        <a href="<?= Yii::app()->createUrl('backend/web') ?>" class="list-group-item">
                            <i class="fa fa-text-height"></i>  จัดการ ชื่อเว็บ
                        </a>
                        <a href="<?= Yii::app()->createUrl('backend/howtoorder') ?>" class="list-group-item">
                            <i class="fa fa-book"></i>  วิธีการสั่งซื้อ
                        </a>
                    </div>
                </div>
                <!-- List Menu Admin-->
                <div class="panel panel-default" id="panel-head">
                    <div class="panel-heading" id="panel">
                        <img src="<?= Yii::app()->baseUrl; ?>/images/system-icon.png" style="border-radius:20px; padding:2px; border:#FFF solid 2px;">
                        ตั้งค่าระบบ
                        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
                    </div>
                    <div class="list-group">
                        <a href="<?= Yii::app()->createUrl('backend/typeproduct/from_add_type') ?>"
                           class="list-group-item"><i class="fa fa-folder-open"></i> ประเภทสินค้า</a>
                        <a href="<?= Yii::app()->createUrl('backend/product/index') ?>"
                           class="list-group-item"><i class="fa fa-folder-open"></i> สินค้า</a>
                        <a href="<?= Yii::app()->createUrl('backend/user/userall') ?>"
                           class="list-group-item"><i class="fa fa-group"></i>  ข้อมูลสมาชิก</a>
                        <a href="<?= Yii::app()->createUrl('backend/payment/view') ?>"
                           class="list-group-item"><span class="fa fa-money"></span>  ช่องทางการชำระเงิน</a>
                        <a href="<?= Yii::app()->createUrl('backend/period') ?>"
                           class="list-group-item"><span class="fa fa-calendar"></span>  ระยะเวลาจองสินค้า</a>
                        <a href="<?= Yii::app()->createUrl('backend/transport') ?>"
                           class="list-group-item"><span class="fa fa-truck"></span>  ช่องทางการจัดส่ง</a>
                    </div>
                </div>

                <!-- List รายชื่อ สินค้า -->
                <div class="panel panel-default" id="panel-head">
                    <div class="panel-heading" id="panel">
                        <img src="<?= Yii::app()->baseUrl; ?>/images/shipping-box-icon.png" style="border-radius:20px; padding:2px; border:#FFF solid 2px;">
                        คลังสินค้า
                        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
                    </div>
                    <div class="list-group">
                        <?php
                        $produce_type = $product_model->_get_product_type();
                        foreach ($produce_type as $produce_types):
                            ?>
                            <a href="<?php echo Yii::app()->createUrl('backend/product/Getproduct/type_id/' . $produce_types['type_id']) ?>"
                               class="list-group-item">
                                <span class="label" style=" background: #24282d;"><?php echo $product_model->get_count_product_type($produce_types['type_id']); ?></span>
                                <?php echo $produce_types['type_name']; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- ทะเบียนผู้ป่วย-->
                <div class="panel panel-default" id="panel-head">
                    <div class="panel-heading" id="panel">
                        <img src="<?= Yii::app()->baseUrl; ?>/images/patients-icon.png" style="border-radius:20px; padding:2px; border:#FFF solid 2px;">
                        ทะเบียนลูกค้า
                        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
                    </div>
                    <div class="list-group">
                        <a href="<?= Yii::app()->createUrl('gradcustomer/index') ?>"
                           class="list-group-item"><i class="fa fa-group"></i> ประเภทลูกค้า</a>
                        <a href="<?= Yii::app()->createUrl('backend/typeproduct/from_add_type') ?>"
                           class="list-group-item"><i class="fa fa-plus"></i> เพิ่มทะเบียนลูกค้า</a>
                        <a href="<?= Yii::app()->createUrl('backend/product/index') ?>"
                           class="list-group-item"><i class="fa fa-search"></i> ค้นหาลูกค้า</a>
                    </div>
                </div>

                <!-- List รายชื่อ สินค้า -->
                <div class="panel panel-default" id="panel-head">
                    <div class="panel-heading" id="panel">
                        <img src="<?= Yii::app()->baseUrl; ?>/images/blog-icon.png" style="border-radius:20px; padding:2px; border:#FFF solid 2px; width: 32px;">
                        บทความ
                        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
                    </div>
                    <div class="list-group">
                        <a href="<?php echo Yii::app()->createUrl('backend/article/create') ?>" class="list-group-item">
                            <i class="fa fa-plus"></i> สร้างบทความ
                        </a>
                    </div>
                    <div class="list-group">
                        <a href="<?php echo Yii::app()->createUrl('backend/article') ?>" class="list-group-item">
                            <i class="fa fa-newspaper-o"></i> บทความทั้งหมด
                        </a>
                    </div>
                </div>

                <!-- รายการจัดส่งสินค้า -->
                <!-- List รายชื่อ สินค้า -->
                <div class="panel panel-default" id="panel-head">
                    <div class="panel-heading" id="panel">
                        <img src="<?= Yii::app()->baseUrl; ?>/images/front-icon.png" style="border-radius:20px; padding:2px; border:#FFF solid 2px; width: 32px;">
                        รหัสส่งสินค้า
                        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
                    </div>
                    <div class="list-group">
                        <?php
                        $notify = $product_model->get_notify_postcode();
                        foreach ($notify as $datas):
                            ?>
                            <a class="list-group-item">
                                <span class="glyphicon glyphicon-user"></span> คุณ <?php echo $datas['name'] . ' ' . $datas['lname']; ?><br/>
                                <span class="glyphicon glyphicon-send"></span>  <?php echo $datas['postcode'] ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <br/><br/>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper" style="padding:0px;">
                <nav class="navbar navbar-default" role="navigation" style="margin-bottom:10px; border-radius: 0px; padding-top: 3px;">
                    <ul class="nav nav-pills pull-right" style="margin:5px;">
                        <li><a href="<?php echo Yii::app()->createUrl('backend/orders/verify') ?>"><i class="fa fa-check-circle"></i> ตรวจสอบการชำระเงิน <span class="badge"><?php echo $order_model->count_verify(); ?> </span></a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('backend/orders/pendingshipment') ?>"><i class="fa fa-paper-plane-o"></i> รอจัดส่ง(แพ็กลงกล่อง) <span class="badge"><?php echo $order_model->count_wait_send(); ?> </span></a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('backend/orders/notification') ?>"><i class="fa fa-send"></i> แจ้งการส่งสินค้า <span class="badge"><?php echo $order_model->count_wait_inform(); ?> </span></a></li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">

                            <ol class="breadcrumb well well-sm" style=" margin-bottom: 10px; margin-top: 0px; border-radius: 0px;">

                                <?php if (isset($this->breadcrumbs)): ?>
                                    <?php
                                    $this->widget('zii.widgets.CBreadcrumbs', array(
                                        'homeLink' => CHtml::link('<i class=" glyphicon glyphicon-home"></i> หน้าหลัก', Yii::app()->createUrl('backend/backend')),
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

        <!-- popup -->
        <div id="overlay_popup">
            <center>
                <div id="show_slip"></div><br/>
            </center>
        </div>

        <!-- Menu Toggle Script -->
        <script>
            $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });

            function set_navbar(id) {
                var url = "<?php echo Yii::app()->createUrl('backend/backend/set_navbar') ?>"
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
        </script>
    </body>
</html>
