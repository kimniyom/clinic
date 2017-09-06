<style type="text/css">
    table{
        background: #FFFFFF;
    }

    table tbody tr td{
        padding: 0px;
    }
    .modal.large {
        width: 80%;
    }
</style>

<table class="table table-striped" style=" margin-top: 10px;" id="tb-servicesuccess">
    <thead>
        <tr>
            <td style=" width: 5%; text-align: center;">#</td>
            <td>ชื่อ - สกุล</td>
            <td style=" text-align: center;">อายุ</td>
            <td style=" text-align: center;">รหัสบัตรประชาชน</td>
            <td style=" text-align: right;">ค่าใช้จ่าย</td>
            <td style=" text-align: center;"></td>
        </tr>
    </thead>
    <tbody>
        <?php
        $serviceModel = new Service();
        $i = 0;
        foreach ($seq as $rs):
            $i++;
            $link = Yii::app()->createUrl('doctor/patientviewhistory', array("id" => $rs['patient_id'], "service_id" => $rs['service_id'], "flag" => "counter"));
            ?>
            <tr>
                <td style=" text-align:center;"><?php echo $rs['id'] ?></td>
                <td><?php echo $rs['name'] . ' ' . $rs['lname'] ?></td>
                <td style=" text-align:center;"><?php echo $rs['age'] ?></td>
                <td style=" text-align: center;"><?php echo $rs['card'] ?></td>
                <td style=" text-align: right;"><?php echo number_format($serviceModel->SUMservice($rs['service_id']), 2) ?></td>
                <td style=" text-align: center;">
                    <a href="javascript:PopupCenter('<?php echo $link ?>','รายละเอียดการรักษา')">ข้อมูลห้องตรวจ</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    Setscreen();
    function Setscreen() {
        var boxsell = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = (boxsell - 319);
        $("#tb-servicesuccess").dataTable({
            //"sPaginationType": "full_numbers", // แสดงตัวแบ่งหน้า
            "bLengthChange": false, // แสดงจำนวน record ที่จะแสดงในตาราง
            //"iDisplayLength": 50, // กำหนดค่า default ของจำนวน record
            //"scrollCollapse": true,
            "paging": false,
            "bFilter": true, // แสดง search box
            "sScrollY": screenfull, // กำหนดความสูงของ ตาราง
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'print'
            ]
        });
    }
</script>
