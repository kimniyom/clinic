<?php
$this->breadcrumbs = array(
    "นัดลูกค้า",
);
?>

<?php
$config = new Configweb_model();
foreach ($appoints as $appoint):
    if (!empty($appoint['images'])) {
        $img_profile = "uploads/profile/" . $appoint['images'];
    } else {
        if ($appoint['sex'] == 'M') {
            $img_profile = "images/Big-user-icon.png";
        } else if ($appoint['sex'] == 'F') {
            $img_profile = "images/Big-user-icon-female.png";
        } else {
            $img_profile = "images/Big-user.png";
        }
    }
    ?>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <td style=" width: 20%;">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_profile; ?>" class="img-responsive img-thumbnail" id="img_profile"/>
                </td>
                <td id="font-20">
                    ชื่อ - สกุล : 
                    <?php echo $appoint['pername'] . $appoint['name'] . ' ' . $appoint['lname'] ?>
                    อายุ: <?php echo $config->get_age($appoint['birth']) ?> ปี
                    <font style=" color: #66cc00" class="pull-right"><i class="fa fa-phone"></i> เบอร์โทรศัพท์ : <?php echo $appoint['tel'] ?></font>
                    <br/>
                    หัตถการ: <?php echo $appoint['diagname'] ?><br/>
                    วันที่รับบริการ : <?php echo $config->thaidate($appoint['service_date']) ?> <br/>
                    <font style=" color: #ff0000">วันที่นัด : <?php echo $config->thaidate($appoint['appoint']) ?> 
                    เวลา : <?php echo $appoint['timeappoint'] ?>
                    </font><br/>
                    ผลตรวจ : <?php echo $appoint['service_result'] ?>
                    <button type="button" class="btn btn-success" onclick="Updateappoint('<?php echo $appoint['id'] ?>', '<?php echo $appoint['name'] ?>')">เปลี่ยนวันนัด</button>
                </td>
            </tr>
        </tbody>
    </table>

<?php endforeach; ?>


<!-- 
    POPUP
-->
<div class="modal fade" tabindex="-1" role="dialog" id="popupupdateappoint">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="head"></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id"/>
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <label>ลงวันที่นัด</label>
                        <div id="sandbox-container">
                            <div class="input-group date">
                                <input type="text" class="form-control" id="appoint"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <label>ชั่วโมง</label>
                        <select id="h" class="form-control">
                            <option value="">== ชั่วโมง ==</option>
                            <?php
                            for ($i = 0; $i <= 24; $i++):
                                if (strlen($i) < 2) {
                                    $h = "0" . $i;
                                } else {
                                    $h = $i;
                                }
                                ?>
                                <option value="<?php echo $h ?>"><?php echo $h ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <label>นาที</label>
                        <select id="m" class="form-control">
                            <option value="">== นาที ==</option>
                            <?php
                            for ($a = 0; $a <= 59; $a++):
                                if (strlen($a) < 2) {
                                    $m = "0" . $a;
                                } else {
                                    $m = $a;
                                }
                                ?>
                                <option value="<?php echo $m ?>"><?php echo $m ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                <hr/>

                <div class="panel panel-primary">
                    <div class=" panel-heading">เช็คคิวว่าง</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-2" style=" text-align: right;">
                                เดือน
                            </div>
                            <div class="col-lg-4">
                                <select id="month" class="form-control">
                                    <?php
                                    $month = Month::model()->findAll('');
                                    foreach ($month as $rs):
                                        ?>
                                        <option value="<?php echo $rs['id'] ?>"><?php echo $rs['month_th'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-lg-1">
                                พ.ศ.
                            </div>
                            <div class="col-lg-3">
                                <select id="year" class="form-control">
                                    <?php $year = date("Y") + 1; for($i = $year;$i>=($year-1);$i--): ?>
                                    <option value="<?php echo $i ?>" <?php if($i == ($year-1)) echo "selected";?>><?php echo ($i + 543) ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-default" onclick="getappoint()">ตกลง</button>
                            </div>
                        </div>
                    </div>
                    <div id="appointlist"></div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="Saveupdateappoint()">บันทึกข้อมูล</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- 
    ### POPUP ###
-->
<div class="modal fade" tabindex="-1" role="dialog" id="popupday">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="headday">Modal title</h4>
            </div>
            <div class="modal-body">
                <div id="showappointday"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
    function Updateappoint(id, name) {
        getappoint();
        $("#id").val(id);
        $("#popupupdateappoint").modal();
        $("#head").text("เปลี่ยนวันนัด" + " " + name);
    }
</script>

<script type="text/javascript">
    $(function () {
        $('#sandbox-container .input-group.date').datepicker({
            language: 'th',
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });
    });

    function Saveupdateappoint() {
        var url = "<?php echo Yii::app()->createUrl('appoint/updateappoint') ?>";
        var appoint = $("#appoint").val();
        var id = $("#id").val();
        var h = $("#h").val();
        var m = $("#m").val();
        var time = h + ":" + m;
        if (appoint == "") {
            swal("Alert", "กรุณาเลือกวันนัด...", "warning");
            return false;
        }

        if (h == '' || m == '') {
            swal("Alert", "กรุณาเลือกเวลา...", "warning");
            return false;
        }
        var data = {id: id, appoint: appoint, time: time};
        $.post(url, data, function (success) {
            getappoint();
            window.location.reload();
        });
    }

    function getappoint() {
        var url = "<?php echo Yii::app()->createUrl('appoint/getappoint') ?>";
        var branch = "<?php echo Yii::app()->session['branch'] ?>";
        var year = $("#year").val();
        var month = $("#month").val();
        var data = {branch: branch, month: month,year: year};
        $.post(url, data, function (datas) {
            $("#appointlist").html(datas);
        });
    }
</script>





