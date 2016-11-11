<style type="text/css">
    .center-cropped {
        width: 50px;
        height: 50px;
        background-position: center center;
        background-repeat: no-repeat;
    }
</style>

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
$this->breadcrumbs = array(
    "สินค้าใกล้หมดอายุ",
);

$stock = new Items();
$web = new Configweb_model();
?>

<div class="panel panel-danger">
    <div class="panel-heading" style=" padding-bottom: 15px; padding-right: 5px;">
        <i class="fa fa-info-circle"></i> สินค้าใกล้หมดอายุ *สินค้าเหลือน้อยกว่า 30 วัน
    </div>
    <div class="panel-body">
        <p class="text-danger">*คลิกที่รายชื่อสินค้าเพื่อดูรายละเอียด</p>
        <hr/>
        <table class="table" id="p_product">
            <thead>
                <tr>
                    <th>#</th>
                    <th>รูป</th>
                    <th>รหัส</th>
                    <th>ชื่อสินค้า</th>
                    <th>Itemcode</th>
                    <th style=" text-align: center;">วันที่หมดอายุ</th>
                    <th style="text-align: center;">คงเหลือ / วัน</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $product_model = new Product();
                $i = 0;
                foreach ($item as $last):
                    if($last['expire'] > 5):
                    //$img_title = $product_model->get_images_product_title($last['product_id']);
                    $productID = $last['product_id'];
                    $firstImg = $product_model->firstpictures($last['product_id']);
                    if (!empty($firstImg)) {
                        $img = "uploads/product/" . $firstImg;
                    } else {
                        $img = "images/No_image_available.jpg";
                    }
                    $link = Yii::app()->createUrl('backend/product/detail_product&product_id=' . $last['product_id']);
                    $i++;
                    $trid = "td" . $i;
                    ?>
                    <tr id="<?php echo $trid; ?>">
                        <td><?php echo $i ?></td>
                        <td>
                            <div class="center-cropped"
                                 style="background: url('<?php echo Yii::app()->baseUrl; ?>/<?php echo $img; ?>')no-repeat top center;
                                 -webkit-background-size: cover;
                                 -moz-background-size: cover;
                                 -o-background-size: cover;
                                 background-size: cover;">
                            </div>
                            <!--
                            <img src="<?//php echo Yii::app()->baseUrl; ?>/uploads/<?//php echo $img; ?>" class="img-resize img-thumbnail" width=""/>
                            -->
                        </td>
                        <td><?php echo $last['product_id']; ?></td>
                        <td><a href="<?php echo Yii::app()->createUrl('backend/product/detail_product',array('product_id' => $last['product_id']))?>"><?php echo $last['product_name']; ?></a></td>
                        <td><?php echo $last['itemcode'] ?></td>
                        <td style="text-align: center;"><?php echo $web->thaidate($last['dateexpire']) ?></td>
                        <td style=" text-align: center; font-weight: bold;" class=" text-danger"><i class="fa fa-arrow-right animated faa-tada"></i> <?php echo $last['expire'] ?></td>
                        
                    </tr>
                <?php 
                endif;
                endforeach; 
                ?>
            </tbody>
        </table>
    </div>
</div>

