<style type="text/css">
    #p_product thead tr th{
        white-space: nowrap;
    }
    #p_product tbody tr td{
        white-space: nowrap;
    }
</style>
<script type="text/javascript">

    Setscreen();
    function Setscreen() {
        var boxsell = $(window).height();
        var w = window.innerWidth;
        var screenfull;
        if (w > 786) {
            screenfull = (boxsell - 390);
        } else {
            screenfull = false;
            $(".columns").hide();
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

<table class="table table-bordered table-hover" id="p_product" style=" width: 100%;">
    <thead>
        <tr>
            <th style=" width: 5%;">#</th>
            <th class="columns">รหัส</th>
            <th>ชื่อสินค้า</th>
            <th style=" text-align: center;" class="columns">ต้นทุน</th>
            <th style="text-align: center;">ราคา / หน่วย</th>
            <th style="text-align: center;" class="columns">หมวด</th>
            <th style="text-align: center;" class="columns">ประเภท</th>
            <th class="columns">หน่วย</th>
            <th style=" text-align: center;">รายละเอียด</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($product as $last):
            //$img_title = $product_model->get_images_product_title($last['product_id']);
            $productID = $last['product_id'];
            $link = Yii::app()->createUrl('clinicstockproduct/detail',array("product_id" => $last['product_id'],"branch" => $branch));
            $i++;
            ?>
            <tr>
                <td style=" text-align: center;"><?php echo $i ?></td>
                <td class="columns"><?php echo $last['product_id']; ?></td>
                <td>
                    <?php
                    $product_id = $last['product_id'];
                    echo CenterStockproduct::model()->find("product_id = '$product_id' ")['product_nameclinic'];
                    ?>
                </td>
                <td style=" text-align: center; font-weight: bold;" class="columns">
                    <?php echo number_format($last['costs'], 2); ?>
                </td>
                <td style=" text-align: center; font-weight: bold;">
                    <?php echo number_format($last['product_price'], 2); ?>
                </td>
                <td class="columns"><?php echo $last['category'] ?></td>
                <td class="columns"><?php echo $last['type_name'] ?></td>
                <td class="columns"><?php echo $last['unitname'] ?></td>
                <td style="text-align: center;"><a href="<?php echo $link ?>" style="text-decoration: none;">รายละเอียด</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>