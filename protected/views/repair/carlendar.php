<title>รายชื่อนัดลูดค้า</title>
<style type="text/css">
    table{
        border: none;
    }
    #ca{
        padding: 10px; background: #FFFFFF;
    }
</style>
<?php
$this->breadcrumbs = array(
    "ปฏิทินซ่อม - บำรุง",
);

$Web = new Configweb_model();
?>
<div id="ca">
    <div class="row">
        <div class="col-md-4 col-lg-4" id="p-left">
            <p class="text-danger">*คลิกที่ว่างในช่องวันที่เพื่อลงวันที่ซ่อม - บำรุงครั้งต่อไป</p>
            <div class="panel panel-default">
                <div class="panel-heading">รายการที่เลยวันซ่อม</div>
                <div class="list-group">
                    <?php foreach ($repair as $rss): ?>
                        <a href="javascript:popuprepair('<?php echo $rss['id'] ?>')" class=" list-group-item" style=" border-radius: 0px; border-left: 0px; border-right: 0px; font-size: 14px;">
                            รายการซ่อม: <?php echo $rss['object'] ?><br/>
                            รายละเอียด: <?php echo $rss['detail'] ?><br/>
                            วันที่: <?php echo $Web->thaidate($rss['date_alert']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-lg-8" id="p-right">
            <div style=" width: 100%;">
                <?php
                $this->widget('ext.fullcalendar.EFullCalendarHeart', array(
                    //'themeCssFile'=>'cupertino/jquery-ui.min.css',
                    //'id' => 'appoint',
                    'htmlOptions' => array(
                        'style' => 'border:#eeeeee solid 0px;'
                    ),
                    'options' => array(
                        'lang' => 'th',
                        'editable' => true,
                        'header' => array(
                            'left' => 'prev,next,today',
                            'center' => 'title',
                            'right' => 'month',
                            //'right' => 'month,agendaWeek,agendaDay',
                            'lang' => 'th',
                        ),
                        //'timeFormat'=> 'H(:mm)',
                        'events' => $this->createUrl('repair/carlendarevents'), // URL to get event
                        'eventClick' => 'js:function(calEvent, jsEvent, view) {
            $("#myModalHeader").html(calEvent.title);
            $("#myModalBody").load("' . Yii::app()->createUrl("repair/viewcarlendar/date") . '/"+calEvent.id);
            $("#myModal").modal();
        }',
                        'dayClick' => 'js:function(date, jsEvent, view) {
                $("#date").val(date.format());
                var ap_date = $("#date").val();
                var url = "' . Yii::app()->createUrl("repair/create") . '&datealert="+ap_date
                window.location=url;
        }',
                )));
                ?>
            </div>
        </div>
    </div>
</div>

<input type="hidden" class="form-control" id="date" readonly="readonly"/>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalHeader">Modal</h4>
            </div>
            <div class="modal-body" id="myModalBody">
                <p>One fine body&hellip;</p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- popup confirm order -->
<div class="modal fade" tabindex="-1" role="dialog" data-backdrop='static' id="popuprepair">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ยืนยันการซ่อม - บำรุง</h4>
            </div>
            <div class="modal-body" id="myModalBody">
                <input type="hidden" id="repair_id"/>
                <label><i class="fa fa-money"></i> ค่าซ่อม</label>
                <div class="row">
                    <div class="col-md-10 col-lg-10 col-sm-10 col-xs-10">

                        <input type="text" id="price" class="form-control"  placeholder="ตัวเลขเท่านั้น ..."
                               onKeyUp="if (this.value * 1 != this.value)
                                           this.value = '';"/>
                    </div>
                    <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                        บาท
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                        <button type="button" class="btn btn-success btn-block" onclick="Confirmrepair()"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                        <button type="button" class="btn btn-danger btn-block" onclick="Deleteevent()"><i class="fa fa-trash-o"></i> ลบรายการนี้</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
    Setscreen();

    function popuprepair(id) {
        $("#price").val("");
        $("#repair_id").val(id);
        $("#popuprepair").modal();
    }

    function Confirmrepair() {
        var url = "<?php echo Yii::app()->createUrl('repair/addevent') ?>";
        var price = $("#price").val();
        var id = $("#repair_id").val();
        if (price == '') {
            alert("ยังไม่ได้ใส่จำนวน");
            $("#price").focus();
            return false;
        }

        var data = {id: id, price: price};
        $.post(url, data, function (datas) {
            window.location.reload();
        });
    }

    function Deleteevent() {
        var r = confirm("Are you sure..?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('repair/deleteevent') ?>";
            var id = $("#repair_id").val();
            var data = {id: id};
            $.post(url, data, function (datas) {
                window.location.reload();
            });
        }
    }

    function Setscreen() {
        var screen = $(window).height();
        var width = $(window).width();
        if (width >= 768) {
            //var contentboxsell = $("#content-boxsell").height();
            var screenfull = (screen - 120);
            $("#p-right").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
            $("#p-left").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
            //$("#patientbox").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF'});
            //$("#boxorders").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF', 'overflow': 'auto', 'padding-left': '10px'});
        }
    }


</script>





