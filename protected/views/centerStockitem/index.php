<style type="text/css">
    #cutstock{
        background: #003d2d;
        color: #ff0000;
    }
    #bcutstock{
        background: #ccffff;
        font-weight: bold;
    }

    table tbody tr td{
        padding: 5px;
    }
</style>
<?php
/* @var $this CenterStockitemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'คลังสินค้า' => Yii::app()->createUrl('store/index'),
    'คลังวัตถุดิบ',
);
?>

<div class="panel panel-default" style=" margin-bottom: 0px;">
    <div class="panel-heading" style=" background: none; padding-top: 10px; padding-bottom: 15px; padding-right: 5px;">
        <b>คลังวัตถุดิบ</b>
        <a href="<?php echo Yii::app()->createUrl('centerstockitem/create') ?>" class=" pull-right">
        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> เพิ่มวัตถุดิบเข้าคลัง</button></a>
        <span style=" margin-top: 5px;">*<i class="fa fa-lock"></i> <font style="color:red;">มีการตัดสต๊อกไม่สามารถแก้ไขหรือลบได้</font></span>

    </div>
    <div class="panel-body">

        <table class="table table-bordered table-hover" id="stockitem">
            <thead>
                <tr>
                    <th style=" width: 5%; text-align: center;">#</th>
                    <th>ล๊อต</th>
                    <th>รหัส</th>
                    <th>วัตถุดิบ</th>
                    <th>จำนวน</th>
                    <th>ราคาซื้อเข้ารวม</th>
                    <th style=" text-align: center;">วันที่นำเข้า</th>
                    <th id="cutstock">จำนวนที่ตัดได้</th>
                    <th id="cutstock">จำนวนคงเหลือ</th>
                    <th style=" text-align: center;">ตัวเลือก</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($item as $rs): 
                    if ($rs['totalcut'] > "0"):
                        $i++;
                        ?>
                        <tr>
                            <td style=" text-align: center;"><?php echo $i ?></td>
                            <td><?php echo $rs['lotnumber'] ?></td>
                            <td><?php echo $rs['itemcode'] ?></td>
                            <td><?php echo $rs['itemname'] ?></td>
                            <td><?php echo $rs['number'] ?> <?php echo $rs['unit'] ?></td>
                            <td style=" text-align: right"><?php echo number_format($rs['price']) ?></td>
                            <td style=" text-align: center;"><?php echo $rs['create_date'] ?></td>
                            <td id="bcutstock" style=" text-align: right;"><?php echo number_format($rs['numbercut']) ?> <?php echo $rs['unitcutstock'] ?></td>
                            <td id="bcutstock" style=" text-align: right;"><?php echo number_format($rs['totalcut']) ?> <?php echo $rs['unitcutstock'] ?></td>
                            <td style=" text-align: center; width: 10%;">
                                <?php if ($rs['numbercut'] != $rs['totalcut']) { ?>
                                    <i class="fa fa-lock"></i>
                                <?php } else { ?>
                                    <a href="<?php echo Yii::app()->createUrl('centerstockitem/update', array('id' => $rs['id'])) ?>"><i class="fa fa-pencil"></i> แก้ไข</a>
                                    <a href="javascript:Delete('<?php echo $rs['id'] ?>')"><i class="fa fa-trash"></i> ลบ</a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php
                    endif;
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    function Delete(id) {
        var r = confirm("Are you sure ..?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('centerstockitem/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }


    Setscreen();
    function Setscreen() {
        var boxsell = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = (boxsell - 295);
        $("#stockitem").dataTable({
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


