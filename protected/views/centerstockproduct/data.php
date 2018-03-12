<style type="text/css">
    #p_product tbody tr td b{
        color: #cccccc;
    }
</style>

<script type="text/javascript">
    Setscreen();
    function Setscreen() {
        var boxsell = $(window).height();
        var screenfull;
        var w = window.innerWidth;
        if (w <= 786) {
            screenfull = false;
        } else {
            screenfull = (boxsell - 357);
        }
        $("#p_product").dataTable({
            //"sPaginationType": "full_numbers", // แสดงตัวแบ่งหน้า
            "bLengthChange": false, // แสดงจำนวน record ที่จะแสดงในตาราง
            //"iDisplayLength": 50, // กำหนดค่า default ของจำนวน record
            //"scrollCollapse": true,
            "paging": false,
            "bFilter": true, // แสดง search box
            //"sScrollY": screenfull, // กำหนดความสูงของ ตาราง
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'print'
            ]
        });
    }


</script>

<table class="table table-bordered" id="p_product">
    <thead>
        <tr>
            <th style=" display: none;"></th>
            <th>ข้อมูลสินค้า</th>
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
                <td style=" display: none;"><?php echo $i ?></td>
                <td>
                    <font style=" color: #669900; font-size: 20px;">
                    รหัส: <?php echo $last['product_id']; ?>
                    ชื่อสามัญบริษัท: <?php echo $last['product_name']; ?>
                    </font>
                    <br/>

                    <b>ชื่อเรียกในคลินิก:</b> <?php echo $last['product_nameclinic']; ?><br/>
                    <b>หมวด:</b> <?php echo $last['category'] ?>
                    <b>ประเภท:</b> <?php echo $last['type_name'] ?><br/>
                    <b>ต้นทุน:</b> <label class=" badge" style=" font-size: 20px;"><?php echo number_format($last['costs'], 2); ?></label><br/>
                    <b>ราคาขาย / หน่วย:</b> <label class=" badge" style=" font-size: 20px;"><?php echo number_format($last['product_price'], 2); ?></label><br/>
                    <b>หน่วยนับ:</b> <?php echo $last['unitname'] ?>
                        <b>สถานะ:</b> <?php if ($last['status'] == "1") { ?>
                            <font style="color: #cc0033;"><i class="fa fa-remove"></i> เลิกผลิต</font>
                        <?php } else { ?>
                            <font style="color: #669900;"><i class="fa fa-check"></i> ยังผลิต</font>
                        <?php } ?>
                    <div class="pull-right">
                        <a href="<?php echo $link ?>" class="btn btn-default"><i class="fa fa-file"></i> รายละเอียด</a>
                    </div>
            </tr>
        <?php endforeach; ?>
    </tbody>

</div>
