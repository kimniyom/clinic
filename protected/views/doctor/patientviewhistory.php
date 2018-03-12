<?php
/* @var $this PatientController */
/* @var $model Patient */
/*
  $this->breadcrumbs = array(
  //'Patients' => array('index'),
  $model->name . " " . $model->lname,
  );
 * 
 */

$MasuserModel = new Masuser();
$config = new Configweb_model();
$branchModel = new Branch();
$CheckBodyModel = new Checkbody();
$Author = $MasuserModel->GetDetailUser($model['emp_id']);

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
    
    #btn-left:hover{
        background: none;
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

    #listservice table{
        font-size: 16px;
    }

    #listservice table tbody tr td{
        padding: 1px;
        padding-right: 5px;
    }

    #listservice table thead tr th{
        padding: 1px;
    }

</style>


<input type="hidden" id="patient_id" value="<?php echo $model['id'] ?>"/>
<input type="hidden" id="service_id" value="<?php echo $service_id ?>"/>
<div class="easyui-layout" id="layouts" style=" width: 100%; margin: 0px;">
    <div title="ประวัติการรับบริการ | วันที่ <?php echo $config->thaidate($Modelservice['service_date']) ?> | <?php echo 'คุณ ' . $model['name'] . " " . $model['lname'] . " | ลูกค้า " . Gradcustomer::model()->find($model['type'])['grad'] . ' | อายุ ' . $Age . ' ปี' ?>" 
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
                คุณ <font id="font-16"><?php echo $model['name'] . " " . $model['lname'] ?></font><br/>
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

        <div class="row" style=" margin: 0px;">
            <div class="col-md-12 col-lg-12" style=" text-align: center; padding: 0px; background: #e6e6e6;">
                <h3>รวมค่าใชจ่าย </h3>
                <div id="sumservice" style=" font-weight: bold; color: #ff0000; font-size: 24px;"></div>
                <input type="hidden" id="price_total"/>
            </div>
        </div>
        <?php
        if ($flag == "counter") {
            if ($Modelservice['status'] == "4") {
                $link = Yii::app()->createUrl('service/bill', array("service_id" => $service_id));
                ?>
                <div class="row" style=" margin: 0px;">
                    <div class="col-md-12 col-lg-12" style=" padding: 0px;"><button type="button" class="btn btn-default btn-block" style="border-radius: 0px; border: none;" id="btn-left" onclick="PopupCenter('<?php echo $link ?>', 'ใบเสร็จ')">ใบเสร็จ</button></div>
                </div>
            <?php } else { ?>
                <div class="row" style=" margin: 0px;">
                    <div class="col-md-12 col-lg-12" style=" padding: 0px;"><button type="button" class="btn btn-default btn-block" style="border-radius: 0px; border: none;"  onclick="billfalse()">ใบเสร็จ</button></div>
                </div>
                <div class="row" style=" margin: 0px;">
                    <div class="col-md-12 col-lg-12" style=" padding: 0px;"><button type="button" class="btn btn-success btn-block" style="border-radius: 0px;" onclick="confirmservice()">บันทึก</button></div>
                </div>
                <?php
            }
        }
        ?>

    </div>
    <div data-options="region:'center',title:'ลูกค้า',iconCls:'icon-ok'">
        <div class="easyui-tabs" data-options="fit:true,border:false,plain:true" id="tt">
            <div title="รายละเอียดค่าใช้จ่าย" style="padding:10px">
                <div id="listservice">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 5%;">#</th>
                                <th>รายการ</th>
                                <th style=" text-align: center; width: 10%;">จำนวน</th>
                                <th style=" text-align: right; width: 15%;">ราคา / หน่วย</th>
                                <th style=" text-align: center; width: 10%;">รวม</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sum = 0;
                            $i = 0;
                            foreach ($datalistservice as $rs):
                                $i++;
                                $sum = ($sum + $rs['total']);
                                ?>
                                <tr>
                                    <td style=" text-align: center;"><?php echo $i ?></td>
                                    <td><?php echo $rs['detail'] ?></td>
                                    <td style=" text-align: center;"><?php echo $rs['number'] ?></td>
                                    <td style="text-align: right;">​<?php echo number_format($rs['price'], 2) ?></td>
                                    <td style="text-align: right;">​<?php echo number_format($rs['total'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td style=" text-align: right; font-weight: bold;" colspan="4">รวม</td>
                                <td style="text-align: right; font-weight: bold; color: #ff0000;"><?php echo number_format($sum, 2); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div title="ข้อมูลลูกค้า" style="padding:10px">
                <div style="margin: 0px; background: none;" id="font-18">
                    ID
                    <p class="label" id="font-16">
                        <?php echo $model['pid'] ?>
                    </p>
                    ชื่อ - สกุล 
                    <p class="label" id="font-16">
                        <?php
                        $oid = $model['oid'];
                        echo Pername::model()->find("oid = '$oid'")['pername']
                        ?>
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

                        <ul style=" padding-top: 5px;">
                            <?php
                            echo "<li>เบอร์โทรศัพท์ ";
                            if (isset($model['tel'])) {
                                echo ($model['tel']);
                            } else {
                                echo "-";
                            } "</li>";

                            echo "<li>อีเมล์ ";
                            if (isset($model['email'])) {
                                echo ($model['email']);
                            } else {
                                echo "-";
                            } "</li>";

                            echo "<li>ที่อยู่ ";
                            if (isset($model['contact'])) {
                                echo $model['contact'];
                            } else {
                                echo "-";
                            }
                            
                            ?>

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

    function billfalse() {
        alert("กดบันทึกก่อนพิมพ์ใบเสร็จ");
        return false;
    }
</script>

<script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/js/patientviewhistory.js"></script>
