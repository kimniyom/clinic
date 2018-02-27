<title id="title">รายชื่อลูกค้า </title>
<style type="text/css">
    #temployee thead tr th{
        white-space: nowrap;
    }
    #temployee tbody tr td{
        white-space: nowrap;
    }
</style>
<script type="text/javascript">
    Setscreen();
    $(document).ready(function () {
        $("#title").append("<?php echo $model['branchname'] ?>");
    });

    function Setscreen() {
        var boxsell = $(window).height();
        var w = window.innerWidth;
        var screenfull;
        if (w > 768) {
            screenfull = (boxsell - 345);
        } else {
            screenfull = false;
            $(".branchcolumn").hide();
            $(".telcolumn").hide();
            $(".salarycolumn").hide();
        }
        $("#temployee").dataTable({
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

<table class="table table-striped" id="temployee" style=" width: 100%;">
    <thead>
        <tr>
            <th>#</th>
            <th>Name - Lname</th>
            <th>Alias</th>
            <th class="telcolumn" style="text-align: center;">Tel</th>
            <th class="salarycolumn" style="text-align: center;">Salary</th>
            <th class="branchcolumn">Banch</th>
            <th style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($employee as $rs): $i++;
            $branch_id = $rs['branch'];
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $rs['name'] . ' ' . $rs['lname'] ?></td>
                <td><?php echo $rs['alias'] ?></td>
                <td class="telcolumn" style=" text-align: center;"><?php echo $rs['tel'] ?></td>
                <td class="salarycolumn" style=" text-align: center;"><?php echo number_format($rs['salary'], 2) ?></td>
                <td class="branchcolumn"><?php echo Branch::model()->find("id = '$branch_id' ")['branchname'] ?></td>
                <td style="text-align: center;">
                    <a href="<?php echo Yii::app()->createUrl('employee/view', array('id' => $rs['id'])) ?>">
                        <i class="fa fa-eye text-info"></i> รายละเอียด</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>