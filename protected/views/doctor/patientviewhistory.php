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
if (isset($model['birth'])) {
    $Age = $config->get_age($model['birth']);
} else {
    $Age = "-";
}
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
        margin: 0px;
        border-radius: 0px; 
        border: 0px;
        border-bottom: #e6e6e6 solid 1px;
    }

    .tabpatient ul li a{
        border-radius: 0px;
        padding: 5px;
    }

    .modal-wide .modal-dialog {
        width: 950px; /* or whatever you wish */
    }

    .modal-wide .modal-body {
        max-height:70%; 
        overflow-y: auto;
    }

</style>

<input type="hidden" id="patient_id" value="<?php echo $model['id'] ?>"/>
<input type="hidden" id="service_id" value="<?php echo $service_id ?>"/>
<div class="easyui-layout" id="layouts" style=" width: 100%; margin: 0px;">
    <div title="ประวัติการรับบริการ | วันที่ <?php echo $config->thaidate($Modelservice->service_date) ?> | <?php echo 'คุณ ' . $model->name . " " . $model->lname . " | ลูกค้า " . Gradcustomer::model()->find($model['type'])['grad'] . ' | อายุ ' . $Age . ' ปี' ?>" 
         data-options="region:'north'" 
         style="height:110px; padding: 0px; padding-bottom: 0px; overflow: hidden;">
        <div class="row" style=" margin: 0px;">
            <div class="col-md-2 col-lg-2 col-sm-4" style=" text-align: center; margin: 0px;">
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
                ?><?php
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
                    <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_profile; ?>" class="img-responsive" id="img_profile" style="max-height: 80px;"/>
                </center>
            </div>
            <div class="col-md-10 col-lg-10 col-sm-8" id="font-18" >
                คุณ <font id="font-16"><?php echo $model->name . " " . $model->lname ?></font><br/>
                อุณหภมูมิร่างกาย <p class="label" id="font-16"><?php echo $checkbody['btemp'] ?></p> องศา
                อัตราการเต้นชองชีพจร <p class="label" id="font-16"><?php echo $checkbody['pr'] ?></p> ครั้ง / นาที
                อัตราการหายใจ <p class="label" id="font-16"><?php echo $checkbody['rr'] ?></p> ครั้ง / นาที
                ความดันโลหิต <p class="label" id="font-16"><?php echo $checkbody['ht'] ?></p>
                รอบเอว <p class="label" id="font-16"><?php echo $checkbody['waistline'] ?></p>

                <br/>
                อาการสำคัญ <?php
                if (isset($checkbody['cc']))
                    echo "<font id='font-16'>" . $checkbody['cc'] . "</font>";
                else
                    echo "-";
                ?>
            </div>
        </div>
    </div>

    <div data-options="region:'south',split:true" title="ภาพถ่าย" style="height:145px; padding: 0px;">
        <div id="show_saved_img" style=" margin-left: 0px;"></div>
    </div>

    <div data-options="region:'west',split:false" title="เมนู" style="width:200px;">

        <div class="row" style=" margin: 0px;">
            <div class="col-md-12 col-lg-12" style=" padding: 0px;">
                <button type="button" class="btn btn-default btn-block" onclick="openpopupservicedetail()" id="btn-left"><i class="fa fa-save text-primary"></i> การรักษา</button>
            </div>
        </div>

        <div class="row" style=" margin: 0px;">
            <div class="col-md-12 col-lg-12" style=" padding: 0px;">
                <button type="button" class="btn btn-default btn-block" onclick="openpopupservicediag()" id="btn-left"><i class="fa fa-stethoscope text-danger"></i> หัตถการ</button>
            </div>
        </div>

        <div class="row" style=" margin: 0px;">
            <div class="col-md-12 col-lg-12" style=" padding: 0px;">
                <button type="button" class="btn btn-default btn-block" onclick="openpopupservicedetaildrug()" id="btn-left"><i class="fa fa-medkit text-success"></i> ยา / สินค้า</button>
            </div>
        </div>

        <div class="row" style=" margin: 0px;">
            <div class="col-md-12 col-lg-12" style=" padding: 0px;">
                <button type="button" class="btn btn-default btn-block" onclick="openpopupservicedetailetc()" id="btn-left"><i class="fa fa-money"></i>  ค่าใช้จ่ายอื่น ๆ</button>
            </div>
        </div>

    </div>
    <div data-options="region:'center',title:'ลูกค้า',iconCls:'icon-ok'">
        <div class="easyui-tabs" data-options="fit:true,border:false,plain:true" id="tt">
            <div title="ข้อมูลลูกค้า" style="padding:10px">
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
                    อายุ <p class="label" id="font-16"><?php $Age ?></p> ปี
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

            <div title="ซักประวัติ" style="padding:10px">
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

            <div title="แพ้ยา" style="padding:5px" id="drug">
                <div id="result_drug" style=" padding: 0px;"></div>
            </div>
            <div title="โรคประจำตัว" style="padding:5px" id="disease">
                <div id="result_disease" style=" padding: 0px;"></div>
            </div>
            <!--
            <div title="หัตถการ" style="padding:5px" id="diag">
                <div id="result_diag" style=" padding: 0px;"></div> 
            </div>
            -->
        </div>
    </div>
</div>

<!-- รายละเอียดการบันทึกข้อมูลการให้บริการ -->
<div id="popupdetailservice" class="easyui-window" title="ข้อมูลการให้บริการ" style="width:700px;height:500px;padding:0px; top:50px;"
     data-options="resizable:true,modal:true,closed:true,minimizable:false,collapsible:false">
    <div id="bodydetailservice"></div>
</div>

<!-- รายละเอียดหัตถการ -->
<div id="popupdetaildiag" class="easyui-window" title="ข้อมูลหัตถการ" style="width:700px;height:500px;padding:0px; top:50px;"
     data-options="resizable:true,modal:true,closed:true,minimizable:false,collapsible:false">
    <div id="bodydiagservice"></div>
</div>

<!-- รายละเอียดการให้ยาสินค้า -->
<div id="popupdetaildrug" class="easyui-window" title="ข้อมูลการจ่ายยา / สินค้า" style="width:700px;height:500px;padding:0px; top:50px;"
     data-options="resizable:true,modal:true,closed:true,minimizable:false,collapsible:false">
    <div id="bodydrugservice"></div>
</div>

<!-- รายละเอียดรายการอื่น ๆ  -->
<div id="popupdetailetc" class="easyui-window" title="ข้อมูลค่าใช้จ่ายอื่น ๆ" style="width:700px;height:500px;padding:0px; top:50px;"
     data-options="resizable:true,modal:true,closed:true,minimizable:false,collapsible:false">
    <div id="bodyetcservice"></div>
</div>

<script>
    function loadimages() {
        var url = "<?php echo Yii::app()->createUrl('camera/loadimagesview') ?>";
        var service_id = $("#service_id").val();
        var data = {service_id: service_id};
        $.post(url, data, function (datas) {
            $("#show_saved_img").html(datas);
        });
    }
</script>

<script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/js/patientviewhistory.js"></script>
