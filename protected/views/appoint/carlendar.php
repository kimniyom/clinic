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
    "นัดลูกค้า",
);
$PatientModel = new Patient();
$PatientList = $PatientModel->GetPatient();

?>
<div id="ca">
    <p class="text-danger">*นัดลูกค้าคลิกที่ว่างในช่องวันที่</p>
    <p class="text-danger">*นัดลูกค้าได้เฉพาะสาขาที่ลูกค้าขึ้นทะเบียนไว้</p>
    <button type="button" class="btn btn-danger">ทรีทเม็นท์</button>
    <button type="button" class="btn btn-primary">นัดพบแพทย์</button>
    <button type="button" class="btn btn-success">นัดหัตถการ</button>
    <hr/>
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
            'right' => 'month,agendaDay',
            //'right' => 'month,agendaWeek,agendaDay',
            'lang' => 'th',
        ),
        //'timeFormat'=> 'H(:mm)',
        'events' => $this->createUrl('appoint/carlendarevents'), // URL to get event
        'eventClick' => 'js:function(calEvent, jsEvent, view) {
            $("#myModalHeader").html(calEvent.title);
            $("#myModalBody").load("' . Yii::app()->createUrl("appoint/viewcarlendar/appoint") . '/"+calEvent.id+"/type/"+calEvent.type);
            $("#myModal").modal();
        }',
        'dayClick' => "js:function(date, jsEvent, view) {
            $('#addappoint').modal();
            $('#date').val(date.format());
        }",
)));
?>
</div>


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

<div class="modal fade" tabindex="-1" role="dialog" id="addappoint">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalHeader">นัดลูกค้า</h4>
            </div>
            <div class="modal-body" id="myModalBody">
                วันที่นัด
                <input type="text" class="form-control" id="date" readonly="readonly"/><br/>
                <div class="row">
                    <div class="col-lg-6">
                        ชื่อลูกค้า
                        <?php
                        $this->widget(
                                'booster.widgets.TbSelect2', array(
                            'name' => 'patient',
                            'id' => 'patient',
                            'data' => CHtml::listData($PatientList, 'id', 'name'),
                            'options' => array(
                                'placeholder' => 'ลูกค้า',
                                'width' => '100%',
                                'allowClear' => true,
                            )
                                )
                        );
                        ?>
                    </div>
                    
                    <div class="col-lg-6">
                        ประเภทนัด
                        <?php
                        $Type = array("1" => "นัดหัตถการ","2" => "นัดพบแพทย์","3" => "ทรีทเม็นท์");
                        $this->widget(
                                'booster.widgets.TbSelect2', array(
                            'name' => 'type',
                            'id' => 'type',
                            'data' => $Type,
                            'options' => array(
                                'placeholder' => 'ประเภทนัด',
                                'width' => '100%',
                                'allowClear' => true,
                            )
                                )
                        );
                        ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="AddAppoint()">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
    function AddAppoint(){
        var url = "<?php echo Yii::app()->createUrl('appoint/addeven')?>";
        var appoint = $("#date").val();
        var patient = $("#patient").val();
        var type = $("#type").val();
        
        if(patient == ''){
            alert("ยังไม่ได้เลือกลูกค้า");
            $("#patient").focus();
            return false;
        }
        
        if(type == ''){
            alert("ยังไม่ได้เลือกประเภทนัด");
            $("#type").focus();
            return false;
        }
        
        var data = {appoint: appoint,patient: patient,type: type};
        $.post(url,data,function(datas){
            window.location.reload();
        });
    }
</script>





