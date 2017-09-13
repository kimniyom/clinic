<?php
/* @var $this MasuserController */
/* @var $model Masuser */

$this->breadcrumbs = array(
    'ผู้ใช้งาน' => array('index'),
    'เพิ่ม',
);
?>

<div class="panel panel-default" style=" margin-bottom: 0px;">
    <div class="panel-heading" style=" background: #FFFFFF;"><i class="fa fa-plus"></i> เพิ่มผู้ใช้งาน</div>
    <div class="panel-body" id="p-box">
        <?php $this->renderPartial('_form', array('model' => $model)); ?>
        <hr/>
        <p style=" color: #ff0000;">* ผู้ใช้งานระบบต้องเป็นพนักงานที่ลงทะเบียนกับระบบแล้วเท่านั้น</p>

    </div>
</div>


<script type="text/javascript">

    Setscreen();
    function Setscreen() {
        var screen = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = (screen - 145);
        $("#p-box").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
        //$("#patientbox").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF'});
        //$("#boxorders").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF', 'overflow': 'auto', 'padding-left': '10px'});

    }
</script>
