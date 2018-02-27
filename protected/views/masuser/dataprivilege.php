<style type="text/css">
    #pv table thead tr th{
        white-space: nowrap;
    }
    #pv table tbody tr td{
        white-space: nowrap;
    }
</style>
<?php
$system = new Configweb_model();
$MasuserModel = new Masuser();
?>
<div id="pv">
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
                    <a href="<?php echo Yii::app()->createUrl('masuser/view', array('id' => $rs['id'], 'user_id' => $rs['user_id'])) ?>"><i class="fa fa-eye">กำหนดสิทธิ์</i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<script type="text/javascript">
    Setscreen();
    function Setscreen() {
        var boxsell = $(window).height();
        var w = window.innerWidth;
        var screenfull;
        if (w > 768) {
            //var contentboxsell = $("#content-boxsell").height();
            screenfull = (boxsell - 365);
        } else {
            screenfull = false;
        }
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