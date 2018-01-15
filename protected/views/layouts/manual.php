<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>คู่มือการใช้งาน</title>
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/themes/dortor/css/template.css"/>
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/css/button-color.css"/>
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/themes/dortor/css/system.css"/>
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/dortor/bootstrap/css/bootstrap.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/dortor/bootstrap/css/bootstrap-theme.css" type="text/css" media="all" />

        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/assets/gallery_img/dist/magnific-popup.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/media/css/dataTables.bootstrap.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/extensions/Buttons/css/buttons.dataTables.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/lib/DataTables-1.10.13/extensions/Buttons/css/buttons.bootstrap.css" type="text/css" media="all" />

        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/font-awesome-4.3.0/css/font-awesome.css"/>
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/font-awesome-4.3.0/css/font-awesome-animation.css"/>
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/themes/dortor/css/simple-sidebar.css"/>
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/assets/perfect-scrollbar/css/perfect-scrollbar.css"/>
        <link rel="stylesheet" href="<?= Yii::app()->baseUrl; ?>/css/card-css/card-css.css"/>

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
        <script src="<?= Yii::app()->baseUrl; ?>/assets/perfect-scrollbar/js/perfect-scrollbar.js"></script>

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

        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/themes/dortor/assets/jquery-easyui/themes/default/easyui.css"/>
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/themes/dortor/assets/jquery-easyui/themes/icon.css"/>
        <script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/themes/dortor/assets/jquery-easyui/jquery.easyui.min.js"></script>

    </head>

    <body>
        <div id="cc" class="easyui-layout" style="width:100%;">
            <div data-options="region:'north'" style="height:80px; padding-left: 10px;">
                <h1><i class="fa fa-book"></i> คู่มือการใช้งานระบบ</h1>
            </div>
            <div data-options="region:'west',split:true" title="เมนู" style="width:200px; padding-bottom: 5px;">
                <ul class="easyui-tree">
                    <li>
                        <span>คู่มือการใช้งาน</span>
                        <ul>
                            <!--<li data-options="state:'closed'">-->
                            <li>
                                <span>ตั้งค่าระบบ</span>
                                <ul>
                                    <li>
                                        <a href=""><span>หมวด / ประเภทสินค้า</span></a>
                                    </li>
                                    <li>
                                        <a href=""><span>หัตถการทางการแพทย์</span></a>
                                    </li>
                                    <li>
                                        <a href=""><span>ประเภทลูกค้า</span></a>
                                    </li>
                                    <li>
                                        <a href=""><span>ตำแหน่งพนักงาน</span></a>
                                    </li>
                                    <li>
                                        <a href=""><span>ตั้งค่าแจ้งเตือน</span></a>
                                    </li>
                                    <li>
                                        <a href=""><span>รูปภาพสินค้า</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <span>ข้อมมูลสาขา</span>
                                <ul>
                                    <li><a href=""><span>เพิ่ม / ลบ / แก้ไข</span></a></li>
                                </ul>
                            </li>
                            <li><a href=""><span>ผู้ใช้งานระบบ</span></a></li>
                            <li><a href=""><span>ข้อมูลพนักงาน</span></a></li>
                            <li><a href=""><span>กำหนดสิทธิ์ User</span></a></li>
                            <li>
                                <span>คลังสินค้าสาขา</span>
                                <ul>
                                    <li><a href=""><span>สต๊อกสินค้า</span></a></li>
                                    <li><a href=""><span>รายการสินค้า</span></a></li>
                                    <li><a href=""><span>ใบสั่งซื้อสินค้า</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <span>คลังสินค้าหลัก</span>
                                <ul>
                                    <li><a href=""><span>ข้อูล ที่อยู่ คลังสินค้า</span></a></li>
                                    <li><a href=""><span>หน่วยนับสินค้า</span></a></li>
                                    <li><a href=""><span>บริษัทสั่งซื้อวัตถุดิบ</span></a></li>
                                    <li><a href=""><span>รายการวัตถุดิบ</span></a></li>
                                    <li><a href=""><span>สต๊อกวัตถุดิบ</span></a></li>
                                    <li><a href=""><span>หน่วยนับวัตถุดิบ</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <span>ทะเบียนลูกค้า</span>
                                <ul>
                                    <li><a href=""><span>เพิ่มทะเบียนลูกค้า</span></a></li>
                                    <li><a href=""><span>แก้ไขทะเบียนลูกค้า</span></a></li>
                                    <li><a href=""><span>อาการแพ้ยา</span></a></li>
                                    <li><a href=""><span>โรคประจำตัว</span></a></li>
                                    <li><a href=""><span>ประวัติการใช้บริการ</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <span>ขายสินค้าหน้าร้าน</span>
                                <ul>
                                    <li><a href=""><span>บันทึกรายการขาย</span></a></li>
                                    <li><a href=""><span>พิพมพ์ใบเสร็จ</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <span>ตารางนัดลูกค้า</span>
                                <ul>
                                    <li><a href=""><span>บันทึกรายการนัด</span></a></li>
                                    <li><a href=""><span>พิพมพ์ใบนัด</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <span>คิวลูกค้า</span>
                                <ul>
                                    <li data-options="state:'closed'">
                                        <span>สำหรับพนังงาน</span>
                                        <ul>
                                            <li><a href=""><span>เพิ่มควการรักษา</span></a></li>
                                            <li><a href=""><span>บันทึกค่าใช้จ่าย</span></a></li>
                                        </ul>
                                    </li>
                                    <li data-options="state:'closed'">
                                        <span>สำหรับแพทย์</span>
                                        <ul>
                                            <li><a href=""><span>บันทึกการรักษา</span></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <span>ใบสั่งซื้อสินค้า</span>
                                <ul>
                                    <li data-options="state:'closed'">
                                        <span>พนังงาน / ผู้จัดการ</span>
                                        <ul>
                                            <li><a href=""><span>สร้างใบสั่งซื้อ</span></a></li>
                                        </ul>
                                    </li>
                                    <li data-options="state:'closed'">
                                        <span>ผู้ดูแลคลังสินค้าหลัก</span>
                                        <ul>
                                            <li><a href=""><span>ตรวจสอบยืนยัน</span></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href=""><span>ค้นหาสินค้า</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div data-options="region:'center',title:'เนื้อหา'" style=" padding: 5px;">
                <?php echo $content ?>
            </div>
        </div>

        <script type="text/javascript">
            Setscreen();
            function Setscreen() {
                var screen = $(window).height();
                //var contentboxsell = $("#content-boxsell").height();
                var screenfull = (screen);
                $("#cc").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '0px'});
                //$("#patientbox").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF'});
                //$("#boxorders").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF', 'overflow': 'auto', 'padding-left': '10px'});

            }
        </script>
    </body>
</html>
