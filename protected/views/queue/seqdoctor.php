<style type="text/css">

    .modal.large {
        width: 80%;
    }
</style>

<table class="table table-striped table-bordered" id="tb-services" style=" background: #FFFFFF;">
    <thead>
        <tr>
            <td style=" width: 5%; text-align: center;">#</td>
            <td>ชื่อ - สกุล</td>
            <td style=" text-align: center;">อายุ</td>
            <td style=" text-align: center;">รหัสบัตรประชาชน</td>
            <td>อาการที่มารักษา</td>
            <td style=" text-align: center;">ให้บริการ</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($seq as $rs):
            $i++;
            if ($i == 1) {
                $icon = '<i class="fa fa-arrow-right"></i>';
                $color = 'red';
            } else {
                $icon = '';
                $color = '';
            }
            
            $rss = Checkbody::model()->find('service_id=:service_id', array(':service_id'=>$rs['id']));
            ?>
            <tr style="color: <?php echo $color ?>;">
                <td style=" text-align:center;"><?php echo $icon . ' ' . $rs['id'] ?></td>
                <td><?php echo $rs['name'] . ' ' . $rs['lname'] ?></td>
                <td style=" text-align:center;"><?php echo $rs['age'] ?></td>
                <td style=" text-align: center;"><?php echo $rs['card'] ?></td>
                <td><?php echo $rss['cc'] ?></td>
                <td style=" text-align: center;">
                    <?php if ($i == 1) { ?>
                        <a href="<?php echo Yii::app()->createUrl('doctor/patientview', array('id' => $rs['patient_id'], 'service_id' => $rs['id'])) ?>">
                            <button type="button" class="btn btn-default btn-xs">ให้บริการ</button>
                        </a>
                    <?php } else { ?>
                        <button type="button" class="btn btn-default btn-xs disabled">ให้บริการ</button>
                    <?php } ?>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<script type="text/javascript">
    Setscreen();
    function Setscreen() {
        var boxsell = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = (boxsell - 255);
        $("#tb-services").dataTable({
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
