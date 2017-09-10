<script type="text/javascript">

    Setscreen();
    function Setscreen() {
        var boxsell = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = (boxsell - 357);
        $("#p_product").dataTable({
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

<table class="table table-bordered table-hover" id="p_product">
    <thead>
        <tr>
            <th style=" width: 5%;">#</th>
            <th>รหัส</th>
            <th>ชื่อสามัญบริษัท</th>
            <th>ชื่อเรียกในคลินิก</th>
            <th style=" text-align: center;">ต้นทุน</th>
            <th style="text-align: center;">ราคา / หน่วย</th>
            <th style="text-align: center;">หมวด</th>
            <th style="text-align: center;">ประเภท</th>
            <th>หน่วย</th>
            <th style=" text-align: center;">รายละเอียด</th>
            <th style=" text-align: center;">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($product as $last):
            //$img_title = $product_model->get_images_product_title($last['product_id']);
            $productID = $last['product_id'];
            $link = Yii::app()->createUrl('centerstockproduct/detail&product_id=' . $last['product_id']);
            if ($last['status'] == "1") {
                $textcolor = "#999999;";
            } else {
                $textcolor = "";
            }
            $i++;
            ?>
            <tr style=" color: <?php echo $textcolor ?>">
                <td style=" text-align: center;"><?php echo $i ?></td>
                <td><?php echo $last['product_id']; ?></td>
                <td><?php echo $last['product_name']; ?></td>
                <td><?php echo $last['product_nameclinic']; ?></td>
                <td style=" text-align: center; font-weight: bold;">
                    <?php echo number_format($last['costs'], 2); ?>
                </td>
                <td style=" text-align: center; font-weight: bold;">
                    <?php echo number_format($last['product_price'], 2); ?>
                </td>
                <td><?php echo $last['category'] ?></td>
                <td><?php echo $last['type_name'] ?></td>
                <td><?php echo $last['unitname'] ?></td>
                <td style="text-align: center;"><a href="<?php echo $link ?>">รายละเอียด</a></td>
                <td style=" text-align: center;">
                    <?php if ($last['status'] == "1") { ?>
                        <font style="color: #cc0033;"><i class="fa fa-remove"></i> เลิกผลิต</font>
                    <?php } else { ?>
                        <font style="color: #669900;"><i class="fa fa-check"></i> ยังผลิต</font>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>