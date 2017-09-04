<title id="title">รายชื่อลูกค้า </title>
<script type="text/javascript">
    $(document).ready(function(){
       $("#title").append("<?php echo $model['branchname'] ?>"); 
    });
    Setscreen();
    function Setscreen() {
        var boxsell = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = (boxsell - 360);
        $("#temployee").dataTable({
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

<?php 
    $EmpModel = new Employee();
?>
<table class="table table-bordered" id="temployee">
    <thead>
        <tr>
            <th>#</th>
            <th>Name - Lname</th>
            <th>Alias</th>
            <th style="text-align: center;">Tel</th>
            <th style="text-align: center;">Salary</th>
            <th>สาขา</th>
            <th style=" text-align: center;">ยอดขาย</th>
            <th style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($employee as $rs): $i++;
            $branch_id = $rs['branch'];
            $total = $EmpModel->Selltotalyearnow($rs['id']);
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $rs['name'] . ' ' . $rs['lname'] ?></td>
                <td><?php echo $rs['alias'] ?></td>
                <td style=" text-align: center;"><?php echo $rs['tel'] ?></td>
                <td style=" text-align: center;"><?php echo number_format($rs['salary'], 2) ?></td>
                <td><?php echo Branch::model()->find("id = '$branch_id' ")['branchname'] ?></td>
                <td style=" text-align: right;"><?php echo $total ?></td>
                <td style="text-align: center;">
                    <a href="<?php echo Yii::app()->createUrl('employee/view', array('id' => $rs['id'])) ?>">
                        <i class="fa fa-eye text-info"></i> รายละเอียด</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>