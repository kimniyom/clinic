<script type="text/javascript">

    Setscreen();
    function Setscreen() {
        var boxsell = window.innerHeight;
        var w = window.innerWidth;
        var screenfull;
        if (w > 786) {
            screenfull = (boxsell - 395);
        } else {
            screenfull = false;
        }
        $("#p_product").dataTable({
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
<?php
$config = new Configweb_model();
$Alert = new Alert();
$alam = $Alert->Getalert()['alert_product'];
?>
<div id="box-data">
    <table class="table table-bordered table-hover" id="p_product" style=" width: 100%;">
        <thead>
            <tr>
                <th style=" width: 5%;">#</th>
                <th>รหัส</th>
                <th>ชื่อสินค้า</th>
                <th style=" text-align: center;">ต้นทุน</th>
                <th style="text-align: center;">ราคา / หน่วย</th>
                <th style="text-align: center;">หมวด</th>
                <th style="text-align: center;">ประเภท</th>
                <th>ล๊อตที่</th>
                <!--
                <th>ผลิต</th>
                -->
                <th>หมดอายุ</th>
                <th>นำเข้า</th>
                <th style=" text-align: right;">คงเหลือ</th>
                <!--
                <th style=" text-align: center;">รายละเอียด</th>
                -->
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $a = 0;
            foreach ($product as $last):
                //$img_title = $product_model->get_images_product_title($last['product_id']);
                $productID = $last['product_id'];
                $link = Yii::app()->createUrl('clinicstockproduct/detail&product_id=' . $last['product_id']);
                if ($last['total'] > 0) {
                    if ($last['number'] <= $alam) {
                        $color = "red";
                    } else {
                        $color = "green";
                    }
                    $a++;
                    ?>
                    <tr>
                        <td style=" text-align: center;"><?php echo $a ?></td>
                        <td><?php echo $last['product_id']; ?></td>
                        <td><?php echo $last['product_name']; ?></td>
                        <td style=" text-align: center; font-weight: bold;">
                            <?php echo number_format($last['costs'], 2); ?>
                        </td>
                        <td style=" text-align: center; font-weight: bold;">
                            <?php echo number_format($last['product_price'], 2); ?>
                        </td>
                        <td><?php echo $last['category'] ?></td>
                        <td><?php echo $last['type_name'] ?></td>
                        <td><?php echo $last['lotnumber'] ?></td>
                        <!--
                        <td><?php //echo $config->thaidate($last['generate'])               ?></td>
                        -->
                        <td><?php echo $config->thaidate($last['expire']) ?></td>
                        <td style=" text-align: right;">
                            <?php echo number_format($last['number']) . ' ' . $last['unit'] ?>
                        </td>
                        <td style=" text-align: right; font-weight: bold; color: <?php echo $color ?>">
                            <?php echo number_format($last['total']) . ' ' . $last['unit'] ?>
                        </td>
                        <td style="text-align: center;">
                            <?php if ($last['number'] == $last['total']) { ?>
                                <a href="javascript:confirmdeletestock('<?php echo $last['id'] ?>')"><i class="fa fa-trash-o"></i></a>
                            <?php } else { ?>
                                <i class="fa fa-lock"></i>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<script type="text/javascript">
    function confirmdeletestock(id) {
        swal({
            title: "Are you sure?",
            text: "การลบข้อมูล หมายถึงลบข้อมูลนี้ออกจากฐานข้อมูลในกรณีคีย์ข้อมูลผิด ... ไม่ใช่การลบสินค้าออกจากคลังสินคา",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#33cc00",
            confirmButtonText: "ยืนยัน",
            closeOnConfirm: false
        },
                function () {
                    var url = "<?php echo Yii::app()->createUrl('clinicstoreproduct/deleteproductlot') ?>";
                    var data = {id: id};
                    $.post(url, data, function (datas) {
                        swal("Deleted!", "Your data has been deleted.", "success");
                        getdata();
                    });
                });
    }
</script>

