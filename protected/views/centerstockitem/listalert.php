<style type="text/css">
    .centerstockitem table thead tr th{
        white-space: nowrap;
    }

    .centerstockitem table tbody tr td{
        white-space: nowrap;
    }

</style>
<?php
$this->breadcrumbs = array(
    'วัตถุดิบใกล้หมด',
);

?>

<div class="centerstockitem">
    <div class="panel panel-default" style=" margin-bottom: 0px;">
        <div class="panel-heading" style=" background: none; padding-top: 10px; padding-bottom: 15px; padding-right: 5px; color: #ff0033;">
            <a href="<?php echo Yii::app()->createUrl('centerstockitem/create') ?>" class=" pull-right">
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> เพิ่มวัตถุดิบเข้าคลัง</button></a>
            <i class="fa fa-info-circle"></i> <b>วัตถุดิบใกล้หมด</b>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover" id="stockitem" style="width:100%;">
                <thead>
                    <tr>
                        <th style=" width: 5%; text-align: center;">#</th>
                        <th>รหัส</th>
                        <th>วัตถุดิบ</th>
                        <th style="text-align:right;">จำนวนคงเหลือ</th>
                        <th style="text-align:right;">จำนวนที่ตั้ง</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($listalert as $rs):
                        $i++;
                        ?>
                        <tr>
                            <td style=" text-align: center;"><?php echo $i ?></td>
                            <td><?php echo $rs['itemcode'] ?></td>
                            <td><?php echo $rs['itemname'] ?></td>
                            <td style=" text-align: right; color:red;">
                                <b><?php echo number_format($rs['total']) ?> <?php echo $rs['unit'] ?></b>
                            </td>
                            <td style=" text-align: right;">
                                <?php echo $rs['alert'] ?>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    Setscreen();
    function Setscreen() {
        var boxsell = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull;
        var w = window.innerWidth;
        if (w > 786) {
            screenfull = (boxsell - 295);
        } else {
            screenfull = false;
        }
        $("#stockitem").dataTable({
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
                'excel', 'print'
            ]
        });
    }


</script>