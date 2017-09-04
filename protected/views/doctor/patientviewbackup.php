
<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/themes/dortor/assets/jquery-easyui/themes/bootstrap/easyui.css"/>
<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/themes/dortor/assets/jquery-easyui/themes/icon.css"/>
<script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/themes/dortor/assets/jquery-easyui/jquery.easyui.min.js"></script>

<?php
/* @var $this PatientController */
/* @var $model Patient */

$this->breadcrumbs = array(
    //'Patients' => array('index'),
    $model->name . " " . $model->lname,
);

$MasuserModel = new Masuser();
$config = new Configweb_model();
$branchModel = new Branch();
$CheckBodyModel = new Checkbody();
$Author = $MasuserModel->GetDetailUser($model->emp_id);

$checkbody = $CheckBodyModel->Getdetail($service_id);
?>
<style type="text/css">
    #font-16{
        color: #339900;
    }
    .modal-body{
        max-height: calc(100vh - 200px);
        overflow-y: auto;
    }
    #btn-left{
        text-align: left;
    }

    .tabpatient ul li a{
        border-radius: 0px;
        padding: 5px;
    }
</style>

<input type="hidden" id="patient_id" value="<?php echo $model['id'] ?>"/>


<div class="easyui-layout" style="width:100%;height:350px;">
    <!--
    <div data-options="region:'north'" style="height:50px"></div>
    
    -->
    <div data-options="region:'south',split:true" style="height:50px;"></div>
    <div data-options="region:'east',split:true" title="East" style="width:180px;">
        <ul class="easyui-tree" data-options="url:'tree_data1.json',method:'get',animate:true,dnd:true"></ul>
    </div>
    <div data-options="region:'west',split:true" title="West" style="width:100px;">
        <div class="easyui-accordion" data-options="fit:true,border:false">
            <div title="Title1" style="padding:10px;">
                content1
            </div>
            <div title="Title2" data-options="selected:true" style="padding:10px;">
                content2
            </div>
            <div title="Title3" style="padding:10px">
                content3
            </div>
        </div>
    </div>
    <div data-options="region:'center',title:'Main Title',iconCls:'icon-ok'">
        <div class="easyui-tabs" data-options="fit:true,border:false,plain:true">
            <div title="About" style="padding:10px">
                
            </div>
            <div title="DataGrid" style="padding:5px">
                <table class="easyui-datagrid"
                       data-options="url:'datagrid_data1.json',method:'get',singleSelect:true,fit:true,fitColumns:true">
                    <thead>
                        <tr>
                            <th data-options="field:'itemid'" width="80">Item ID</th>
                            <th data-options="field:'productid'" width="100">Product ID</th>
                            <th data-options="field:'listprice',align:'right'" width="80">List Price</th>
                            <th data-options="field:'unitcost',align:'right'" width="80">Unit Cost</th>
                            <th data-options="field:'attr1'" width="150">Attribute</th>
                            <th data-options="field:'status',align:'center'" width="50">Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>



<i class="fa fa-user"></i> ข้อมูลพื้นฐาน
<div class=" pull-right">#<?php echo $service_id ?></div>

<div class="row">
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
            <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_profile; ?>" class="img-responsive img-thumbnail" id="img_profile" style=" margin-top: 5px; max-height: 100px;"/>
            <br/><br/>

        </center>
        <?php
        if ($checkbody == "1") {
            $icons = "";
        } else {
            $icons = "<i class='fa fa-child faa-flash animated text-warning'></i>";
        }
        ?>

        <button type="button" class="btn btn-default btn-block" onclick="popuphistoryserviceall()" id="btn-left"><i class="fa fa-calendar text-warning"></i> ประวัติการรับบริการ</button>
        <button type="button" class="btn btn-default btn-block" onclick="popuphistoryserviceall()" id="btn-left"><i class="fa fa-save text-primary"></i> บันทึกการรักษา</button>
        <button type="button" class="btn btn-default btn-block" onclick="popuphistoryserviceall()" id="btn-left"><i class="fa fa-medkit text-success"></i> จ่ายยา / สินค้า</button>
        <button type="button" class="btn btn-default btn-block" onclick="popuphistoryserviceall()" id="btn-left"><i class="fa fa-camera text-danger"></i> ถ่ายรูป</button>
    </div>

    <div class="col-md-7 col-lg-7" style="padding-right: 0px;">
        <div id="tab-control" class="tabpatient">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#default" aria-controls="default" role="tab" data-toggle="tab" style="border-radius: 0px;">ข้อมูลลูกค้า</a></li>
                <li role="presentation"><a href="#checkbody" aria-controls="checkbody" role="tab" data-toggle="tab">ซักประวัติ</a></li>
                <li role="presentation"><a href="#diag" aria-controls="diag" role="tab" data-toggle="tab" onclick="loaddiag()">หัตถการ</a></li>
                <li role="presentation"><a href="#drug" aria-controls="drug" role="tab" data-toggle="tab" onclick="loaddrug()">แพ้ยา</a></li>
                <li role="presentation"><a href="#disease" aria-controls="disease" role="tab" data-toggle="tab" onclick="loaddisease()">โรคประจำตัว</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style=" padding: 5px; height: 250px; max-height: 250px; overflow: auto; overflow-x: hidden; border: #dddddd solid 1px; background: #FFFFFF; border-top: none; margin-top: 0px;" id="font-th">
                <div role="tabpanel" class="tab-pane active" id="default">
                    <div style="margin: 0px; background: none;" id="font-18">
                        ID
                        <p class="label" id="font-16">
                            <?php echo $model['pid'] ?>
                        </p>
                        ชื่อ - สกุล 
                        <p class="label" id="font-16">
                            <?php echo Pername::model()->find("oid = '$model->oid'")['pername'] ?>
                            <?php echo $model['name'] . ' ' . $model['lname'] ?></p><br/>
                        เลขบัตรประชาชน <p class="label" id="font-16"><?php echo $model['card'] ?></p>
                        เพศ <p class="label" id="font-16"><?php
                            if ($model['sex'] == 'M') {
                                echo "ชาย";
                            } else {
                                echo "หญิง";
                            }
                            ?></p><br/>

                        เกิดวันที่ <p class="label" id="font-16"><?php
                            if (isset($model['birth'])) {
                                echo $config->thaidate($model['birth']);
                            } else {
                                echo "-";
                            }
                            ?></p>
                        อายุ <p class="label" id="font-16"><?php
                            if (isset($model['birth'])) {
                                echo $config->get_age($model['birth']);
                            } else {
                                echo "-";
                            }
                            ?></p> ปี
                        อาชีพ <p class="label" id="font-16"><?php
                            $occ = $model['occupation'];
                            echo Occupation::model()->find("id = '$occ' ")['occupationname'];
                            ?></p><br/>

                        สถานที่รับบริการ <p class="label" id="font-16"><?php
                            echo "สาขา " . $branchModel->Getbranch($model['branch']);
                            ?></p>
                        ประเภทลูกค้า <p class="label" id="font-16"><?php
                            echo Gradcustomer::model()->find($model['type'])['grad'];
                            ?></p><br/>
                        วันที่ลงทะเบียน <p class="label" id="font-16"><?php
                            if (isset($model['create_date'])) {
                                echo $config->thaidate($model['create_date']);
                            } else {
                                echo "-";
                            }
                            ?></p>
                        ข้อมูลอัพเดทวันที่ <p class="label" id="font-16"><?php
                            if (isset($model['d_update'])) {
                                echo $config->thaidate($model['d_update']);
                            } else {
                                echo "-";
                            }
                            ?></p><br/>
                        ผู้บันทึกข้อูล <p class="label" id="font-16"><?php
                            $OID = $Author['oid'];
                            echo Pername::model()->find("oid = '$OID'")['pername'] . $Author['name'] . '' . $Author['lname'];
                            ?></p>
                        <br/>

                        <hr style="margin: 0px;"/>
                        ข้มูลการติดต่อ

                        <?php if ($contact) { ?>
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
                <div role="tabpanel" class="tab-pane" id="checkbody">
                    <div id="font-18">
                        <?php if (!empty($checkbody)) { ?>
                            น้ำหนัก <p class="label" id="font-16"><?php echo $checkbody['weight'] ?></p> กก.
                            ส่วนสูง <p class="label" id="font-16"><?php echo $checkbody['height'] ?></p> ซม.<br/>
                            อุณหภมูมิร่างกาย <p class="label" id="font-16"><?php echo $checkbody['btemp'] ?></p> องศา<br/>
                            อัตราการเต้นชองชีพจร <p class="label" id="font-16"><?php echo $checkbody['pr'] ?></p> ครั้ง / นาที<br/>
                            อัตราการหายใจ <p class="label" id="font-16"><?php echo $checkbody['rr'] ?></p> ครั้ง / นาที<br/>
                            ความดันโลหิต <p class="label" id="font-16"><?php echo $checkbody['ht'] ?></p><br/>
                            รอบเอว <p class="label" id="font-16"><?php echo $checkbody['waistline'] ?></p><br/>
                            อาการสำคัญ <p class="label" id="font-16"><?php
                                if (isset($checkbody['cc']))
                                    echo $checkbody['cc'];
                                else
                                    echo "-";
                                ?></p><br/>
                            ผู้ซักประวัติ <p class="label" id="font-16">
                                <?php
                                $usesave = $MasuserModel->GetDetailUser($checkbody['user_id']);
                                echo $usesave['name'] . " " . $usesave['lname'];
                                ?>

                            </p><br/>
                        <?php } else { ?>
                            <center>ยังไม่มีการตรวจร่างกาย</center>
                        <?php } ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="diag">
                    <div id="result_diag" style=" padding: 0px;"></div>  
                </div>
                <div role="tabpanel" class="tab-pane" id="drug">
                    <div id="result_drug"></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="disease">
                    <div id="result_disease"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-2 col-lg-2" style="padding-right: 0px;">
        ประวัติการรับบริการ
        <div id="historyserviceallmain"></div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">

    </div>
</div>

<hr/>
<div class="row">
    ​<div class="col-lg-12">
        บันทึกผลการตรวจ
    </div>
</div>



<!--
    #### บันทึกผลการรักษา ####
-->
<div class="panel panel-default">
    <div class="panel-heading">บันทึกผลการรักษา</div>
    <div class="panel-body">
        <h1>บันทึกผลการรักษา</h1>
    </div>
</div>


<!--
    #### ตรวจร่างกาย ####
-->
<!-- Modal -->
<div class="modal fade" id="popup_checkbody" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-child"></i> ตรวจร่างกาย</h4>
            </div>
            <div class="modal-body">
                <div class="well well-sm" style=" text-align: center;"><h4 id="hradcheckbody"></h4></div>
                <hr/>
                <div id="result_checkbody"></div>
            </div>

        </div>
    </div>
</div>

<!--
    #### ประวัติการรักษาทั้งหมด ####
-->
<!-- Modal -->
<div class="modal fade" id="popuphistoryall" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-child"></i> ประวัติการรักษา</h4>
            </div>
            <div class="modal-body">
                <div id="historyserviceall"></div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    HistoryServiceAllmain();
    $(document).ready(function () {
        $(".alert-bar").hide();
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

    function loaddiag() {
        var url = "<?php echo Yii::app()->createUrl('patientdiag/getdiag') ?>";
        var patient_id = "<?php echo $model['id'] ?>";
        var data = {patient_id: patient_id};

        $.post(url, data, function (result) {
            $("#result_diag").html(result);
        });
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

    /*CheckBody*/
    function popupcheckbody(pid, name, lname) {
        $("#hradcheckbody").html("PID : " + pid + " ลูกค้า " + name + " " + lname);
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

    function popuphistoryserviceall() {
        HistoryServiceAll();
        $("#popuphistoryall").modal();
    }

    function HistoryServiceAll() {
        var url = "<?php echo Yii::app()->createUrl('historyservice/historyall') ?>";
        var patient_id = "<?php echo $model['id'] ?>";
        var data = {patient_id: patient_id};
        $.post(url, data, function (result) {
            $("#historyserviceall").html(result);
        });
    }

    function HistoryServiceAllmain() {
        var url = "<?php echo Yii::app()->createUrl('historyservice/historyallmain') ?>";
        var patient_id = "<?php echo $model['id'] ?>";
        var data = {patient_id: patient_id};
        $.post(url, data, function (result) {
            $("#historyserviceallmain").html(result);
        });
    }
</script>
