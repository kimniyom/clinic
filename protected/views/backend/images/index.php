

<?php
$title = "คลังรูปภาพ";
$this->breadcrumbs = array(
    $title,
);

$web = new Configweb_model();
$BranchModel = new Branch();
?>

<div class="well well-sm" style="width:100%; margin-bottom:0px;">
    <div class="row" style=" margin: 0px;">
        <div class="col-xs-12 col-md-3 col-lg-3" id="p-left">
            <form id="upload" method="post" action="<?= Yii::app()->createUrl('backend/images/miniupload') ?>" enctype="multipart/form-data">
                <div id="drop">
                    เลือกรูปภาพ<br/>
                    <a class="btn btn-primary"><i class="fa fa-picture-o"></i> Browse</a>
                    <input type="file" name="upl" multiple />
                </div>

                <ul style="">
                    <!-- The file uploads will be shown here -->
                </ul>

            </form>
            <font id="font-16">
            <ul>
                <li>อัพโหลดได้ครั้งละไม่เกิน 5 ภาพ</li>
                <li>นามสกุลไฟล์ .jpg</li>
                <li>ขนาดไม่เกิน 1 MB</li>
            </ul>
            </font>
            <hr/>
        </div>
        <div class="col-xs-12 col-md-9 col-lg-9">
            <div style=" width: 100%; padding-left: 20px;">
                <button type="button" class="btn btn-default" onclick="DelImg()"><i class="fa fa-trash-o"></i> ลบ</button>
                <button type="button" class="btn btn-default" onclick="DelImgAll()"><i class="fa fa-trash-o"></i> ลบทั้งหมด</button>
            </div>
            <div id="p-rights">
                <div id="load_images" style=" padding: 0px;"></div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    checkheight();
    load_data();
    function load_data() {
        $("#load_images").html("<center><i class=\"fa fa-spinner fa-spin\"></i></center>");
        var url = "<?php echo Yii::app()->createUrl('backend/images/loadimagescontrol') ?>";
        var data = {};
        $.post(url, data, function (datas) {
            $("#load_images").html(datas);
        });
    }

    function checkheight() {
        var p_left = $("#p-left").height();
        var p_right = $("#p-right").height();
        //alert(p_left + " - " + p_right);
        if (p_left > p_right) {
            $("#p-right").removeClass("p-right");
            $("#p-left").addClass("p-left");
        } else {
            $("#p-left").removeClass("p-left");
            $("#p-right").addClass("p-right");
        }
    }
</script>

<script type="text/javascript">
    Setscreen();
    function Setscreen() {
        var screen = $(window).height();
        var w = window.innerWidth;
        if (w >= 768) {
            var screenfull = (screen - 120);
            var screenfullRight = (screen - 160);
            $("#p-left").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
            $("#p-rights").css({'height': screenfullRight, 'overflow': 'auto', 'padding-bottom': '25px'});
            //$("#patientbox").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF'});
            //$("#boxorders").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF', 'overflow': 'auto', 'padding-left': '10px'});
        } else {
            $("#p-left").css({'border': 'none'});
            $("#p-right").css({'border': 'none'});
        }
    }
</script>

<script src="<?php echo Yii::app()->baseUrl; ?>/lib/mini-upload/js/script.js" type="text/javascript"></script>

