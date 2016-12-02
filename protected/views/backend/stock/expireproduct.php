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
    "สินค้าใกล้หมด",
);

$stock = new Items();
$web = new Configweb_model();

$Alert = new Alert();
$alam = $Alert->Getalert()['alert_product'];
?>

<div class="panel panel-danger">
    <div class="panel-heading" style=" padding-bottom: 15px; padding-right: 5px;">
        <i class="fa fa-info-circle"></i> สินค้าใกล้หมด *สินค้าเหลือน้อยกว่า <?php echo $alam ?> ชิ้น
    </div>
    <div class="panel-body">
        <p class="text-danger">*คลิกที่รายชื่อสินค้าเพื่อดูรายละเอียด</p>
        <hr/>
        <table class="table table-bordered" id="p_product">
            <thead>
                <tr>
                    <th style=" width: 5%;">#</th>
                    <th>รูป</th>
                    <th>สินค้า</th>
                    <th style="text-align: center;">ราคา / หน่วย</th>
                    <th style="text-align: center;">คงเหลือ</th>
                    <th style="text-align: center;">สถานะ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $product_model = new Product();
                $i = 0;
                foreach ($product as $last):
                    if ($last['TOTAL'] < $alam):
                        //$img_title = $product_model->get_images_product_title($last['product_id']);
                        $productID = $last['product_id'];
                        $Total = $stock->CountItems($productID);
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
                            <td style="text-align: center;"><?php echo $i ?></td>
                            <td style=" text-align: center;">
                                <div class="center-cropped"
                                     style="background: url('<?php echo Yii::app()->baseUrl; ?>/<?php echo $img; ?>')no-repeat top center;
                                     -webkit-background-size: cover;
                                     -moz-background-size: cover;
                                     -o-background-size: cover;
                                     background-size: cover;
                                     text-align:center;">
                                </div>
                                <!--
                                <img src="<?//php echo Yii::app()->baseUrl; ?>/uploads/<?//php echo $img; ?>" class="img-resize img-thumbnail" width=""/>
                                -->
                            </td>
                            <td>
                                <?php echo $last['product_id']; ?><br/>
                                <a href="<?php echo Yii::app()->createUrl('backend/product/detail_product', array('product_id' => $last['product_id'])) ?>"><?php echo $last['product_name']; ?></a>
                            </td>
                            <td style=" text-align: center; font-weight: bold;">
                                <?php echo number_format($last['product_price'], 2); ?>
                            </td>
                            <td style=" text-align: center; font-weight: bold;" class=" text-danger"><i class="fa fa-arrow-right animated faa-tada"></i> <?php echo $Total ?></td>
                            <td style=" text-align: center;">
                                <?php
                                if ($last['status'] == '1') {
                                    echo "<font style='color:red;'><i class='fa fa-ban'></i>ไม่พร้อมขาย</font>";
                                } else {

                                    if ($Total <= '1') {
                                        echo "<font style='color:orange;'><i class='fa fa-warning'></i>เหลือน้อย</font>";
                                    } else {
                                        echo "<font style='color:green;'><i class='fa fa-check'></i>พร้อมขาย</font>";
                                    }
                                }
                                ?>
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

