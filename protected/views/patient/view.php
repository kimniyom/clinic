<?php
/* @var $this PatientController */
/* @var $model Patient */

$this->breadcrumbs = array(
    'ลูกค้า' => array('index'),
    $model->name,
);

$MasuserModel = new Masuser();
$config = new Configweb_model();
$branchModel = new Branch();
$Author = $MasuserModel->GetDetailUser($model->emp_id);
?>
<style type="text/css">
    #font-18{
        color: #339900;
    }
</style>

<input type="hidden" id="patient_id" value="<?php echo $model['id'] ?>"/>

<div class="panel panel-default" style=" margin-bottom: 0px;">
    <div class="panel-heading" style=" background: #ffffff;">
        <i class="fa fa-user"></i> ข้อมูลพื้นฐาน
    </div>
    <div class="row" style="margin:0px;">
        <div class="col-md-2 col-lg-2" style="text-align: center; padding: 0px;" id="p-lefts">
            <div id="box-img-profile" style=" padding: 5px;">
                <?php
                if (!empty($model['images'])) {
                    $img_profile = "uploads/profile/" . $model['images'];
                } else {
                    if ($model['sex'] == 'M') {
                        $img_profile = "images/Big-user-icon.png";
                    } else if ($model['sex'] == 'F') {
                        $img_profile = "images/Big-user-icon-female.png";
                    } else {
                        $img_profile = "images/Big-user.png";
                    }
                }
                ?>
                <center>
                    <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_profile; ?>" class="img-responsive img-thumbnail" id="img_profile" style=" max-height: 200px;"/>
                    <button type="button" class="btn btn-xs btn-default btn-block" onclick="popupprofile()">เปลี่ยนรูปภาพ</button>
                </center>
            </div>

            <div style=" background: #f9f9f9; border-bottom: #dddddd solid 1px; border-top: #dddddd solid 1px; padding: 5px; font-weight: bold;">
                <i class="fa fa-shopping-cart"></i> ประวัติการซื้อสินค้า
            </div>
            <div id="sellhistory" style=" text-align: left;">

            </div>


        </div>
        <div class="col-md-7 col-lg-7" style="padding-right: 0px; padding-left: 0px; border-left: #dddddd solid 1px; border-right: #dddddd solid 1px;" id="p-right">
            <div class="wells" style="margin: 5px; background: none;">
                <a href="<?php echo Yii::app()->createUrl('patient/update', array('id' => $model['id'])) ?>">
                    <button type="button" class="btn btn-default btn-sm pull-right" id="font-rsu-14">
                        <i class="fa fa-pencil"></i> แก้ไขข้อมูลพื้นฐาน
                    </button></a>
                ID
                <p class="label" id="font-18">
                    <?php echo $model['pid'] ?>
                </p><br/>
                ชื่อ - สกุล 
                <p class="label" id="font-18">
                    <?php echo Pername::model()->find("oid = '$model->oid'")['pername'] ?>
                    <?php echo $model['name'] . ' ' . $model['lname'] ?></p><br/>
                เลขบัตรประชาชน <p class="label" id="font-18"><?php echo $model['card'] ?></p><br/>
                เพศ <p class="label" id="font-18"><?php
                    if ($model['sex'] == 'M') {
                        echo "ชาย";
                    } else {
                        echo "หญิง";
                    }
                    ?></p><br/>

                เกิดวันที่ <p class="label" id="font-18"><?php
                    if (isset($model['birth'])) {
                        echo $config->thaidate($model['birth']);
                    } else {
                        echo "-";
                    }
                    ?></p>
                อายุ <p class="label" id="font-18"><?php
                    if (isset($model['birth'])) {
                        echo $config->get_age($model['birth']);
                    } else {
                        echo "-";
                    }
                    ?></p> ปี
                อาชีพ <p class="label" id="font-18"><?php
                    $occ = $model['occupation'];
                    echo Occupation::model()->find("id = '$occ' ")['occupationname'];
                    ?></p><br/>

                สถานที่รับบริการ <p class="label" id="font-18"><?php
                    echo "สาขา " . $branchModel->Getbranch($model['branch']);
                    ?></p>
                ประเภทลูกค้า <p class="label" id="font-18"><?php
                    echo Gradcustomer::model()->find($model['type'])['grad'];
                    ?></p><br/>
                วันที่ลงทะเบียน <p class="label" id="font-18"><?php
                    if (isset($model['create_date'])) {
                        echo $config->thaidate($model['create_date']);
                    } else {
                        echo "-";
                    }
                    ?></p>
                ข้อมูลอัพเดทวันที่ <p class="label" id="font-18"><?php
                    if (isset($model['d_update'])) {
                        echo $config->thaidate($model['d_update']);
                    } else {
                        echo "-";
                    }
                    ?></p><br/>
                ผู้บันทึกข้อูล <p class="label" id="font-18"><?php
                    $OID = $Author['oid'];
                    echo Pername::model()->find("oid = '$OID'")['pername'] . $Author['name'] . '' . $Author['lname'];
                    ?></p>
                <br/>

                <hr style=" margin: 5px;"/>
                ข้มูลการติดต่อ

                <?php if ($contact) { ?>
                    <a href="<?php echo Yii::app()->createUrl('patientcontact/update', array("id" => $model->id)) ?>">
                        <div class="btn btn-default btn-sm pull-right" id="font-rsu-14"><i class="fa fa-home"></i> แก้ไขข้อมูลติดต่อ</div></a>
                    <ul style=" padding-top: 5px;">
                        <?php
                        echo "<li>เบอร์โทรศัพท์ ";
                        if (isset($contact['tel'])) {
                            echo ($contact['tel']);
                        } else {
                            echo "-";
                        } "</li>";

                        echo "<li>อีเมล์ ";
                        if (isset($contact['email'])) {
                            echo ($contact['email']);
                        } else {
                            echo "-";
                        } "</li>";

                        echo "<li>ตำบล ";
                        if (isset($contact['tambon'])) {
                            echo Tambon::model()->find("tambon_id = '$contact->tambon'")['tambon_name'];
                        } else {
                            echo "-";
                        }
                        echo " &nbsp;&nbsp;อำเภอ ";
                        if (isset($contact['amphur'])) {
                            echo Ampur::model()->find("ampur_id = '$contact->amphur' ")['ampur_name'];
                        } else {
                            echo "-";
                        }
                        echo " &nbsp;&nbsp;จังหวัด ";
                        if (isset($contact['changwat'])) {
                            echo Changwat::model()->find("changwat_id = '$contact->changwat' ")['changwat_name'];
                        } else {
                            echo "-";
                        } "</li>";
                        echo "<li>รหัสไปรษณีย์ ";
                        if (isset($contact['zipcode'])) {
                            echo ($contact['zipcode']);
                        } else {
                            echo "-";
                        } "</li>";
                        ?>
                    <?php } else { ?>
                        <center>
                            <p style="color: #ff0000;">ยังไม่ได้บันทึกข้อมูลส่วนนี้</p><br/>
                            <a href="<?php echo Yii::app()->createUrl('patientcontact/create', array("id" => $model->id)) ?>">
                                <button type="button" class="btn btn-default"><i class="fa fa-plus"></i> เพิ่มข้อมูลติดต่อ</button>
                            </a>
                        </center>
                    <?php } ?>
                </ul>
                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#drug" aria-controls="drug" role="tab" data-toggle="tab" onclick="loaddrug()" style=" padding: 5px;">อาการแพ้ยา</a></li>
                        <li role="presentation"><a href="#disease" aria-controls="disease" role="tab" data-toggle="tab" style=" padding: 5px;" onclick="loaddisease()">โรคประจำตัว</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content" style=" padding-top: 10px;">
                        <div role="tabpanel" class="tab-pane active" id="drug"><div id="result_drug"></div></div>
                        <div role="tabpanel" class="tab-pane" id="disease"><div id="result_disease"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3" style=" padding: 0px;">
            <div style=" background: #f9f9f9; border-bottom: #dddddd solid 1px; padding: 5px; font-weight: bold;">ประวัติการรับบริการ</div>
            <div id="history"></div>

            <div style=" background:#f9f9f9; border-bottom: #dddddd solid 1px;  border-top: #dddddd solid 1px; padding: 5px; font-weight: bold;">
                การนัด | <a href="<?php echo Yii::app()->createUrl('appoint/carlendar') ?>"><i class="fa fa-plus"></i> เพิ่มวันนัด</a>
            </div>
            <div id="appoint"></div>
        </div>
    </div>
</div>

<!-- แก้ไขโปรไฟล์ -->
<div class="modal fade" tabindex="-1" role="dialog" id="popupprofile" data-backdrop='static'>
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">รูปภาพ</h4>
            </div>
            <div class="modal-body">

                <input type="file" name="file_upload" id="file_upload"/>
                <p id="font-16" style=" color: #ff0000; margin-bottom: 0px;">(ขนาดไม่เกิน 2MB)</p>
                <p id="font-16" style=" color: #ff0000; margin-bottom: 0px;">นามสกุล .jpg .png</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ข้อมูลวันนีด -->
<div class="modal fade" tabindex="-1" role="dialog" id="popupviewappoint" data-backdrop='static'>
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <input type="hidden" id="appoint_id" />
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ข้อมูลวันนัด</h4>
            </div>
            <div class="modal-body">
                <div id="viewappoint"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning btn-block" onclick="deleteappoint()"><i class="fa fa-trash-o"></i> ลบ</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
    $(document).ready(function () {
        $('#file_upload').uploadify({
            'buttonText': 'เลือกรูปภาพ ...',
            //'swf ': '<?//php echo Yii::app()->baseUrl; ?>/lib/uploadify/uploadify.swf',
            'swf': '<?php echo Yii::app()->baseUrl . "/lib/uploadify/uploadify.swf?preventswfcaching=1442560451655"; ?>',
            'uploader': '<?php echo Yii::app()->createUrl('patient/save_upload', array('id' => $model['id'])) ?>',
            'auto': true,
            'fileSizeLimit': '2MB',
            'fileTypeExts': ' *.jpg; *.png',
            'uploadLimit': 1,
            'width': 100,
            'onUploadSuccess': function (data) {
                window.location.reload();
            }
        });
    });

    function popupprofile() {
        $("#popupprofile").modal();
    }

    function loaddrug() {
        var url = "<?php echo Yii::app()->createUrl('patientdrug/getdrug') ?>";
        var patient_id = "<?php echo $model['id'] ?>";
        var data = {patient_id: patient_id};

        $.post(url, data, function (result) {
            $("#result_drug").html(result);
        });
    }

    function loaddisease() {
        var url = "<?php echo Yii::app()->createUrl('patientdisease/getdisease') ?>";
        var patient_id = "<?php echo $model['id'] ?>";
        var data = {patient_id: patient_id};

        $.post(url, data, function (result) {
            $("#result_disease").html(result);
        });
    }

    function loadhistory() {
        var patient_id = "<?php echo $model['id'] ?>";
        var url = "<?php echo Yii::app()->createUrl('patient/history') ?>";
        var data = {patient_id: patient_id};
        $.post(url, data, function (result) {
            $("#history").html(result);
        });
    }

    function loadappoint() {
        var patient_id = "<?php echo $model['id'] ?>";
        var url = "<?php echo Yii::app()->createUrl('patient/appoint') ?>";
        var data = {patient_id: patient_id};
        $.post(url, data, function (result) {
            $("#appoint").html(result);
        });
    }

    function loadsellhistory() {
        var patient_id = "<?php echo $model['id'] ?>";
        var url = "<?php echo Yii::app()->createUrl('patient/sellhistory') ?>";
        var data = {patient_id: patient_id};
        $.post(url, data, function (result) {
            $("#sellhistory").html(result);
        });
    }

    function viewappoint(appoint_id) {
        $("#appoint_id").val(appoint_id);
        var url = "<?php echo Yii::app()->createUrl('patient/getappointpatient') ?>";
        var data = {appoint_id: appoint_id};
        $.post(url, data, function (result) {
            $("#viewappoint").html(result);
            $("#popupviewappoint").modal();
        });

    }

</script>

<script type="text/javascript">
    loadappoint();
    loadhistory();
    Setscreen();
    SetBoxHistory();
    loaddrug();
    loadsellhistory();
    function Setscreen() {
        var screen = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = (screen - 140);
        $("#p-left").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
        $("#p-right").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
        //$("#patientbox").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF'});
        //$("#boxorders").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF', 'overflow': 'auto', 'padding-left': '10px'});

    }

    function SetBoxHistory() {
        var screen = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = ((screen - 205) / 2);
        var sellhistory = (screen - 195);
        $("#history").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
        $("#appoint").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});

        $("#sellhistory").css({'height': sellhistory - 200, 'overflow': 'auto', 'padding-bottom': '25px'});
        $("#box-img-profile").css({'height': 205, 'overflow': 'auto', 'padding-bottom': '0px'});
    }

    function PopupBills(url, title) {
        // Fixes dual-screen position  
        //                        Most browsers      Firefox
        var w = 800;
        var h = 600;
        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

        var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        var left = ((width / 2) - (w / 2)) + dualScreenLeft;
        var top = ((height / 2) - (h / 2)) + dualScreenTop;
        var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

        // Puts focus on the newWindow
        if (window.focus) {
            newWindow.focus();
        }
    }
</script>
