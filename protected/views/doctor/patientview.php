<?php
/* @var $this PatientController */
/* @var $model Patient */

$this->breadcrumbs = array(
    //'Patients' => array('index'),
    $model['name'] . " " . $model['lname'],
);

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
    <div title="<?php echo 'คุณ ' . $model['name'] . " " . $model['lname'] . " | ลูกค้า " . Gradcustomer::model()->find($model['type'])['grad'] . ' | อายุ ' . $Age . ' ปี' ?>" 
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

    <div data-options="region:'south',split:true" title="ภาพถ่าย" style="height:165px; padding: 0px;">
        <div id="show_saved_img" style=" margin-left: 0px;"></div>
    </div>
    <div data-options="region:'east',split:false" title="ประวัติการรับบริการ" style="width:180px;">
        <!--
        <ul class="easyui-tree" data-options="url:'tree_data1.json',method:'get',animate:true,dnd:true"></ul>
        -->
        <div id="history"></div>
    </div>
    <div data-options="region:'west',split:false" title="เมนู" style="width:200px;">

        <div class="row" style=" margin: 0px;">
            <div class="col-md-10 col-lg-10" style=" padding: 0px;">
                <button type="button" class="btn btn-default btn-block" onclick="$('#popupaddservice').dialog('open')" id="btn-left"><i class="fa fa-save text-primary"></i> บันทึกการรักษา</button>
            </div>
            <div class="col-md-2 col-lg-2" style=" padding: 0px;">
                <button type="button" class="btn btn-default btn-block" onclick="openpopupservicedetail()" id="btn-left"><i class="fa fa-ellipsis-v"></i></button>
            </div>
        </div>

        <div class="row" style=" margin: 0px;">
            <div class="col-md-10 col-lg-10" style=" padding: 0px;">
                <button type="button" class="btn btn-default btn-block" onclick="$('#popupadddiag').dialog('open')" id="btn-left"><i class="fa fa-stethoscope text-danger"></i> หัตถการ</button>
            </div>
            <div class="col-md-2 col-lg-2" style=" padding: 0px;">
                <button type="button" class="btn btn-default btn-block" id="btn-left" onclick="openpopupservicediag()"><i class="fa fa-ellipsis-v"></i></button>
            </div>
        </div>

        <div class="row" style=" margin: 0px;">
            <div class="col-md-10 col-lg-10" style=" padding: 0px;">
                <button type="button" class="btn btn-default btn-block" onclick="$('#popupadddrug').window('open')" id="btn-left"><i class="fa fa-medkit text-success"></i> จ่ายยา / สินค้า</button>
            </div>
            <div class="col-md-2 col-lg-2" style=" padding: 0px;">
                <button type="button" class="btn btn-default btn-block" id="btn-left"  onclick="openpopupservicedetaildrug()"><i class="fa fa-ellipsis-v"></i></button>
            </div>
        </div>
        <div class="row" style=" margin: 0px;">
            <div class="col-md-10 col-lg-10" style=" padding: 0px;">
                <button type="button" class="btn btn-default btn-block" onclick="$('#popupaddetc').window('open')" id="btn-left"><i class="fa fa-money"></i>  ค่าใช้จ่ายอื่น ๆ</button>
            </div>
            <div class="col-md-2 col-lg-2" style=" padding: 0px;">
                <button type="button" class="btn btn-default btn-block" id="btn-left" onclick="openpopupservicedetailetc()"><i class="fa fa-ellipsis-v"></i></button>
            </div>
        </div>

        <button type="button" class="btn btn-default btn-block" onclick="camera()" id="btn-left"><i class="fa fa-camera text-danger"></i> ถ่ายรูป</button>
        <?php if ($service['status'] != '3' || $service['status'] != '4') { ?>
            <div class="row" style=" margin: 0px;">
                <div class="col-md-12 col-lg-12" style=" padding: 0px;">
                    <button type="button" class="btn btn-success btn-block" style=" border-radius: 0px;" onclick="doctorconfirm()">ยืนยันรายการ <img src="<?php echo Yii::app()->baseUrl ?>/images/Save-icon.png"/></button>
                </div>
            </div>
        <?php } ?>
        <!--
        <span class="easyui" style=" bottom: 0px; position: absolute; border-top: #cccccc solid 1px; width: 100%; padding: 5px; color: #ff0000;">
            สัญลักษณ์ <i class="fa fa-ellipsis-v text-success"></i> คือ ดูข้อมูล
        </span>
        -->
    </div>
    <div data-options="region:'center',title:'ลูกค้า',iconCls:'icon-ok'">
        <div class="easyui-tabs" data-options="fit:true,border:false,plain:true" id="tt">
            <div title="ข้อมูลลูกค้า" style="padding:10px">
                <div style="margin: 0px; background: none;" id="font-18">
                    ID
                    <p class="label" id="font-16">
                        <?php
                        echo $model['pid'];
                        $oid = $model['oid'];
                        ?>
                    </p>
                    ชื่อ - สกุล 
                    <p class="label" id="font-16">
                        <?php echo Pername::model()->find("oid = '$oid'")['pername'] ?>
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
                        ?></p>

                    <hr/>
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
                            echo ($model['contact']);
                        } else {
                            echo "-";
                        } "</li>";
                        ?>
                    </ul>
                    <hr/>
                    ผู้บันทึกข้อูล <p class="label" id="font-16"><?php
                        $OID = $Author['oid'];
                        echo Pername::model()->find("oid = '$OID'")['pername'] . $Author['name'] . '' . $Author['lname'];
                        ?></p>
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

<div id="popupaddservice" class="easyui-window" title="บันทึกการรักษา" style="width:700px;height:400px;padding:10px; top:50px;"
     data-options="iconCls:'icon-save',resizable:true,modal:true,closed:true,minimizable:false,collapsible:false,footer:'#popupaddservice-footer'">
    <div class="row" style=" margin: 0px 0px 10px 0px;">
        <div class="col-md-3 col-lg-3" style=" text-align: right;"><font style="color: #ff0000;">*</font>การรักษา : </div>
        <div class="col-md-9 col-lg-9">
            <textarea type="text" class=" easyui-textbox" data-options="multiline:true,prompt:'ข้อมูลการรักษา...'" style="height:100px; width: 100%;" id="service_detail" rows="5"></textarea>
        </div>
    </div>
    <div class="row" style=" margin: 0px 0px 10px 0px;">
        <div class="col-md-3 col-lg-3" style=" text-align: right;">อื่น ๆ : </div>
        <div class="col-md-9 col-lg-9">
            <textarea type="text" class=" easyui-textbox" data-options="multiline:true,prompt:'อื่น ๆ...'" style="height:100px; width: 100%;" id="service_comment" rows="5"></textarea>
        </div>
    </div>
    <div class="row" style=" margin: 0px 0px 10px 0px;">
        <div class="col-md-3 col-lg-3" style=" text-align: right;"><font style="color: #ff0000;">*</font>ราคา : </div>
        <div class="col-md-3 col-lg-3">
            <input type="text" class="easyui-numberbox" id="service_price" data-options="min:0,precision:2,prompt:'กรอกตัวเลข...'"/> 
        </div>
        <div class="col-md-1 col-lg-1">บาท</div>
    </div>
    <div id="popupaddservice-footer" style="padding:5px; text-align: right;">
        <a id="btn" href="javascript:saveserviceDetail()" class="easyui-linkbutton" data-options="iconCls:'icon-save'">บันทึก</a>
        <a id="btn" href="javascript:resetserviceDetail()" class="easyui-linkbutton" data-options="iconCls:'icon-cancel'">ยกเลิก</a>
    </div>
</div>

<!-- หัตถการ -->
<div id="popupadddiag" class="easyui-window" title="บันทึกหัตถการ" style="width:500px;height:200px;padding:10px; top:50px;"
     data-options="iconCls:'icon-save',resizable:true,modal:true,closed:true,minimizable:false,collapsible:false,footer:'#popupadddiag-footer'">
    <div class="row" style=" margin: 0px 0px 10px 0px;">
        <div class="col-md-3 col-lg-3" style=" text-align: right;"><font style="color:#ff0000;">*</font>หัตถการ : </div>
        <div class="col-md-9 col-lg-9">
            <?php
            $diag = Diag::model()->findAll('');
            ?>
            <select id="diaginsert" class="easyui-combobox" name="diaginsert" style=" width: 100%;" required="required" data-options="required:true">
                <option value="">== หัตถการ ==</option>
                <?php foreach ($diag as $d): ?>
                    <option value="<?php echo $d['diagcode'] ?>"><?php echo $d['diagname'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row" style=" margin: 0px; margin-top: 10px;">
        <div class="col-md-3 col-lg-3" style=" text-align: right;"><font style="color:#ff0000;"> *</font>ราคา : </div>
        <div class="col-md-3 col-lg-3">
            <input type="text" class="easyui-numberbox" name="pricediag" id="pricediag" data-options="min:0,precision:2,prompt:'กรอกตัวเลข...'" value="0.00" required="required"/>
        </div>
    </div>
    <div id="popupadddiag-footer" style="padding:5px; text-align: right;">
        <a id="btn" class="easyui-linkbutton" data-options="iconCls:'icon-save'" onclick="savediag()">บันทึก</a>
        <a id="btn" type="reset" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-cancel'" onclick="resetformdiag()">ยกเลิก</a>
    </div>
</div>

<!-- จ่ายยา / สินค้า -->
<div id="popupadddrug" class="easyui-window" title="บันทึกการจ่ายยา" style="width:700px;height:350px;padding:10px; top:50px;"
     data-options="iconCls:'icon-save',resizable:true,modal:true,closed:true,minimizable:false,collapsible:false,footer:'#popupadddrug-footer'">

    <div class="row" style=" margin: 0px;">
        <div class="col-md-7 col-lg-7">
            <div class="row" style=" margin: 0px 0px 10px 0px;">
                <div class="col-md-3 col-lg-3" style=" text-align: right;"><font style="color:#ff0000;"> *</font>ยา / สินค้า : </div>
                <div class="col-md-9 col-lg-9">
                    <?php
                    $items = new Items();
                    $drug = $items->GetProductSell();
                    ?>
                    <select id="druginsert" class="easyui-combobox" name="druginsert" style=" width: 100%;" required="required" data-options="required:true,prompt:'พิมพ์ชื่อยา...'">
                        <option value=""></option>
                        <?php foreach ($drug as $drugs): ?>
                            <option value="<?php echo $drugs['product_id'] ?>"><?php echo $drugs['product_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row" style=" margin: 0px 0px 10px 0px;">
                <div class="col-md-3 col-lg-3" style=" text-align: right;"><font style="color:#ff0000;"> *</font>จำนวน : </div>
                <div class="col-md-4 col-lg-4">
                    <input type="text" class=" easyui-numberbox" data-options="min:1,prompt:'กรอกตัวเลข...'"  id="drug_number" required="required" style=" width: 100%;"/>
                </div>
                <div class="col-md-3 col-lg-3">
                    <p id="unit"></p>
                </div>
            </div>
            <div class="row" style=" margin: 0px; margin-top: 10px;">
                <div class="col-md-3 col-lg-3" style=" text-align: right;"><font style="color:#ff0000;"> *</font>ราคา: </div>
                <div class="col-md-3 col-lg-3">
                    <input type="text" class="easyui-numberbox" name="pricedrug" id="pricedrug" data-options="min:0,precision:2,prompt:'กรอกตัวเลข...'" value="0.00" required="required" style=" width: 100%;"/>
                </div>
                <div class="col-md-2 col-lg-3">
                    ต่อหน่วย
                </div>
            </div>
            <div class="row" style=" margin: 0px; margin-top: 10px;">
                <div class="col-md-3 col-lg-3" style=" text-align: right;"><font style="color:#ff0000;"> *</font>ราคารวม: </div>
                <div class="col-md-4 col-lg-4">
                    <input type="text" class="easyui-numberbox" name="pricedrugtotal" id="pricedrugtotal" data-options="min:0,precision:2,prompt:'กรอกตัวเลข...'" value="0.00" required="required" style=" width: 100%;"/>
                </div>
                <div class="col-md-3 col-lg-3">
                    <button class="btn btn-default btn-sm" onclick="calculatorDrug()">คำนวณ</button>
                </div>
            </div>


        </div>
        <div class="col-md-5 col-lg-5">
            <b>ข้อมูลยา / สินค้า</b>
            <hr/>
            <div id="detaildrug"></div>
        </div>
    </div>
    <hr/>
    <div class="row" style=" margin: 0px; margin-top: 10px;">
        <div class="col-md-5 col-lg-5" style=" text-align: right;">สต๊อก: </div>
        <div class="col-md-7 col-lg-7">
            <input type="text" class="easyui-numberbox" name="stock" id="stock" data-options="min:0"/>
        </div>
    </div>

    <div id="popupadddrug-footer" style="padding:5px; text-align: right;">
        <a id="btn" class="easyui-linkbutton" data-options="iconCls:'icon-save'" onclick="saveDrug()">บันทึก</a>
        <a id="btn" type="reset" href="#" class="easyui-linkbutton" onclick="resetserviceDrug()" data-options="iconCls:'icon-cancel'">ยกเลิก</a>
    </div>
</div>

<!-- อื่น ๆ -->
<div id="popupaddetc" class="easyui-window" title="ค่าใช้จ่ายอื่น ๆ" style="width:700px;height:300px;padding:10px; top:50px;"
     data-options="iconCls:'icon-save',resizable:true,modal:true,closed:true,minimizable:false,collapsible:false,footer:'#popupaddetc-footer'">

    <div class="row" style=" margin: 0px;">
        <div class="row" style=" margin: 0px 0px 10px 0px;">
            <div class="col-md-3 col-lg-3" style=" text-align: right;">รายละเอียด : </div>
            <div class="col-md-9 col-lg-9">
                <textarea type="text" class=" easyui-textbox" data-options="multiline:true,prompt:'อื่น ๆ...'" style="height:100px; width: 100%;" id="detail_etc" rows="5"></textarea>
            </div>
        </div>
        <div class="row" style=" margin: 0px; margin-top: 10px;">
            <div class="col-md-3 col-lg-3" style=" text-align: right;">ราคา : </div>
            <div class="col-md-3 col-lg-3">
                <input type="text" class="easyui-numberbox" name="price_etc" id="price_etc" data-options="min:0,precision:2,prompt:'กรอกตัวเลข...'" value="0.00" required="required"/>
            </div>
        </div>
    </div>

    <div id="popupaddetc-footer" style="padding:5px; text-align: right;">
        <a id="btn" class="easyui-linkbutton" data-options="iconCls:'icon-save'" onclick="saveetc()">บันทึก</a>
        <a id="btn" type="reset" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-cancel'">ยกเลิก</a>
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
    $(function () {
        //give the php file path
        webcam.set_api_url('<?php echo Yii::app()->createUrl('camera/saveimage', array("service_id" => $service_id)) ?>');
        webcam.set_swf_url('<?php echo Yii::app()->baseUrl; ?>/lib/php-webcamera/scripts/webcam.swf');//flash file (SWF) file path
        webcam.set_quality(100); // Image quality (1 - 100)
        webcam.set_shutter_sound(true, '<?php echo Yii::app()->baseUrl; ?>/sound/shutter.mp3'); // play shutter click sound
        var camera = $('#camera');
        camera.html(webcam.get_html(898, 600)); //generate and put the flash embed code on page

        $('#capture_btn').click(function () {
            //take snap
            webcam.snap();
            $('#show_saved_img').html('<h3>Please Wait...</h3>');
        });


        //after taking snap call show image
        webcam.set_hook('onComplete', function (img) {
            loadimages();
            //alert(img);
            //$('#show_saved_img').html('<img src="' + img + '" class="img-responsive">');
            //reset camera for the next shot
            webcam.reset();
            $("#popupcamera").modal("hide");
        });

    });

    function loadimages() {
        var url = "<?php echo Yii::app()->createUrl('camera/loadimages') ?>";
        var service_id = $("#service_id").val();
        var data = {service_id: service_id};
        $.post(url, data, function (datas) {
            $("#show_saved_img").html(datas);
        });
    }
</script>


<div class="modal fade modal-wide" tabindex="-1" role="dialog" id="popupcamera">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <center>
                    <button class="btn btn-warning" id="capture_btn"><i class="fa fa-camera"></i> Capture</button>
                </center>
            </div>
            <div class="modal-body" style="padding: 0px; text-align: center;">
                <div id="camera"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
    function camera() {
        $("#popupcamera").modal();
    }
</script>
<script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/js/patientview.js"></script>
