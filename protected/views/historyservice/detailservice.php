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
            $Profile = $UserModel->GetProfileByID($model['user_id']);
            $web = new Configweb_model();
            $Pername = new Pername();
            $oid = $patient['oid'];
            $shotname = $Pername->find("oid = '$oid' ")['pername'];
            $branchModel = new Branch();
            echo $web->get_webname();


            if (!empty($patient['images'])) {
                $img_profile = "uploads/profile/" . $patient['images'];
            } else {
                if ($patient['sex'] == 'M') {
                    $img_profile = "images/Big-user-icon.png";
                } else if ($patient['sex'] == 'F') {
                    $img_profile = "images/Big-user-icon-female.png";
                } else {
                    $img_profile = "images/Big-user.png";
                }
            }
            ?>
        </title>
        <style type="text/css">
            body{
                overflow-x: hidden;
            }

            #font-18{
                color: #009900;
            }
        </style>
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/service/css/system.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/service/bootstrap/css/bootstrap.css" type="text/css" media="all" />
        <!--
                <link rel="stylesheet" href="<?//= Yii::app()->baseUrl; ?>/themes/backend/css/bootstrap-theme.css" type="text/css" media="all" />
        -->
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/assets/gallery_img/dist/magnific-popup.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/assets/DataTables-1.10.7/media/css/dataTables.bootstrap.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/assets/DataTables-1.10.7/extensions/TableTools/css/dataTables.tableTools.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/font-awesome-4.3.0/css/font-awesome.css"/>
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/service/css/simple-sidebar.css"/>
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/assets/perfect-scrollbar/css/perfect-scrollbar.css"/>
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/css/card-css/card-css.css"/>
        <!-- Bootstrap CheckBox
        <link rel="stylesheet" href="<?//php echo Yii::app()->baseUrl; ?>/css/bootstrap-checkbox/awesome-bootstrap-checkbox.css" type="text/css" media="all" />
        -->

        <script src="<?= Yii::app()->baseUrl; ?>/themes/service/js/jquery-1.9.1.js" type="text/javascript"></script>
        <script src="<?= Yii::app()->baseUrl; ?>/themes/service/bootstrap/js/bootstrap.js" type="text/javascript"></script>

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
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/lib/uploadify/uploadify.css" type="text/css" media="all" />
        <script src="<?php echo Yii::app()->baseUrl; ?>/lib/uploadify/jquery.uploadify.js" type="text/javascript"></script>

        <!-- FancyBox -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/lib/fancyBox/source/jquery.fancybox.css" type="text/css" media="all" />
        <script src="<?php echo Yii::app()->baseUrl; ?>/lib/fancyBox/source/jquery.fancybox.js" type="text/javascript"></script>

        <!-- DateTimPicker -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/lib/bootstrap-datepicker/css/bootstrap-datepicker.css" type="text/css" media="all" />
        <script src="<?php echo Yii::app()->baseUrl; ?>/lib/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/lib/bootstrap-datepicker/locales/bootstrap-datepicker.th.min.js" type="text/javascript"></script>

        <!-- Sweetalert -->
        <!-- FancyBox -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/lib/sweet-alert/sweetalert.css" type="text/css" media="all" />
        <script src="<?php echo Yii::app()->baseUrl; ?>/lib/sweet-alert/sweetalert.min.js" type="text/javascript"></script>

    </head>

    <body>
        <!--<div class="container" style="margin-bottom:5%;">-->
        <nav class="navbar navbar-default" role="navigation" style="z-index:1; border-radius:0px; margin-bottom:0px;"></nav>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="border-radius:0px; margin-bottom:0px; background: #2a323b;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" style=" margin-top: 0px; padding-top: 10px;">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_profile; ?>" height="24px" class="img img-circle"/>
                    </a>
                    <a class="navbar-brand" href="#" style=" font-family: Th;font-size:28px;">
                        <?php echo $shotname . $patient['name'] . " " . $patient['lname']; ?>
                    </a>

                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a><font id="font-th">หัตถการ : <?php echo $diag['diagname'] ?></font></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-signal"></span>
                                <font id="font-th">รายงาน </font><b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#"> - รายงานยอดขาย</a></li>
                                <li><a href="#"> - รายงานการขายสินค้า</a></li>
                                <li><a href="#"> - รายงานการขายสินค้า(แยกประเภท)</a></li>
                                <li><a href="#"> - รายงานรายได้ กำไร ขาดทุน</a></li>
                                <li><a href="#"> - รายงานการขายของพนักงาน</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="fa fa-gear"></span>
                                <font id="font-th">ตั้งค่าระบบ </font><b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo Yii::app()->createUrl('backend/typeproduct/from_add_type') ?>"> - ประเภทสินค้า</a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('diag/index') ?>"> - หัตถการทางการแพทย์</a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('occupation/index') ?>"> - อาชีพ</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>



        <nav class="navbar navbar-default" role="navigation" style="margin-bottom:10px; border-radius: 0px; padding-top: 3px;">
            <ul class="nav nav-pills pull-left" style="margin:5px;">
                <li>
                    <a style=" background: #7a7a7a; color: #FFFFFF;">
                        <i class="fa fa-user"></i> ลูกค้า : 
                        <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_profile; ?>" height="20px" class="img img-circle" style=" margin: 0px; padding: 0px;"/>
                        <?php echo $shotname . $patient['name'] . " " . $patient['lname']; ?></a>
                </li>
                <li>
                    <a style=" background: #7a7a7a; color: #FFFFFF;">
                        <i class="fa fa-stethoscope"></i> หัตถการ : <?php echo $diag['diagname']; ?></a>
                </li>
                <li>
                    <a style=" background: #7a7a7a; color: #FFFFFF;">
                        <i class="fa fa-user-md"></i>
                        ผู้ให้บริการ : <?php echo $Profile['name'] . " " . $Profile['lname']; ?></a>
                </li>
                <li>
                    <a style=" background: #7a7a7a; color: #FFFFFF;">
                        <i class="fa fa-calendar"></i>
                        วันที่รับบริการ : <?php echo $web->thaidate($model['service_date'])?></a>
                </li>
            </ul>
            <ul class="nav nav-pills pull-right" style="margin:5px;">
                <li>
                    <a style=" background: #ea4c4c; color: #FFFFFF;">
                        SEQ : <?php echo $serviceSEQ; ?></a>
                </li>
            </ul>
        </nav>

        <input type="hidden" id="patient_id" value="<?php echo $patient['id'] ?>"/>
        <input type="hidden" id="diagcode" value="<?php echo $diag['diagcode'] ?>"/>

        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-user"></i> ข้อมูลพื้นฐาน</a></li>
                <li role="presentation"><a href="#checkbody" aria-controls="profile" role="tab" data-toggle="tab" onclick="Getcheckbody()"><i class="fa fa-child"></i> ผลตรวจร่างกาย</a></li>
                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" onclick="GetformServece('<?php echo $patient['id'] ?>')"><i class="fa fa-save"></i> บันทึกการตรวจ</a></li>
                <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" onclick="GetformAppoint()"><i class="fa fa-calendar"></i> นัดลูกค้า</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="panel panel-default" style=" border-top: none;">
                        <div class="panel-heading" style=" border-top: none;">
                            <i class="fa fa-user"></i> ข้อมูลพื้นฐาน
                        </div>
                        <div class="row" style="margin:0px;">
                            <div class="col-md-3 col-lg-3" style="text-align: center;">

                                <center>
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_profile; ?>" class="img-responsive img-thumbnail" id="img_profile" style=" margin-top: 5px; max-height: 200px;"/>
                                </center>
                            </div>
                            <div class="col-md-9 col-lg-9" style="padding-right: 0px;">
                                <div class="well" style="margin: 5px; background: none;" id="font-20">
                                    PID
                                    <p class="label" id="font-18">
                                        <?php echo $patient['pid'] ?>
                                    </p><br/>
                                    ชื่อ - สกุล 
                                    <p class="label" id="font-18">
                                        <?php echo Pername::model()->find("oid = '$patient->oid'")['pername'] ?>
                                        <?php echo $patient['name'] . ' ' . $patient['lname'] ?></p><br/>
                                    เลขบัตรประชาชน <p class="label" id="font-18"><?php echo $patient['card'] ?></p><br/>
                                    เพศ <p class="label" id="font-18"><?php
                                        if ($patient['sex'] == 'M') {
                                            echo "ชาย";
                                        } else {
                                            echo "หญิง";
                                        }
                                        ?></p>

                                    เกิดวันที่ <p class="label" id="font-18"><?php
                                        if (isset($patient['birth'])) {
                                            echo $web->thaidate($patient['birth']);
                                        } else {
                                            echo "-";
                                        }
                                        ?></p>
                                    อายุ <p class="label" id="font-18"><?php
                                        if (isset($patient['birth'])) {
                                            echo $web->get_age($patient['birth']);
                                        } else {
                                            echo "-";
                                        }
                                        ?></p> ปี<br/>
                                    อาชีพ <p class="label" id="font-18"><?php
                                        $occ = $patient['occupation'];
                                        echo Occupation::model()->find("id = '$occ' ")['occupationname'];
                                        ?></p><br/>

                                    สถานที่รับบริการ <p class="label" id="font-18"><?php
                                        echo "สาขา " . $branchModel->Getbranch($patient['branch']);
                                        ?></p>
                                    ประเภทลูกค้า <p class="label" id="font-18"><?php
                                        echo Gradcustomer::model()->find($patient['type'])['grad'];
                                        ?></p><br/>
                                    วันที่ลงทะเบียน <p class="label" id="font-18"><?php
                                        if (isset($patient['create_date'])) {
                                            echo $web->thaidate($patient['create_date']);
                                        } else {
                                            echo "-";
                                        }
                                        ?></p>
                                    ข้อมูลอัพเดทวันที่ <p class="label" id="font-18"><?php
                                        if (isset($patient['d_update'])) {
                                            echo $web->thaidate($patient['d_update']);
                                        } else {
                                            echo "-";
                                        }
                                        ?></p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="checkbody"><div id="patientcheckbody"></div></div>
                <div role="tabpanel" class="tab-pane" id="messages"><div id="patientservice"></div></div>
                <div role="tabpanel" class="tab-pane" id="settings"><div id="patientappoint"></div></div>
            </div>

        </div>





        <!-- Menu Toggle Script -->
        <script type="text/javascript">
            $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });


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


            function Getcheckbody() {
                var url = "<?php echo Yii::app()->createUrl('checkbody/historyview') ?>";
                var patient_id = "<?php echo $model['patient_id'] ?>";
                var date = "<?php echo $model['checkbody']?>";
                var data = {patient_id: patient_id,date: date};
                $.post(url, data, function (result) {
                    $("#patientcheckbody").html(result);
                });
            }

            function GetformServece() {
                var seq = "<?php echo $serviceSEQ ?>";
                var url = "<?php echo Yii::app()->createUrl('service/formservice') ?>" + "&seq=" + seq;
                $("#patientservice").load(url);
            }

            function GetformAppoint() {
                var seq = "<?php echo $serviceSEQ ?>";
                var url = "<?php echo Yii::app()->createUrl('appoint/formappoint') ?>" + "&seq=" + seq;
                $("#patientappoint").load(url);
            }

        </script>
    </body>
</html>
