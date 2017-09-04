<style type="text/css">
    .alam{
        background: red;
        color:#FFFFFF;
    }
    .alam a{
        color: #FFFFFF;
    }
</style>

<script type="text/javascript">
    $(document).ready(function () {
        $("#p_product").dataTable({
            //"sPaginationType": "full_numbers", // แสดงตัวแบ่งหน้า
            "bLengthChange": false, // แสดงจำนวน record ที่จะแสดงในตาราง
            "iDisplayLength": 10, // กำหนดค่า default ของจำนวน record
            "bFilter": true // แสดง search box
                    //"sScrollY": "400px", // กำหนดความสูงของ ตาราง
        });
    });
</script>

<?php
$this->breadcrumbs = array(
    "นัดหมาย",
);

$web = new Configweb_model();
$Alert = new Alert();
$AppointModel = new Appoint();
$alam = $Alert->Getalert()['alert_product'];
?>

<div class="panel panel-default">
    <div class="panel-heading" style=" padding-bottom: 15px; padding-right: 5px; background: none;">
        <i class="fa fa-info-circle"></i> นัดหมาย *เตือนก่อน <?php echo $alam ?> วัน
    </div>
    <div class="panel-body">

        <table class="table" id="p_appointover">
            <thead>
                <tr>
                    <th>#</th>
                    <th></th>
                    <th>วันนัด</th>
                    <th>ลูกค้า</th>
                    <th style=" text-align: center;">เบอร์โทรศัพท์</th>
                    <th>ประเภทนัด</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($appoint as $last):
                    $i++;
                    if ($last['over'] < 0) {
                        $bg = " class='alam' ";
                        $text = "ขาดนัด";
                    } else {
                        $bg = "";
                        $text = "";
                    }
                    ?>
                    <tr <?php echo $bg ?>>
                        <td><?php echo $i ?></td>
                        <td><?php echo $text ?></td>
                        <td><?php echo $web->thaidate($last['appoint']) ?></td>
                        <td><?php echo $last['pername'] . $last['name'] . " " . $last['lname']; ?></td>
                        <td style=" text-align: center;"><?php echo $last['tel']; ?></a></td>
                        <td><?php echo $AppointModel->Typeappoint($last['type']) ?></td>
                        <td style=" text-align: center;">
                            <a href="<?php echo Yii::app()->createUrl('appoint/carlendar') ?>"><i class="fa fa-refresh"></i> เปลี่ยนวันนัด</a>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>

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
                                <label>เดือน</label>
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
                                    <?php $year = date("Y") + 1;
                                    for ($i = $year; $i >= ($year - 1); $i--):
                                        ?>
                                        <option value="<?php echo $i ?>" <?php if ($i == ($year - 1)) echo "selected"; ?>><?php echo ($i + 543) ?></option>
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
        var month = $("#month").val();
        var year = $("#year").val();
        var data = {branch: branch, month: month, year: year};
        $.post(url, data, function (datas) {
            $("#appointlist").html(datas);
        });
    }
    

</script>

<script type="text/javascript">

    Setscreen();
    function Setscreen() {
        var boxsell = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = (boxsell - 370);
        $("#p_appointover").dataTable({
            //"sPaginationType": "full_numbers", // แสดงตัวแบ่งหน้า
            "bLengthChange": false, // แสดงจำนวน record ที่จะแสดงในตาราง
            //"iDisplayLength": 50, // กำหนดค่า default ของจำนวน record
            //"scrollCollapse": true,
            "paging": false,
            "bFilter": true, // แสดง search box
            "sScrollY": screenfull, // กำหนดความสูงของ ตาราง
            dom: 'Bfrtip',
            buttons: [
                'excel', 'print'
            ]
        });
    }


</script>


