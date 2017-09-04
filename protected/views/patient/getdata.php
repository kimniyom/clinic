<?php
$system = new Configweb_model();
$branchModel = new Branch();
$typeModel = new Gradcustomer();
?>
<table class="table table-bordered" id="patient">
    <thead>
        <tr>
            <th>#</th>
            <th>Pid</th>
            <th>Card</th>
            <th>Name - Lname</th>
            <th>สาขา</th>
            <th>ประเภท</th>
            <th style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($patient as $rs): $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $rs['pid'] ?></td>
                <td><?php echo $rs['card'] ?></td>
                <td><?php echo $rs['name'] . ' ' . $rs['lname'] ?></td>
                <td>
                    <?php
                    $branchId = $rs['branch'];
                    echo $branchModel->find("id = '$branchId'")['branchname'];
                    ?>
                </td>
                <td>
                    <?php
                    $typeId = $rs['type'];
                    echo $typeModel->find("id = '$typeId'")['grad'];
                    ?>
                </td>
                <td style="text-align: center;">
                    <a href="<?php echo Yii::app()->createUrl('patient/view', array('id' => $rs['id'])) ?>"><i class="fa fa-eye"></i></a>
                    <a href="<?php echo Yii::app()->createUrl('patient/update', array('id' => $rs['id'])) ?>"><i class="fa fa-pencil"></i></a>
                    <a href="javascript:deletpatient('<?php echo $rs['id'] ?>')"><i class="fa fa-trash"></i></a>
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
        var screenfull = (boxsell - 380);
        $("#patient").dataTable({
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

