<?php
$web = new Configweb_model();
$branchModel = new Branch();
$Pername = new Pername();
$UserModel = new Masuser();
$Profile = $UserModel->GetProfileByID($service['user_id']);
$oid = $patient['oid'];
$shotname = $Pername->find("oid = '$oid' ")['pername'];

$gradcustomer = Gradcustomer::model()->find($patient['type'])
?>
<div class="well" >
    <h2>ประวัติการรักษา</h2>
    <h4><i class="fa fa-file"></i> ผลการตรวจ</h4>
    ผลการตรวจ : <?php echo $service['service_result'] ?><br/>
    ราคา : <?php echo $service['price_total'] ?><br/>
    comment : <?php echo $service['comment'] ?><br/>
    วันที่ให้บริการ : <?php echo $web->thaidate($service['service_date']) ?><br/>
    ผู้ตรวจ : <?php echo $Profile['name'] . " " . $Profile['lname']; ?>
    <hr/>
    <h4><i class="fa fa-user"></i> ข้อมูลลูกค้า</h4>

    PID
    <p class="label" id="font-18">
        <?php echo $patient['pid'] ?>
    </p>
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
        ?></p> ปี 
    อาชีพ <p class="label" id="font-18"><?php
        $occ = $patient['occupation'];
        echo Occupation::model()->find("id = '$occ' ")['occupationname'];
        ?></p><br/>

    สถานที่รับบริการ <p class="label" id="font-18"><?php
        echo "สาขา " . $branchModel->Getbranch($patient['branch']);
        ?></p>
    ประเภทลูกค้า <p class="label" id="font-18"><?php
        echo $gradcustomer['grad'];
        ?></p>
    <hr/>
    <h4><i class="fa fa-child"></i> ตรวจร่างกาย</h4>

    น้ำหนัก <p class="label" id="font-18"><?php echo $checkbody['weight'] ?></p>
    ส่วนสูง <p class="label" id="font-18"><?php echo $checkbody['height'] ?></p>
    อุณหภมูมิร่างกาย <p class="label" id="font-18"><?php echo $checkbody['btemp'] ?></p>
    อัตราการเต้นชองชีพจร <p class="label" id="font-18"><?php echo $checkbody['pr'] ?></p>
    อัตราการหายใจ <p class="label" id="font-18"><?php echo $checkbody['rr'] ?></p><br/>
    ความดันโลหิต <p class="label" id="font-18"><?php echo $checkbody['ht'] ?></p>
    รอบเอว <p class="label" id="font-18"><?php echo $checkbody['waistline'] ?></p>
    อาการสำคัญ <p class="label" id="font-18"><?php echo $checkbody['cc'] ?></p><br/>

    <hr/>
    <h4><i class="fa fa-medkit"></i> ยา / สินค้า</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style=" text-align: center;">#</th>
                <th>รายการ</th>
                <th style="text-align: center;">จำนวน</th>
                <th style=" text-align: center;">ราคา / หน่วย</th>
                <th style=" text-align: center;">ราคา</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $sum = 0;
            foreach ($drug as $rs): $i++;
                ?>
                <tr>
                    <td style=" width: 5%; text-align: center;"><?php echo $i ?></td>
                    <td><?php echo $rs['product_name'] ?></td>
                    <td style=" width: 5%; text-align: center;"><?php echo $rs['number'] ?></td>
                    <td style=" text-align: right;"><?php echo number_format($rs['product_price'],2) ?></td>
                    <td style=" text-align: right;"><?php echo number_format($rs['number'] * $rs['product_price'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <hr/>
    <h4><i class="fa fa-calendar"></i> วันนัด : <?php echo $web->thaidate($appoint['appoint']) ?></h4>

</div>
