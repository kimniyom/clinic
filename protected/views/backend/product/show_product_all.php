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
    "คลังสินค้า" => array('producttype/index'),
    $type_name,
);

$stock = new Items();
$web = new Configweb_model();
?>

<div class="panel panel-default">
    <div class="panel-heading" style=" padding-bottom: 15px; padding-right: 5px;">
        <?php echo $type_name ?> จำนวนทั้งหมด
        <?php echo $count_product_type; ?>
        <div class="pull-right">
            <a href="<?php echo Yii::app()->createUrl('backend/product/create&type_id=' . $type_id) ?>">
                <div class="btn btn-success btn-sm">
                    <i class="fa fa-plus"></i>
                    <i class="fa fa-cart-plus"></i>
                    เพิ่มรายการสินค้า</div></a>
        </div>
    </div>
    <div class="panel-body">
        <table class="table" id="p_product">
            <thead>
                <tr>
                    <th>#</th>
                    <th style="text-align:center;"><i class="fa fa-cog"></i></th>
                    <th>รูป</th>
                    <th>รหัส</th>
                    <th>ชื่อสินค้า</th>
                    <th style="text-align: center;">ราคา / หน่วย</th>
                    <th style="text-align: center;">คงเหลือ</th>
                    <th style="text-align: center;">สถานะ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $product_model = new Product();
                $i = 0;
                foreach ($product as $last):
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
                        <td><?php echo $i ?></td>
                        <td style=" text-align: center;">
                            <div class="dropdown">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    จัดการ
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="text-align:left;">
                                    <li><a href="<?php echo $link; ?>"><i class="fa fa-eye"></i> รายละเอียด</a></li>
                                    <li><a href="<?php echo Yii::app()->createUrl('backend/product/update', array('type_id' => $last['type_id'], 'product_id' => $last['product_id'])); ?>"><i class="fa fa-edit"></i> แก้ไข</a></li>
                                    <!--
                                    <li><a href="javascript:delete_product('<?//php echo $last['product_id'] ?>','<?//php echo $trid ?>')"><i class="fa fa-trash"></i> ลบ</a></li>
                                    -->
                                </ul>
                            </div>
                        </td>
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
                        <td style=" width: 10%;">
                          <?php
                                echo '<div id="' . $last['product_id']. '" style="width:30px;"><div>'; //the same id should be given to the extension item id 

                                $optionsArray = array(
                                'elementId' => $last['product_id'], /* id of div or canvas */
                                'value' => $last['product_id'], /* value for EAN 13 be careful to set right values for each barcode type */
                                'type' => 'code128', /* supported types  ean8, ean13, upc, std25, int25, code11, code39, code93, code128, codabar, msi, datamatrix */
                                'settings' => array(
                   
                                /* "1" Bars color */
                                //'barWidth' => "1",
                                'barHeight' => "30",
                                
                                ),
                                );
                                $this->widget('ext.Yii-Barcode-Generator.Barcode', $optionsArray);
                                ?>
                            <?php //echo $last['product_id']; ?>
                        </td>
                        <td><?php echo $last['product_name']; ?></td>
                        <td style=" text-align: center; font-weight: bold;">
                            <?php echo number_format($last['product_price'], 2); ?>
                        </td>
                        <td style=" text-align: center; font-weight: bold;"><?php echo $Total ?></td>
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
                        <td>
                            <button type="button" class="btn btn-default"
                                    onclick="popup_add_items('<?php echo $productID ?>', '<?php echo $last['product_name']; ?>')"><i class="fa fa-plus"></i> เพิ่มจำนวนสินค้า</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!--
    ### POPUP MODAL ADD ITEMS
-->


<div class="modal fade" tabindex="-1" role="dialog" id="popupitems">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="popuptitle" style=" color: #0063dc;"></h4>
            </div>
            <div class="modal-body" style=" color: #339900;">
                <form class="form-inline">
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                        <div class="input-group">
                            <div class="input-group-addon">ProductID</div>
                            <input type="text" class="form-control" id="product_id" readonly="readonly">
                        </div>
                    </div>
                    <br/> <br/>
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                        <div class="input-group">
                            <div class="input-group-addon">ItemCode</div>
                            <input type="text" class="form-control" id="itemcode" readonly="readonly">
                        </div>
                    </div>
                </form>
                <br/>
                <label>
                    วันที่หมดอายุ
                </label>
                <div class="row">
                    <?php
                    $monthname = $web->MonthFull();
                    $monthval = $web->Monthval();
                    ?>

                    <div class="col-sm-2">
                        <select id="day" name="day" class="form-control">
                            <option value="">วันที่</option>
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                                if (strlen($i) <= 1) {
                                    $day = "0" . $i;
                                } else {
                                    $day = $i;
                                }
                                ?>
                                <option value="<?php echo $day; ?>" <?php
                            if ($i == date('d')) {
                                echo "selected";
                            }
                                ?>><?php echo $day; ?></option>
                                    <?php } ?>
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <select id="month" name="month" class="form-control">
                            <option value="">เดือน</option>
                            <?php for ($i = 0; $i <= 11; $i++) { ?>
                                <option value="<?php echo $monthval[$i]; ?>"><?php echo $monthname[$i]; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <select id="year" name="year" class="form-control">
                            <option value="">ปี</option>
                            <?php
                            $yearnow = date("Y");
                            for ($i = ($yearnow + 10); $i >= $yearnow; $i--) {
                                ?>
                                <option value="<?php echo $i; ?>"><?php echo $i + 543; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <br/>

                <div class="form-group">
                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                    <div class="input-group">
                        <div class="input-group-addon">วันที่บันทึก</div>
                        <input type="text" class="form-control" id="date_input" readonly="readonly" value="<?php echo $web->thaidate(date("Y-m-d")) ?>">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <!--
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                -->
                <button type="button" class="btn btn-success" onclick="SaveItems()"><i class="fa fa-plus-circle"></i> เพิ่ม Item</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    function delete_product(id, trid) {
        var url = "<?php echo Yii::app()->createUrl('backend/orders/product_in_order') ?>";
        var data = {product_id: id};

        $.post(url, data, function (result) {
            if (result == '1') {
                alert("มีการสั่งซื้อสินค้าชิ้นนี้อยู่กรุณาตรวจสอบ");
            } else {
                $("#" + trid).fadeOut();
            }
        });
    }

    function popup_add_items(productID, productName) {
        var url = "<?php echo Yii::app()->createUrl('backend/items/genitemcode') ?>";
        var data = {};
        $.post(url, data, function (datas) {
            $("#itemcode").val(datas.itemcode);
        }, 'Json');
        $("#product_id").val(productID);
        $("#popuptitle").text(productName);

        $("#popupitems").modal();
    }

    

    function SaveItems() {
        var url = "<?php echo Yii::app()->createUrl('backend/items/save') ?>";
        var product_id = $("#product_id").val();
        var itemcode = $("#itemcode").val();
        var day = $("#day").val();
        var month = $("#month").val();
        var year = $("#year").val();

        if (day == "" || month == "" || year == "") {
            alert("กรุณาเลือกวันหมดอายุ ...!");
            return false;
        }
        var expire = year + month + day;
        var data = {
            product_id: product_id,
            itemcode: itemcode,
            expire: expire
        };

        $.post(url, data, function (success) {
            window.location.reload();
        });
    }
</script>
