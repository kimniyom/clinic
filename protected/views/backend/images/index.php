<script src="<?= Yii::app()->baseUrl ?>/assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl ?>/assets/uploadify/uploadify.css">

<script type="text/javascript">
    $(document).ready(function () {
        //load_data();
        $('#Filedata').uploadify({
            /*'buttonText': 'กรุณาเลือกรูปภาพ ...',*/
            'auto': true, //เปิดใช้การอัพโหลดแบบอัติโนมัติ
            buttonText: "อัพโหลดรูปภาพ",
            //'buttonImage': '<?//= Yii::app()->baseUrl ?>/images/image-up-icon.png',
            'swf': '<?= Yii::app()->baseUrl ?>/assets/uploadify/uploadify.swf', //โฟเดอร์ที่เก็บไฟล์ปุ่มอัพโหลด
            'uploader': "<?= Yii::app()->createUrl('backend/images/uploadify') ?>",
            'fileSizeLimit': '1MB', //อัพโหลดได้ครั้งละไม่เกิน 1024kb
            //'width': '128',
            //'height': '132',
            'fileTypeExts': '*.jpg;', //กำหนดชนิดของไฟล์ที่สามารถอัพโหลดได้
            'multi': true, //เปิดใช้งานการอัพโหลดแบบหลายไฟล์ในครั้งเดียว
            'queueSizeLimit': 5, //อัพโหลดได้ครั้งละ 5 ไฟล์
            'onQueueComplete': function (file, data) {
                load_data();
            }
        });
    });

</script>

<?php
$title = "คลังรูปภาพ";
$this->breadcrumbs = array(
    $title,
);

$web = new Configweb_model();
$BranchModel = new Branch();
?>

<div class="well well-sm" style="width:100%; margin-bottom:0px; background: #ffffff;">
    <div class="row">
        <div class="col-xs-6 col-md-3 col-lg-3" id="p-left">
            <input id="Filedata" name="Filedata" type="file" multiple="true">
            <font id="font-16">
            <ul>
                <li>อัพโหลดได้ครั้งละไม่เกิน 5 ภาพ</li>
                <li>นามสกุลไฟล์ .jpg</li>
                <li>ขนาดไม่เกิน 1 MB</li>
            </ul>
            </font>
            <hr/>
        </div>
        <div class="col-xs-6 col-md-9 col-lg-9">
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
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = (screen - 120);
        var screenfullRight = (screen - 160);
        $("#p-left").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
        $("#p-rights").css({'height': screenfullRight, 'overflow': 'auto', 'padding-bottom': '25px'});
        //$("#patientbox").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF'});
        //$("#boxorders").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF', 'overflow': 'auto', 'padding-left': '10px'});

    }
</script>

