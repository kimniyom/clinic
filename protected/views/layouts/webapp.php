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
            echo $web->get_webname();
            ?>
        </title>

        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/themes/webapp/css/system.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/themes/webapp/bootstrap/css/bootstrap.css" type="text/css" media="all" />

        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/themes/webapp/bootstrap/css/bootstrap-theme.css" type="text/css" media="all" />

        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/themes/webapp/css/cart.css" type="text/css" media="all" />

        <script src="<?php echo Yii::app()->baseUrl; ?>/themes/webapp/js/jquery-1.9.1.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/themes/webapp/bootstrap/js/bootstrap.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/themes/webapp/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/themes/webapp/js/bootstrap-select.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/themes/webapp/js/bootstrap-dropdown.js" type="text/javascript"></script>

        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/font-awesome-4.3.0/css/font-awesome.css"/>

        <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/gallery_img/dist/magnific-popup.css" type="text/css" media="all" />
        <script type="text/javascript" charset="utf-8"src="<?php echo Yii::app()->baseUrl; ?>/assets/gallery_img/dist/jquery.magnific-popup.js"></script>

        <!-- Data table  -->
        <script type="text/javascript" charset="utf-8"src="<?php echo Yii::app()->baseUrl; ?>/assets/DataTables-1.10.7/media/js/jquery.dataTables.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/DataTables-1.10.7/media/css/jquery.dataTables.min.css" type="text/css" media="all" />

        <script type="text/javascript" charset="utf-8"src="<?php echo Yii::app()->baseUrl; ?>/assets/DataTables-1.10.7/extensions/TableTools/js/dataTables.tableTools.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/DataTables-1.10.7/extensions/TableTools/css/dataTables.tableTools.css" type="text/css" media="all" />

        <!-- highcharts -->
        <script src="<?= Yii::app()->baseUrl; ?>/assets/highcharts/highcharts.js"></script>
        <!--
        <script src="<//?= Yii::app()->baseUrl; ?>/assets/highcharts/themes/dark-unica.js"></script>
        -->

        <!-- JQuery UI -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/themes/webapp/css/Aristo/Aristo.css" />
        <script src="<?php echo Yii::app()->baseUrl; ?>/themes/webapp/js/vader/vader.js" type="text/javascript"></script>

        <!-- Banner -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/themes/webapp/css/jquery.bxslider.css" type="text/css" media="all" />
        <script src="<?php echo Yii::app()->baseUrl; ?>/themes/webapp/js/jquery.bxslider.js" type="text/javascript"></script>

        <!-- Bootstrap CheckBox -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap-checkbox/awesome-bootstrap-checkbox.css" type="text/css" media="all" />

        <!-- Uploadify -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/uploadify/uploadify.css" type="text/css" media="all" />
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>

        <!-- folio-->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/folio.css" type="text/css" media="all" />

        <!-- Hover Effect -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/hover-master/css/hover.css" />
        <script type="text/javascript">
            function chkNumber(ele) {
                var vchar = String.fromCharCode(event.keyCode);
                if ((vchar < '0' || vchar > '9') && (vchar != '.'))
                    return false;
                //ele.onKeyPress = vchar;
            }
        </script>

    </head>
    <?php
    //config
    $config = new configweb_model();
    $product_model = new Product();
    $product_type = $product_model->_get_product_type();
    $order_model = new Orders();
    $contact = new Contact();
    $message = new Message();
    $img = Yii::app()->baseUrl . "/images/";
    if (Yii::app()->session['member'] != "") {
        $user = Yii::app()->session['member'];
    }
    ?>

    <body <?php echo $config->GetBgWeb() ?>>
        <div id="wrap_blur">
            <!-- Basket-->
            <?php if (!empty(Yii::app()->session['status'])) { ?>
                <span class="navbar-brand" id="cart_box" data-toggle="popover"
                      data-trigger="hover" data-placement="bottom" data-trigger="focus"
                      data-content="ตะกร้า">
                    <a href="Javascript:void(0);" onclick="show_list_cart();" class="hvr-pulse">
                        <i class="shopping-cart"></i>
                    </a>
                    <div class="label label-success" id="load_inbox_cart"
                         style="text-align: center; font-size: 12px; position: absolute; top: 10px; right: 10px;">
                    </div>
                </span>
            <?php } ?>
            <!--<div class="container" style="margin-bottom:5%;"> navbar-fixed-top-->
            <nav class="navbar navbar-default" id="webname" role="navigation">
                <div class="container" id="head-bar">
                    <a class="navbar-brand" style=" margin-top: 0px; padding-top: 5px;">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $config->get_logoweb(); ?>" style="max-height: 48px;" class="img-responsive img-resize"/>
                    </a>
                    <a class="navbar-brand" href="#" style="font-size:48px; padding-top: 25px; font-family:RSU-Th;">
                        <?php echo $config->get_webname(); ?>
                    </a>
                </div>
                <br/>
            </nav>
            <div class="container">

                <nav class="navbar navbar-inverse" id="nav_bar" role="navigation">
                    <div class="container">
                        <div class="navbar-header" style="padding-left:10px;">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse" style="float:left;">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#" id="web_brand_name" style=" display: none;"><?php echo $config->get_webname(); ?></a>
                        </div>

                        <div class="collapse navbar-collapse navbar-ex1-collapse">
                            <ul class="nav navbar-nav">
                                <li class="hvr-underline-from-center">
                                    <a href="<?= Yii::app()->createUrl('frontend/main') ?>">
                                        <span class="glyphicon glyphicon-home"></span>
                                        <font id="font-th">หน้าหลัก</font></a>
                                </li>
                                <li class="hvr-underline-from-center">
                                    <a href="<?= Yii::app()->createUrl('frontend/payment') ?>">
                                        <span class="glyphicon glyphicon-usd"></span>
                                        <font id="font-th">วิธีการชำระเงิน</font></a>
                                </li>

                                <li class="hvr-underline-from-center">
                                    <a href="<?= Yii::app()->createUrl('site/howtoorder') ?>">
                                        <i class="fa fa-info-circle"></i>
                                        <font id="font-th">วิธีการสั่งซื้อ</font></a>
                                </li>

                                <?php if (Yii::app()->session['status'] == "U") { ?>
                                    <li class="hvr-underline-from-center">
                                        <a href="<?= Yii::app()->createUrl('frontend/orders/informpayment') ?>">
                                            <span class="glyphicon glyphicon-tasks"></span>
                                            <font id="font-th">แจ้งการโอนเงิน</font></a>
                                    </li>
                                <?php } ?>

                                <li class="hvr-underline-from-center">
                                    <a href="<?= Yii::app()->createUrl('site/about') ?>">
                                        <span class="glyphicon glyphicon-book"></span>
                                        <font id="font-th">เกี่ยวกับเรา</font></a>
                                </li>

                                <li class="hvr-underline-from-center">
                                    <a href="<?= Yii::app()->createUrl('frontend/contact') ?>">
                                        <span class="glyphicon glyphicon-phone-alt"></span>
                                        <font id="font-th">ติดต่อเรา</font></a>
                                </li>

                            </ul>
                            <?php if (Yii::app()->session['status'] != "") { ?>
                                <ul class="nav navbar-nav navbar-right" style=" padding-right: 10px;">
                                    <li class="hvr-underline-from-center">
                                        <a href="<?= Yii::app()->createUrl('site/logout/') ?>">
                                            <span class="glyphicon glyphicon-off"></span>
                                            <font id="font-th">ออกจากระบบ</font>
                                        </a>
                                    </li>
                                </ul>
                            <?php } else { ?>
                                <ul class="nav navbar-nav navbar-right" style=" padding-right: 10px;">
                                    <li class="hvr-underline-from-center">
                                        <a href="javascript:login();">
                                            <span class="glyphicon glyphicon-user"></span>
                                            <font id="font-th">เข้าสู่ระบบ</font></a>
                                    </li>
                                </ul>
                            <?php } ?>
                        </div><!-- /.navbar-collapse -->
                    </div>
                </nav>
            </div>
            <br/>

            <!--
            #################################### MenuLeft ####################################
            -->
            <div class="container" id="content">

                <!-- Box Search -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ทุกประเภท <span class="caret"></span></button>
                                    <input type="hidden" id="type_id">
                                    <ul class="dropdown-menu">
                                        <?php
                                        foreach ($product_type as $searchtype):
                                            $type_id = $searchtype['type_id'];
                                            ?>
                                            <li><a href="javascript:set_type('<?php echo $type_id ?>');"><?php echo $searchtype['type_name'] ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div><!-- /btn-group -->
                                <input type="text" class="form-control" id="search" placeholder="คำค้น,ชื่อสินค้า">
                                <div class="input-group-addon btn btn-default" onclick="search()"><i class="fa fa-search"></i> ค้นหา</div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-12 col-md-3 col-lg-3">

                        <!-- #################### รถเข็น #############-->
                        <?php if (Yii::app()->session['status'] == 'U') { ?>
                            <div class="panel panel-default" id="font-20">
                                <div class=" panel-heading">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/Cart-icon.png" style="border-radius:20px; padding:2px; border:#FFF solid 2px;"/> ตะกร้าสินค้า
                                </div>
                                <div class="panel-body" id="box_cart">

                                </div>
                                <div class=" panel-footer">
                                    <a href="<?= Yii::app()->createUrl('frontend/orders/order_list/order_id/' . Yii::app()->session['order_id']) ?>">
                                        <i class="fa fa-shopping-cart"></i>
                                        ดูรายการสินค้า</a>
                                    <div class="pull-right">
                                        <a href="javascript:load_box_cart()" style=" float: right;"><span class="glyphicon glyphicon-refresh"></span></a>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                        <div class="sidebar-nav" style="border-radius: 5px;">
                            <div class="navbar navbar-default" role="navigation">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <span class="visible-xs navbar-brand">เมนู</span>
                                </div>
                                <div class="navbar-collapse collapse sidebar-navbar-collapse" style="padding:0px; padding-right:0px;">

                                    <!--###################### USER #################-->
                                    <?php if (Yii::app()->session['status'] != '') { ?>
                                        <div class="panel panel-default" style="margin: 0px; border: none; border-radius:0px; ">
                                            <div class=" panel-heading">
                                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/use-icon.png" style="border-radius:20px; padding:2px; border:#FFF solid 2px;"> ผู้ใช้งาน
                                            </div>
                                            <div class=" panel-body">
                                                ชื่อ : <?= Yii::app()->session['username'] ?><br>
                                                สถานะ : <?php
                                                if (Yii::app()->session['status'] == 'U') {
                                                    echo "สมาชิก";
                                                } else {
                                                    echo "ผู้ใช้งานทั่วไป";
                                                }
                                                ?><br/>
                                            </div>
                                            <div class=" panel-footer">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <a href="<?= Yii::app()->createUrl('frontend/user/detail/'); ?>">
                                                            <div class="btn btn-default" style=" width: 100%;"><i class="fa fa-user"></i> ข้อมูลส่วนตัว</div>
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <!-- Single button  notification-->
                                                        <button type="button" class="btn btn-default" style="width: 100%;" onclick="notification()">
                                                            <i class="fa fa-envelope"></i>
                                                            ข้อความ <span class="badge"><?php echo $message->Count_message(Yii::app()->session['pid']); ?></span> 
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <!-- List รายชื่อ สินค้า -->
                                    <div class="panel panel-default" id="font-20" style="border: none; border-radius:0px; border-top: solid  #dddddd 1px; ">
                                        <div class=" panel-heading">
                                            <img src="<?php echo Yii::app()->baseUrl; ?>/images/shipping-box-icon.png" style="border-radius:20px; padding:2px; border:#FFF solid 2px;"> ประเภทสินค้า
                                        </div>
                                        <div class="list-group">
                                            <?php
                                            foreach ($product_type as $product_types):
                                                ?>
                                                <a href="<?php echo Yii::app()->createUrl('frontend/product/view/type/' . $config->url_encode($product_types['type_id'])) ?>"
                                                   class="list-group-item hvr-curl-top-left" style="margin: 0px; border: none; border-radius:0px; width:100%;"><span class="glyphicon glyphicon-paperclip"></span>
                                                    <font id="font-20"><?= $product_types['type_name'] ?></font>
                                                    <span class="badge" style=" margin-top: 5px;">
                                                        <?php echo $product_model->get_count_product_type($product_types['type_id']); ?>
                                                    </span></a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <!-- รายการจัดส่งสินค้า -->
                                    <div class="panel panel-default" id="font-20" style="border: none; border-radius:0px; border-top: solid  #dddddd 1px; ">
                                        <div class=" panel-heading">
                                            <img src="<?php echo Yii::app()->baseUrl; ?>/images/post-icon.png" style="border-radius:20px; padding:2px; border:#FFF solid 2px;"> รหัสส่งสินค้า
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

                                    <!-- POSTS CODE-->
                                    <center>
                                        <div class="btn btn-default" style="border-radius: 0px; border: none; width:100%;">
                                            <img src="<?php echo Yii::app()->baseUrl; ?>/images/post.jpg" class="img-responsive img-resize"/>
                                        </div>
                                    </center>

                                </div><!--/.nav-collapse -->
                            </div>
                        </div>

                        <?php if (Yii::app()->session['status'] == "") { ?>
                            <a href="#" style="text-decoration:none; color:#666; text-shadow:#FFF 1px 1px;" onclick="login();">
                                <div id="member" style="width:100%; height:50px; border:#999 solid 1px; padding:5px; font-size:20px; background:url(<?php echo Yii::app()->baseUrl; ?>/images/bg_head.png)">
                                    <div class="btn btn-info" style="border-radius:50px; padding:7px;"><img src="<?php echo Yii::app()->baseUrl; ?>/images/use-icon.png"/></div>สำหรับสมาชิก
                                </div>
                            </a>
                            <a href="<?= Yii::app()->createUrl('frontend/main/register') ?>" style="text-decoration:none; color:#666; text-shadow:#FFF 1px 1px;">
                                <div id="member" style="width:100%; height:50px; border:#999 solid 1px; padding:5px; font-size:20px; background:url(<?php echo Yii::app()->baseUrl; ?>/images/bg_head.png)">
                                    <div class="btn btn-danger" style="border-radius:50px; padding:7px;"><img src="<?php echo Yii::app()->baseUrl; ?>/images/Register-icon.png"/></div>สมัครสมาชิก
                                </div>
                            </a>
                            <br>
                        <?php } ?>

                    </div><!-- End Menu Left -->

                    <!-- Start Content -->
                    <div class="col-sm-12 col-md-9 col-lg-9">

                        <?php if (isset($this->breadcrumbs)): ?>

                            <div class="breadcrumb" style=" margin-bottom: 0px; margin-top: 0px; box-shadow:0px 0px 2px 0px #999999; background:#FFF;" id="font-22">

                                <?php
                                $this->widget('zii.widgets.CBreadcrumbs', array(
                                    'homeLink' => '<i class="fa fa-home"></i> ' . CHtml::link('หน้าแรก', Yii::app()->createUrl('frontend/main')),
                                    'links' => $this->breadcrumbs,
                                ));
                                ?><!-- breadcrumbs -->
                            </div>
                        <?php endif ?>


                        <?php
                        echo $content;
                        ?>
                    </div> <!-- End Contant -->
                </div>

                <!--
                <div id="co_left"
                     style="width:20%;height:100%;
                     margin-bottom:5%;
                     float:left;
                     background:#FFF;
                     border:#FFF solid 1px;
                     border-radius:0px;
                     padding:5px; z-index:2;">
                </div>
                -->

                <!-- START CONTENER
                <div class="right_box" style="width:79%;float:right; border:#FFF solid 7px; background:#f4f4f4; margin-bottom:5%; border-radius:0px; padding:0px;">

                </div>
                END CONTENER -->
            </div>
            <?php $con = $contact->gat_contact(); ?>
            <nav class="navbar navbar-default" role="navigation" id="page-footer">
                <div class="container" style="padding-top:20px;">
                    <div class="row" style=" margin: 0px;">
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <p style=" color: #cccccc; font-size: 20px; font-weight: bold;">
                                เมนู<br/>
                            </p>
                            <ul id="menu-footer">
                                <li class="hvr-buzz-out"><a href="<?= Yii::app()->createUrl('frontend/main') ?>">หน้าแรก</a></li><br/>
                                <li class="hvr-buzz-out"><a href="<?= Yii::app()->createUrl('frontend/payment') ?>">วิธีชำระเงิน</a></li><br/>
                                <li class="hvr-buzz-out"><a href="<?= Yii::app()->createUrl('site/howtoorder') ?>">วิธีสั่งซื้อ</a></li><br/>
                                <li class="hvr-buzz-out"><a href="<?= Yii::app()->createUrl('site/about') ?>">เกี่ยวกับเรา</a></li><br/>
                                <li class="hvr-buzz-out"><a href="<?= Yii::app()->createUrl('frontend/contact') ?>">ติดต่อเรา</a></li>
                            </ul>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-5">
                            <p style=" color: #cccccc; font-size: 20px; font-weight: bold;">
                                สอบถามข้อมูลได้ที่<br/>
                            </p>
                            <div class="row">
                                <div class="col-sm-2">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/Phone-icon.png" style="max-width:36px;"/>
                                </div>
                                <div class="col-sm-10">
                                    <p style=" color: #FFF; font-size: 24px; font-weight: bold;">
                                        <?php echo $con['tel'] ?><br/>
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-2">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/Mail-icon.png" style="max-width:36px;"/>
                                </div>
                                <div class="col-sm-10">
                                    <p style=" color: #FFF; font-size: 24px; font-weight: bold;">
                                        <?php echo $con['email'] ?>
                                    </p>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <p style=" color: #cccccc; font-size: 20px; font-weight: bold;">
                                เป็นเพื่อนกับเรา<br/>
                            </p>

                            <div class="row">
                                <?php $social = $contact->get_social_media(); ?>
                                <?php
                                foreach ($social as $datas):
                                    if (substr($datas['account'], 0, 4) != "http") {
                                        $account = $datas['account'];
                                    } else {
                                        $account = "<a href='" . $datas['account'] . "'>" . $datas['social_app'] . "</a>";
                                    }
                                    ?>
                                    <div class="col-xs-12 col-sm-3 col-md-3 col-md-3">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/<?php echo $datas['icon'] ?>" width="52" class="hvr-buzz-out"/>
                                        <?php echo $account ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </div>
                    <hr/>
                    <div class="row" style="margin:0px; text-align: center;">
                        <div class="col-lg-4 col-md-4">
                            <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $config->get_logoweb(); ?>" style="max-height: 24px; margin-bottom: 5px;"/>
                            <?php echo $config->get_webname(); ?>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <a href="http://www.theassembler.net/" target="_bank" class="hvr-buzz-out" style=" text-decoration: none; color: #FFF;">
                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/assembler_logo.png" style="max-height: 24px; margin-bottom: 5px;"/>
                                &COPY; The Assembler
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            Shopping Cart เวอร์ชั่น 1.0
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!--- ################ Noify ###############-->
        <div id="notification">
            <a href="javascript:close_notification()">
                <i class="fa fa-remove pull-right btn btn-danger" style=" border-radius: 0px; border: none;"></i>
            </a>
            <br/>
            <h4><i class="fa fa-envelope-o"></i> ข้อความ</h4>
            <?php
            $msg_short = $message->Get_message_short(Yii::app()->session['pid']);
            foreach ($msg_short as $m_short):
                ?>
                <a href="<?php echo Yii::app()->createUrl('frontend/message/detail/id/' . $m_short['id']) ?>">
                    <div class="nt-list">
                        <div class="row" style=" margin: 0px;">
                            <div class="col-xs-1 col-sm-1 col-md-1">
                                <i class="fa fa-info-circle"></i>
                            </div>
                            <div class="col-xs-10 col-sm-10 col-md-10">
                                <?php
                                if (strlen($m_short['message']) <= 40) {
                                    echo $m_short['message'];
                                } else {
                                    echo iconv_substr($m_short['message'], 0, 40, "UTF-8");
                                }
                                ?>
                            </div>
                        </div>
                    </div></a>
            <?php endforeach; ?>

            <div id="notify-footer">
                <a href="<?php echo Yii::app()->createUrl('frontend/message') ?>"><i class="fa fa-folder-o fa-2x"></i> ข้อความทั้งหมด</a>
            </div>
        </div>
    </body>

</html>

<?php
require_once(Yii::app()->basePath . '/views/main/dialogbox.php');
?>

<script type="text/javascript">
    function notification() {
        //$("#notification").fadeIn();
        //$( "#notification" ).toggle( "slide" );
        $("#notification").show("slide", {direction: "left"}, 250);
    }

    function close_notification() {
        $("#notification").hide("slide", {direction: "left"}, 250);
    }

    $("#notification").click(function () {
        close_notification();
    });
</script>
