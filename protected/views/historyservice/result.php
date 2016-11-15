<?php
$web = new Configweb_model();
$branchModel = new Branch();
$Pername = new Pername();
$oid = $patient['oid'];
$shotname = $Pername->find("oid = '$oid' ")['pername'];
?>
<div class=" container" >
    <div class="well" style="margin: 5px; background: #ffffff;">
        <h4><i class="fa fa-file"></i>ผลการตรวจ</h4>
        ผลการตรวจ : <?php echo $service['service_result'] ?><br/>
        ราคา : <?php echo $service['price_total'] ?><br/>
        comment : <?php echo $service['comment'] ?><br/>
        วันที่ : <?php echo $service['service_date'] ?><br/>
        <hr/>
        <h4><i class="fa fa-user"></i>ข้อมูลลูกค้า</h4>

        PID
        <p class="label" id="font-18">
            <?php echo $patient['pid'] ?>
        </p><br/>
        ชื่อ - สกุล 
        <p class="label" id="font-18">
            <?php echo Pername::model()->find("oid = '$patient->oid'")['pername'] ?>
            <?php echo $patient['name'] . ' ' . $patient['lname'] ?></p><br/>
        เลขบัตรประชาชน <p class="label" id="font-18"><?php echo $patient['card'] ?></p><br/>
        เพศ <p class="label" id="font-18"><?php
            if ($patient['sex'] == 'M') {
                echo "ชาย";
            } else {
                echo "หญิง";
            }
            ?></p>

        เกิดวันที่ <p class="label" id="font-18"><?php
            if (isset($patient['birth'])) {
                echo $web->thaidate($patient['birth']);
            } else {
                echo "-";
            }
            ?></p>
        อายุ <p class="label" id="font-18"><?php
            if (isset($patient['birth'])) {
                echo $web->get_age($patient['birth']);
            } else {
                echo "-";
            }
            ?></p> ปี<br/>
        อาชีพ <p class="label" id="font-18"><?php
            $occ = $patient['occupation'];
            echo Occupation::model()->find("id = '$occ' ")['occupationname'];
            ?></p><br/>

        สถานที่รับบริการ <p class="label" id="font-18"><?php
            echo "สาขา " . $branchModel->Getbranch($patient['branch']);
            ?></p>
        ประเภทลูกค้า <p class="label" id="font-18"><?php
            echo Gradcustomer::model()->find($patient['type'])['grad'];
            ?></p><br/>
        วันที่ลงทะเบียน <p class="label" id="font-18"><?php
            if (isset($patient['create_date'])) {
                echo $web->thaidate($patient['create_date']);
            } else {
                echo "-";
            }
            ?></p>
        ข้อมูลอัพเดทวันที่ <p class="label" id="font-18"><?php
            if (isset($patient['d_update'])) {
                echo $web->thaidate($patient['d_update']);
            } else {
                echo "-";
            }
            ?></p>


        <hr/>
        <h4><i class="fa fa-child"></i> ตรวจร่างกาย</h4>

        น้ำหนัก <p class="label" id="font-18"><?php echo $checkbody['weight'] ?></p><br/>
        ส่วนสูง <p class="label" id="font-18"><?php echo $checkbody['height'] ?></p><br/>
        อุณหภมูมิร่างกาย <p class="label" id="font-18"><?php echo $checkbody['btemp'] ?></p><br/>
        อัตราการเต้นชองชีพจร <p class="label" id="font-18"><?php echo $checkbody['pr'] ?></p><br/>
        อัตราการหายใจ <p class="label" id="font-18"><?php echo $checkbody['rr'] ?></p><br/>
        ความดันโลหิต <p class="label" id="font-18"><?php echo $checkbody['ht'] ?></p><br/>
        รอบเอว <p class="label" id="font-18"><?php echo $checkbody['waistline'] ?></p><br/>
        อาการสำคัญ <p class="label" id="font-18"><?php echo $checkbody['cc'] ?></p><br/>

    </div>
</div>
