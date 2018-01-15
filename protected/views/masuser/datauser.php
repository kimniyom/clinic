<?php
$system = new Configweb_model();
$MasuserModel = new Masuser();
?>
<table class="table table-bordered" id="tuser" style=" width: 100%;">
    <thead>
        <tr>
            <th style=" text-align: center;">#</th>
            <th>Username</th>
            <th>Name - Lname</th>
            <th>Status</th>
            <th>CreateDate</th>
            <th style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($user as $rs): $i++;
            $rss = $MasuserModel->GetDetailUser($rs['user_id']);
            ?>
            <tr>
                <td style=" text-align: center;"><?php echo $i ?></td>
                <td><?php echo $rs['username'] ?></td>
                <td>
                    <?php echo $rss['pername'] . '' . $rss['name'] . ' ' . $rss['lname']; ?>
                </td>
                <td><?php echo $rs['statusname'] ?></td>
                <td><?php echo $system->thaidate($rs['create_date']) ?></td>
                <td style="text-align: center;">
                    <a href="<?php echo Yii::app()->createUrl('employee/view', array('id' => $rs['user_id'])) ?>"><i class="fa fa-eye"></i> โปรไฟล์</a>
                    <a href="<?php echo Yii::app()->createUrl('masuser/update', array('id' => $rs['id'], 'user_id' => $rs['user_id'])) ?>"><i class="fa fa-pencil"></i> แก้ไข</a>
                    <?php if ($rs['id'] != '1') { ?>
                        <a href="javascript:deletuser('<?php echo $rs['id'] ?>')"><i class="fa fa-trash"></i> ลบ</a>
                    <?php } else { ?>
                        <a href="javascript:alert('ไม่สามารถลบ ผู้ใช้งานที่เป็น Admin ...')"><i class="fa fa-trash"></i> ลบ</a>
                        <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    function deletuser(id) {
        var r = confirm("คุณแน่ใจหรือไม่ ...");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('masuser/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }
</script>

<script type="text/javascript">
    Setscreen();
    function Setscreen() {
        var boxsell = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = (boxsell - 365);
        $("#tuser").dataTable({
            //"sPaginationType": "full_numbers", // แสดงตัวแบ่งหน้า
            "bLengthChange": false, // แสดงจำนวน record ที่จะแสดงในตาราง
            //"iDisplayLength": 50, // กำหนดค่า default ของจำนวน record
            //"scrollCollapse": true,
            "paging": false,
            "bFilter": true, // แสดง search box
            "sScrollY": screenfull, // กำหนดความสูงของ ตาราง
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'print'
            ]
        });
    }


</script>