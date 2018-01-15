<?php
$orderModel = new Orders();
$Config = new Configweb_model();
?>    
<table class="table table-striped" id="tb-orderssearch" style=" width: 100%;">
    <thead>
        <tr>
            <th style="text-align: center;">#</th>
            <th>เลขที่สั่งซื้อ</th>
            <th>วันที่สั่งซื้อ</th>
            <th>จำนวน</th>
            <th>ผู้สั่งซื้อ</th>
            <th>สาขา</th>
            <th>สถานะ</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($order as $rs):$i++;
            ?>
            <tr>
                <td style=" text-align: center;"><?php echo $i ?></td>
                <td><a href="<?php echo Yii::app()->createUrl('orders/view', array('order_id' => $rs['order_id'])) ?>">
                        <?php echo $rs['order_id'] ?></a>
                </td>
                <td><?php echo $Config->thaidate($rs['create_date']) ?></td>
                <td><?php echo number_format($rs['total']) ?></td>
                <td><?php echo $rs['name']." ".$rs['lname'] ?></td>
                <td><?php echo $rs['branchname'] ?></td>
                <td style=" color: #000; font-weight: bold;"><?php echo $orderModel->SetstatusOrder($rs['status']) ?></td>
                <td style=" text-align: center;">
                    <?php if ($rs['status'] == '0') { ?>
                        <?php if (Yii::app()->session['branch'] != "99") { ?>
                            <a href="<?php echo Yii::app()->createUrl('orders/update', array('order_id' => $rs['order_id'])) ?>">
                                <i class="fa fa-pencil"></i> แก้ไข</a>
                        <?php } ?>
                        <a href="javascript:Deleteorder('<?php echo $rs['order_id'] ?>')">
                            <i class="fa fa-remove"></i> ยกเลิก</a>
                        <?php } else { ?>
                        -
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    Setscreen();
    function Setscreen() {
        var boxsell = window.innerHeight;
        var w = window.innerWidth;
        var screenfull;
        if (w > 786) {
            screenfull = (boxsell - 435);
        } else {
            screenfull = false;
        }
        $("#tb-orderssearch").dataTable({
            //"sPaginationType": "full_numbers", // แสดงตัวแบ่งหน้า
            "bLengthChange": false, // แสดงจำนวน record ที่จะแสดงในตาราง
            //"iDisplayLength": 50, // กำหนดค่า default ของจำนวน record
            //"scrollCollapse": true,
            "paging": false,
            "bFilter": true, // แสดง search box
            "sScrollY": screenfull, // กำหนดความสูงของ ตาราง
            "sScrollX": true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'print'
            ]
        });
    }

</script>


