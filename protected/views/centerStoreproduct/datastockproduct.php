<script type="text/javascript">
    $(document).ready(function () {
        $("#p_product").dataTable({
            //"sPaginationType": "full_numbers", // แสดงตัวแบ่งหน้า
            "bLengthChange": false, // แสดงจำนวน record ที่จะแสดงในตาราง
            "iDisplayLength": 10, // กำหนดค่า default ของจำนวน record
            "bFilter": true // แสดง search box
                    //"sScrollY": "400px", // กำหนดความสูงของ ตาราง
        });
    });
</script>
<?php 
    $config = new Configweb_model();
?>
<table class="table table-bordered table-hover" id="p_product">
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
            <th>ผลิต</th>
            <th>หมดอายุ</th>
             <th style=" text-align: right;">คงเหลือ</th>
            <th style=" text-align: center;">รายละเอียด</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($product as $last):
            //$img_title = $product_model->get_images_product_title($last['product_id']);
            $productID = $last['product_id'];
            $link = Yii::app()->createUrl('centerstockproduct/detail&product_id=' . $last['product_id']);
            $i++;
            ?>
            <tr>
                <td style=" text-align: center;"><?php echo $i ?></td>
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
                <td><?php echo $config->thaidate($last['generate']) ?></td>
                <td><?php echo $config->thaidate($last['expire']) ?></td>
                <td style=" text-align: right;"><?php echo $last['total'].' '.$last['unit'] ?></td>
                <td style="text-align: center;"><a href="<?php echo $link ?>">รายละเอียด</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>