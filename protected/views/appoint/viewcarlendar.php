<table class="table table-bordered" id="viewcarlendar">
    <thead>
        <tr>
            <th style=" text-align: center;">#</th>
            <th>ชื่อ - สกุล</th>
            <th>เบอร์โทรศัพท์</th>
            <th style=" text-align: center;">พิมพ์ใบนัด</th>
            <th style=" text-align: center;">ยกลิก</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($appoint as $rs): $i++;
            $link = Yii::app()->createUrl('appoint/print', array("id" => $rs['id']));
            ?>
            <tr>
                <td style=" text-align: center; width: 5%;"><?php echo $i ?></td>
                <td>
                    <?php if (Yii::app()->session['status'] == '2') { ?>
                        <a href="<?php echo Yii::app()->createUrl('doctor/patientview', array("id" => $rs['id'], "appoint" => '1')) ?>"><?php echo $rs['name'] . " " . $rs['lname'] ?></a>
                    <?php } else { ?>
                        <?php echo $rs['name'] . " " . $rs['lname'] ?>
                    <?php } ?>
                </td>
                <td style="text-align: center;"><?php echo $rs['tel'] ?></td>
                <td style="text-align: center;">
                    <a href="javascript:PopupBill('<?php echo $link ?>','')"><i class="fa fa-print"></a></i>
                </td>
                <td style="text-align: center;">
                    <a href="javascript:deleteappoint('<?php echo $rs['id'] ?>')"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<script type="text/javascript">
    $(document).ready(function () {
        $("#viewcarlendar").dataTable({
            //"sPaginationType": "full_numbers", // แสดงตัวแบ่งหน้า
            "bLengthChange": false, // แสดงจำนวน record ที่จะแสดงในตาราง
            //"iDisplayLength": 50, // กำหนดค่า default ของจำนวน record
            //"scrollCollapse": true,
            "paging": false,
            "bFilter": true, // แสดง search box
            //"sScrollY": screenfull, // กำหนดความสูงของ ตาราง
            dom: 'Bfrtip',
            buttons: [
                'excel', 'print'
            ]
        });
    });

    function deleteappoint(id) {
        var r = confirm("Are you sure ...");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('appoint/deleteappoint') ?>";
            var data = {id: id};
            $.post(url, data, function (datas) {
                window.location.reload();
            });
        }
    }

    function PopupBill(url, title) {
        // Fixes dual-screen position  
        //                        Most browsers      Firefox
        var w = 400;
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


