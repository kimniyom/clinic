<script type="text/javascript">
    function login() {
        var url = "<?php echo Yii::app()->createUrl('frontend/main/from_login') ?>";
        $("#from_Login").load(url);
        $("#Login").modal();
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        if ($(window).width() > 786) {
            var styles = {
                "margin-top": "0px"
            };
            $(".breadcrumb").css(styles);
            $('#web_brand_name').hide();
            $('#webname').show();
            $("#c-box-search").show();
            $(window).scroll(function () {
                console.log($(window).scrollTop())
                if ($(window).scrollTop() > 100) {
                    $('#nav_bar').addClass('navbar-fixed-top');
                    //$('#web_brand_name').show();
                    return false;
                } else {
                    $('#nav_bar').removeClass('navbar-fixed-top');
                    $('#web_brand_name').hide();
                    $('#webname').show();
                }
            });

        } else {
            var styles = {
                "margin-top": "35px"
            };
            $(".breadcrumb").css(styles);
            $('#webname').hide();
            $('#web_brand_name').show();
            $('#nav_bar').addClass('navbar-fixed-top');
            $("#c-box-search").hide();
        }

        $(window).resize(function () {

            if ($(window).width() > 786) {
                var styles = {
                    "margin-top": "0px"
                };
                $(".breadcrumb").css(styles);
                $('#web_brand_name').hide();
                $("#c-box-search").show();
                $('#webname').show();
                $(window).scroll(function () {
                    console.log($(window).scrollTop())
                    if ($(window).scrollTop() > 100) {
                        $('#nav_bar').addClass('navbar-fixed-top');
                        $('#web_brand_name').show();
                    } else {
                        $('#nav_bar').removeClass('navbar-fixed-top');
                        $('#web_brand_name').hide();
                        $('#webname').show();
                    }
                });
            } else {
                var styles = {
                    "margin-top": "35px"
                };
                $(".breadcrumb").css(styles);
                $("#c-box-search").hide();
                $(window).scroll(function () {
                    console.log($(window).scrollTop())
                    if ($(window).scrollTop() > 100) {
                        $('#nav_bar').addClass('navbar-fixed-top');
                        $('#web_brand_name').show();
                        $('#webname').hide();
                    } else {
                        $('#nav_bar').addClass('navbar-fixed-top');
                        $('#web_brand_name').show();
                        $('#webname').hide();
                    }
                });
            }


        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        var style = {"height": "auto"};
        $("#box-article img").addClass("img-responsive");
        $("#box-article img").css(style);
    });
</script>


<!-- Modal LogIN-->
<div class="modal fade" id="Login" tabindex="2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" style=" margin-top: 3%;">
        <div class="modal-content" style="border-radius: 0px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h2 class="modal-title" id="myModalLabel">
                    <i class="fa fa-key"></i>
                    เข้าสู่ระบบ
                </h2>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <center>
                            <p id="font-rsu-22">ระบบสมาชิก</p>
                            <?php
                            $web = new Configweb_model();
                            ?>
                            <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $config->get_logoweb(); ?>" 
                                 style="max-height: 48px;" class="img-responsive img-resize"/><br/>
                            <?php echo $config->get_webname(); ?><br/><br/>
                            สมาชิกใหม่ ?
                            <a href="<?php echo Yii::app()->createUrl('frontend/main/register/'); ?>"><br/><br/>
                                <button type="button" class="btn btn-warning">? ลงทะเบียนสมาชิก</button></a><br />
                        </center>
                    </div>
                    <div class="col-lg-6 col-md-6" style="border-left:solid 1px #eeeeee;">
                        <div id="from_Login"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div id="error"style="display:none; font-size: 14px; text-align: center;">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/themes/webapp/images/error.png"/> กรอกรข้อมูลให้ครบทุกช่อง ... ?
                </div>
                <div id="errorlog" style="display:none; font-size: 14px; text-align: center;">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/themes/webapp/images/error.png"/> ไม่มีรายชื่อในบัญชี ... !
                </div>
            </div>
        </div>
    </div>
</div>

<!--
       cart list แสดงรายการตระกร้าสินค้า
-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="cartlist">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius:0px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/full-shopping-cart-icon.png"/>
                    <font style="padding-top: 10px;" id="font-rsu-20">ตะกร้าสินค้า</font>
                </h5>
            </div>
            <div id="load_cart"></div>
        </div>
    </div>
</div>
<!--
    End cart list
-->

<!-- Modal Edit Address เรียกFormแก้ไขที่มาแสดงจากหน้ารายการสั่งซื้อที่รอการชำระ-->
<div class="modal fade" id="edit_address">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fa fa-home"></i> แก้ไขที่อยู่
                </h4>
            </div>
            <div class="modal-body">
                <div id="show_address"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> ปิดหน้านี้</button>
                <button type="button" class="btn btn-primary" onclick="save_address()"><i class="fa fa-save"></i> แก้ไขที่อยู่</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Dialog Basket เรียกดูรายการสินค้าจากหน้าข้อมูลส่วนตัว-->
<div class="modal fade bs-example-modal-lg" id="popup_basket">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style=" border-radius:0px; ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-cart-arrow-down"></i> รายการสินค้า <font id="h_order"></font></h4>
            </div>

            <div id="basket"></div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Popup_update_profile ฟอร์มแก้ไขข้อมูลส่วนตัว-->
<div class="modal fade" id="popup_update_profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fa fa-edit"></i> แก้ไขข้อมูล
                </h4>
            </div>
            <div class="modal-body">
                <div id="update_profile"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Edit Address Profile เรียกFormแก้ไขที่อยู่มาแสดงจากหน้าข้อมูลส่วนตัว-->
<div class="modal fade" id="edit_address_profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fa fa-home"></i> แก้ไขที่อยู่
                </h4>
            </div>
            <div class="modal-body">
                <div id="show_address_profile"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- แก้ไข comment-->
<div class="modal fade" id="popup_update_comment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fa fa-comment"></i> แก้ไขความคิดเห็น
                </h4>
            </div>
            <div class="modal-body">
                <div id="show_comment"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    function show_list_cart() {
        $("#load_cart").html("<center><i class=\"fa fa-spinner fa-spin\"></i></center>");
        $("#cartlist").modal();
        var url = "<?php echo Yii::app()->createUrl('frontend/orders/show_order_short_list'); ?>";
        var order_id = "<?php echo Yii::app()->session['order_id'] ?>";
        var data = {order_id: order_id};
        $.post(url, data, function (result) {
            $("#load_cart").html(result);
        });
    }

    function load_cart_list() {
        load_inbox_cart();
        var url = "<?php echo Yii::app()->createUrl('frontend/orders/show_order_short_list'); ?>";
        var order_id = "<?php echo Yii::app()->session['order_id'] ?>";
        var data = {order_id: order_id};
        $.post(url, data, function (result) {
            $("#load_cart").html(result);
        });
    }

    function load_inbox_cart() {
        var url = "<?php echo Yii::app()->createUrl('frontend/orders/load_inbox_cart'); ?>";
        var order_id = "<?php echo Yii::app()->session['order_id'] ?>";
        var data = {order_id: order_id};
        $.post(url, data, function (result) {
            $("#load_inbox_cart").html(result);
        });
    }

</script>

<script type="text/javascript">
    $(document).ready(function () {
        load_inbox_cart();
        load_box_cart();//load box cart Menu left
        $('[data-toggle="popover"]').popover();

        $('.img_zoom').magnificPopup({
            delegate: 'a', // child items selector, by clicking on it popup will open
            type: 'image',
            gallery: {
                enabled: true
            }
            // other options
        });

    });

    function load_box_cart() {
        $("#box_cart").html("<center><i class=\"fa fa-spinner fa-spin\"></i></center>");
        var url = "<?php echo Yii::app()->createUrl('frontend/orders/load_box_cart') ?>";
        var order_id = "<?php echo Yii::app()->session['order_id']; ?>";
        var data = {order_id: order_id};

        $.post(url, data, function (result) {
            $("#box_cart").html(result);
        });
    }

    function set_type(type_id) {
        $("#type_id").val(type_id);
    }

    function search() {
        var search = $("#search").val();
        var type_id = $("#type_id").val();

        if (search != '' || type_id != '') {
            var url = "<?php echo Yii::app()->createUrl('frontend/search/product&search=') ?>" + search + "&type=" + type_id;
            window.location = url;
        } else {
            alert("ยังไม่ได้เลือกเงื่อนไขการค้นหา");
            return false;
        }
    }

    function view_order(order_id) {
        $("#basket").html("<center><i class=\"fa fa-spinner fa-spin\"></i></center>");
        var url = "<?php echo Yii::app()->createUrl('frontend/orders/get_list_basket') ?>";
        var data = {order_id: order_id};

        $.post(url, data, function (result) {
            $("#popup_basket").modal();
            $("#basket").html(result);
        });
    }
</script>
