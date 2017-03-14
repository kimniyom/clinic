<style type="text/css">
    table{
        background: #FFFFFF;
    }
</style>

<?php
/* @var $this ProductTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'คิวการรักษา',
);

$WebConfig = new Configweb_model();
?>

<div class=" pull-right"><h4>วันที่ : <?php echo $WebConfig->thaidate(date("Y-m-d")) ?></h4></div>

<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#seq" aria-controls="seq" role="tab" data-toggle="tab">คิวรอรับบริการ</a></li>
        <li role="presentation"><a href="#end" aria-controls="end" role="tab" data-toggle="tab">คิวที่ได้รับการบริการแล้ว</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="seq" style=" padding: 10px; border: #cccccc solid 1px; border-top:0px; background: #FFFFFF;">
            <button type="button" class="btn btn-default" onclick="Addseq()"><i class="fa fa-plus"></i> เพิ่มคิว</button>
            <button type="button" class="btn btn-default" onclick="AddseqFormAppoint()"><i class="fa fa-plus-circle"></i> เพิ่มคิวจากการนัด</button>
            <table class="table table-striped table-bordered" style=" margin-top: 10px;">
                <thead>
                    <tr>
                        <td style=" width: 5%; text-align: center;">#</td>
                        <td>ชื่อ - สกุล</td>
                        <td style=" text-align: center;">อายุ</td>
                        <td style=" text-align: center;">รหัสบัตรประชาชน</td>
                        <td>อาการที่มารักษา</td>
                        <td style=" text-align: center;">ให้บริการ</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($seq as $rs):
                        $i++;
                        if ($i == 1) {
                            $icon = '<i class="fa fa-arrow-right"></i>';
                            $color = 'red';
                        } else {
                            $icon = '';
                            $color = '';
                        }
                        ?>
                        <tr style="color: <?php echo $color ?>;">
                            <td style=" text-align:center;"><?php echo $icon . ' ' . $rs['id'] ?></td>
                            <td><?php echo $rs['name'] . ' ' . $rs['lname'] ?></td>
                            <td style=" text-align:center;"><?php echo $rs['age'] ?></td>
                            <td style=" text-align: center;"><?php echo $rs['card'] ?></td>
                            <td><?php echo $rs['comment'] ?></td>
                            <td style=" text-align: center;">
                                <?php if ($i == 1) { ?>
                                    <a href="<?php echo Yii::app()->createUrl('doctor/patientview', array('id' => $rs['patient_id'])) ?>">
                                        <button type="button" class="btn btn-default btn-xs">ให้บริการ</button>
                                    </a>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-default btn-xs disabled">ให้บริการ</button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div role="tabpanel" class="tab-pane" id="end">...</div>
    </div>

</div>


<!--
    #### POPUP ADD SEQ ####
-->
<div class="modal fade" tabindex="-1" role="dialog" id="popupaddseq">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">จัดการคิว</h4>
            </div>
            <div class="modal-body">
                <div id="bodyaddseq">
                    <div class="row">
                        <div class="col-lg-12">
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
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            อาการที่มารักษา
                            <textarea class=" form-control" id="comment"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="SaveAddseq()">บันทึกรายการ</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--
    #### POPUP ADD SEQFORMAPPOINT ####
-->
<div class="modal fade" tabindex="-1" role="dialog" id="popupaddseqformappoint">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">จัดการคิว</h4>
            </div>
            <div class="modal-body">
                <div id="bodyaddseq">
                    <div class="row">
                        <div class="col-lg-12">
                            ชื่อลูกค้า
                            <?php
                            $this->widget(
                                    'booster.widgets.TbSelect2', array(
                                'name' => '_patient',
                                'id' => '_patient',
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
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            อาการที่มารักษา
                            <textarea class=" form-control" id="_comment" readonly="readonly"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            วันที่นัดล่าสุด
                            <input type="text" class="form-control" id="_appoint"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            ประเภทนัด
                            <input type="text" class="form-control" id="_type"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="SaveAddseqformappoint()">บันทึกรายการ</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    function Addseq() {
        $("#patient").val("");
        $("#popupaddseq").modal();
    }

    function SaveAddseq() {
        var url = "<?php echo Yii::app()->createUrl('queue/saveseq') ?>";
        var patient = $("#patient").val();
        var comment = $("#comment").val();
        var data = {
            patient: patient,
            comment: comment
        };

        $.post(url, data, function (datas) {
            window.location.reload();
        });
    }

    function AddseqFormAppoint() {
        $("#_patient").val("");
        $("#popupaddseqformappoint").modal();
    }
</script>

