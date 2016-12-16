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
    "คลังสินค้า" => array('store/index'),
    "เพิ่มรายการสินค้า"
);

$web = new Configweb_model();
?>

<div class="panel panel-default">
    <div class="panel-heading" style=" padding-bottom: 15px; padding-right: 5px;">
        จำนวนทั้งหมด
        <div class="pull-right">
            <a href="<?php echo Yii::app()->createUrl('centerstockproduct/create') ?>">
                <div class="btn btn-success btn-sm">
                    <i class="fa fa-plus"></i>
                    <i class="fa fa-cart-plus"></i>
                    เพิ่มรายการสินค้า</div></a>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-1" style=" text-align: right;">
                <label>ประเภท</label>
            </div>
            <div class="col-lg-3">
                
                <?php
                $this->widget('booster.widgets.TbSelect2', array(
                    //'model' => $model,
                    'asDropDownList' => true,
                    //'attribute' => 'itemid',
                    'name' => 'producttype',
                    'id' => 'producttype',
                    'data' => CHtml::listData(ProductType::model()->findAll(""), 'type_id', 'type_name'),
                    //'value' => $model,
                    'options' => array(
                        //$model,
                        //'oid',
                        //'tags' => array('clever', 'is', 'better', 'clevertech'),
                        'placeholder' => 'ทั้งหมด',
                        'width' => '100%',
                    //'tokenSeparators' => array(',', ' ')
                    )
                ));
                ?>
            </div>

            <div class="col-lg-3">
                <button type="button" class="btn btn-default">ค้นหา</button>
            </div>
        </div>
        <hr/>
        <table class="table table-bordered" id="p_product">
            <thead>
                <tr>
                    <th>#</th>
                    <th>รหัส</th>
                    <th>ชื่อสินค้า</th>
                    <th style="text-align: center;">ราคา / หน่วย</th>
                    <th style="text-align: center;">คงเหลือ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($product as $last):
                    //$img_title = $product_model->get_images_product_title($last['product_id']);
                    $productID = $last['product_id'];
                    $link = Yii::app()->createUrl('backend/product/detail_product&product_id=' . $last['product_id']);
                    $i++;
                    ?>
                    <tr>
                        <td style=" text-align: center;"><?php echo $i ?></td>
                        <td><?php echo $last['product_name']; ?></td>
                        <td style=" text-align: center; font-weight: bold;">
                            <?php echo number_format($last['product_price'], 2); ?>
                        </td>
                        <td style=" text-align: center; font-weight: bold;"></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
