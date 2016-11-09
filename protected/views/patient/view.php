<?php
/* @var $this PatientController */
/* @var $model Patient */

$this->breadcrumbs = array(
    'Patients' => array('index'),
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

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-user"></i> ข้อมูลพื้นฐาน
    </div>
    <div class="row" style="margin:0px;">
        <div class="col-md-3 col-lg-3" style="text-align: center;">
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
                <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_profile; ?>" class="img-responsive img-thumbnail" id="img_profile" style=" margin-top: 5px; max-height: 200px;"/>
                <br/><br/>
                <div class="well" style="border-radius:0px; text-align: left; padding-left: 30px; padding-bottom: 0px;">
                    <input type="file" name="file_upload" id="file_upload"/>
                    <p id="font-16" style=" color: #ff0000; text-align: center; margin-bottom: 0px;">(ไม่เกิน 2MB)</p>
                </div>
            </center>

            <button type="button" class="btn btn-default btn-block" onclick="popupcheckbody('<?php echo $model['pid']?>','<?php echo $model['name']?>','<?php echo $model['lname'] ?>')">ตรวจร่างกาย</button>
            <button type="button" class="btn btn-default btn-block" onclick="popupdiag()">หัตถการทางการแพทย์</button>
            <button type="button" class="btn btn-default btn-block" onclick="popupdrug()">อาการแพ้ยา</button>
            <button type="button" class="btn btn-default btn-block" onclick="popupdisease()">โรคประจำตัว</button>
            <button type="button" class="btn btn-default btn-block">ประวัติการรับบริการ</button>

        </div>
        <div class="col-md-9 col-lg-9" style="padding-right: 0px;">
            <div class="well" style="margin: 5px; background: none;" id="font-20">
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

                <hr/>
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
            </div>
        </div>
    </div>
</div>

<!--
    #### หัตถการทางการแพทย์ ####
-->
<!-- Modal -->
<div class="modal fade" id="popup_diag" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">รายการหัตถการ</h4>
            </div>
            <div class="modal-body" style=" padding-bottom: 0px;">
                <div id="result_duag"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--
    #### อาการแพ้ยา ####
-->
<!-- Modal -->
<div class="modal fade" id="popup_drug" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">อาการแพ้ยา</h4>
            </div>
            <div class="modal-body">
                <div id="result_drug"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--
    #### โรคประจำตัว ####
-->
<!-- Modal -->
<div class="modal fade" id="popup_disease" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">โรคประจำตัว</h4>
            </div>
            <div class="modal-body">
                <div id="result_disease"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--
    #### ตรวจร่างกาย ####
-->
<!-- Modal -->
<div class="modal fade" id="popup_checkbody" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-child"></i> ตรวจร่างกาย</h4>
            </div>
            <div class="modal-body" style=" background: url('images/Body-bg.png') center no-repeat">
                <div class="well well-sm" style=" text-align: center;"><h4 id="hradcheckbody"></h4></div>
                <hr/>
                <div id="result_checkbody"></div>
            </div>
            
        </div>
    </div>
</div>

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
            'width': 180,
            'onUploadSuccess': function (data) {
                window.location.reload();
            }
        });
    });

    function popupdiag() {
        $("#popup_diag").modal();
        loaddiag();
    }

    function loaddiag() {
        var url = "<?php echo Yii::app()->createUrl('patientdiag/getdiag') ?>";
        var patient_id = "<?php echo $model['id'] ?>";
        var data = {patient_id: patient_id};

        $.post(url, data, function (result) {
            $("#result_duag").html(result);
        });
    }

    function popupdrug() {
        $("#popup_drug").modal();
        loaddrug();
    }

    function loaddrug() {
        var url = "<?php echo Yii::app()->createUrl('patientdrug/getdrug') ?>";
        var patient_id = "<?php echo $model['id'] ?>";
        var data = {patient_id: patient_id};

        $.post(url, data, function (result) {
            $("#result_drug").html(result);
        });
    }

    function popupdisease() {
        $("#popup_disease").modal();
        loaddisease();
    }

    function loaddisease() {
        var url = "<?php echo Yii::app()->createUrl('patientdisease/getdisease') ?>";
        var patient_id = "<?php echo $model['id'] ?>";
        var data = {patient_id: patient_id};

        $.post(url, data, function (result) {
            $("#result_disease").html(result);
        });
    }

    /*CheckBody*/
    function popupcheckbody(pid,name,lname) {
        $("#hradcheckbody").html("PID : "+ pid +" ลูกค้า " + name + " " + lname);
        $("#popup_checkbody").modal();
        loadcheckbody();
    }

    function loadcheckbody() {
        var url = "<?php echo Yii::app()->createUrl('checkbody/check') ?>";
        var patient_id = "<?php echo $model['id'] ?>";
        var data = {patient_id: patient_id};

        $.post(url, data, function (result) {
            $("#result_checkbody").html(result);
        });
    }
</script>
