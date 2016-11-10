<style type="text/css">
    table tr td{ height:30px;}
    #im-resize{height: 75px; padding: 5px; margin-bottom: 5px;}
    #cart_box{
        float: right; margin-top: 0px; padding-top: 15px;
        position:fixed; top:10px; right:20px;z-index:3;
    }
</style>

<script type="text/javascript">
    function set_group_img(img) {
        $("#img_group").html("<img src='<?php echo Yii::app()->baseUrl ?>/uploads" + "/" + img + " ' width='80%' style='margin-right:20px;' />");
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover();

        $('.img_zoom').magnificPopup({
            delegate: 'a', // child items selector, by clicking on it popup will open
            type: 'image',
            gallery: {
                enabled: true
            }
            // other options
        });

    });
</script>


<?php
$this->breadcrumbs = array(
    $product['type_name'] => array('backend/product/getproduct&type_id=' . $product['type_id']),
    $product['product_name'],
);

$ItemModel = new Items();
$Web = new Configweb_model();
$product_id = $product['product_id'];
$Total = $ItemModel->CountItems($product_id);
?>

<?php $config = new Configweb_model(); ?>

<span class="navbar-brand" id="cart_box" data-toggle="popover" 
      data-trigger="hover" data-placement="left" data-trigger="focus"
      data-content="ตะกร้าสินค้า">
    <a href="Javascript:void(0);" onclick="show_list_cart();">
        <i class="shopping-cart"></i>
    </a>
    <div class="label label-success" id="load_inbox_cart" 
         style="text-align: center; font-size: 12px; position: absolute; top: 10px; right: 10px;">
    </div>
</span>

<div class="well" style=" width:100%; margin-top:20px;text-align: left; background: #FFF;">
    <div class="row">

        <div class="col-lg-6 col-md-12 col-xs-12">

            <font style=" color: #F00; font-size: 24px; font-weight: normal;">
            <img src="<?php echo Yii::app()->baseUrl; ?>/images/yellow-tag-icon.png"/>
            <?= $product['product_name'] ?>
            </font><br/>
            <b>รหัสสินค้า</b> <?= $product['product_id'] ?><br/>
            <b>ประเภทสินค้า</b> <?= $product['type_name'] ?><br/>
            <b>อัพเดทล่าสุด</b> <?= $config->thaidate($product['d_update']); ?>
            <font style=" font-size: 24px;">
            ราคา <?= number_format($product['product_price']) ?>.-  บาท
            </font>
            <hr/>
            <div class="row" style=" text-align: center; margin-bottom: 10px;">
                <div class="col-md-12 col-lg-12">
                    <span class="btn btn-default btn-block"><h4>จำนวนคงเหลือ <?php echo $Total ?></h4></span>
                </div>
            </div>

            <div class="row" style=" text-align: center;">
                <div class="col-md-4 col-lg-4"><button type="button" class="btn btn-danger btn-sm btn-block"><=0 วัน</button><br/>หมดอายุ</div>
                <div class="col-md-4 col-lg-4"><button type="button" class="btn btn-warning btn-sm btn-block">< 30 วัน</button><br/>ใกล้หมดอายุ</div>
                <div class="col-md-4 col-lg-4"><button type="button" class="btn btn-success btn-sm btn-block">> 30 วัน</button><br/>ยังไม่หมดอายุ</div>
            </div>
            <hr/>

            <button type="button" class="btn btn-success btn-sm" onclick="popup_add_items('<?php echo $product['product_id'] ?>', '<?php echo $product['product_name'] ?>')">
                <i class="fa fa-plus text-success"></i> เพิ่มจำนวน Item</button>
                <br/><br/>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Itemcode</td>
                        <td>Input</td>
                        <td>Expire</td>
                        <td style=" text-align: center;">หมดอายุ</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($items as $item): $i++;
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $item['itemcode'] ?></td>
                            <td><?php echo $Web->thaidate($item['date_input']) ?></td>
                            <td><?php echo $Web->thaidate($item['expire']) ?></td>
                            <td style="text-align: center;">
                                <?php
                                echo $ItemModel->DayExpire($item['day_expire']);
                                ?>
                            </td>
                            <td style=" text-align: center;">
                                <a href="javascript:deleteitems('<?php echo $item['id'] ?>')"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="col-lg-6 col-md-12 col-xs-12" style=" padding-top: 20px;">
            <?php
            $product_model = new Product();
            $img_title = $product_model->firstpictures($product['product_id']);
            if (!empty($img_title)) {
                $img = "uploads/product/" . $img_title;
            } else {
                $img = "images/No_image_available.jpg";
            }
            if ($img != "") {
                ?>
                <center>
                    <img src="<?= Yii::app()->baseUrl ?>/<?= $img; ?>" class="img-responsive thumbnail" alt="Responsive image" id="img-cart"/>
                </center>     
            <?php } else { ?>
                <div id="img" style="width:400px; height:350px; background:#CCC; font-size:36px; text-align:center; padding-top:30px; margin-right:20px;">
                    NO<br />Images 
                </div>
            <?php } ?>
            <br/>
            <?php if ($img != "No-Camera-icon.png") { ?>
                <div class=" row">
                    <div class=" col-lg-12">
                        <!-- Img -->
                        <?php if ($img != "") { ?>
                            <div class="img_zoom">
                                <center>
                                    <?php foreach ($images as $rs): ?>
                                        <!--
                                            <a href="javascript:void(0);" onclick="set_group_img('<?//php echo $rs->images ?>');" style=" text-decoration: none;">
                                        -->
                                        <a class="image-link" href="<?php echo Yii::app()->baseUrl; ?>/uploads/product/<?= $rs['images'] ?>">
                                            <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/product/<?= $rs['images'] ?>" class="btn btn-default" id="im-resize" style=" background: #FFF;"/></a>
                                    <?php endforeach; ?>
                                </center>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <hr/>
    <h4 style="font-weight:bold; font-size: 24px; color: #F00;">
        <i class="fa fa-tag"></i> รายละเอียด
    </h4>
    <div class="well">
        <div class="row" id="etc_product">
            <div class="col-lg-12 col-md-12">
                <?= $product['product_detail'] ?>
            </div>
        </div>
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
                    $monthname = $config->MonthFull();
                    $monthval = $config->Monthval();
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
                            for ($i = ($yearnow + 10); $i >= $yearnow - 10; $i--) {
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
                        <input type="text" class="form-control" id="date_input" readonly="readonly" value="<?php echo $config->thaidate(date("Y-m-d")) ?>">
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

<script type='text/javascript'>
    function deleteitems(id) {
        var r = confirm('Are you sure ...?');
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('backend/items/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }

    function popup_add_items(productID, productName) {
        var url = "<?php echo Yii::app()->createUrl('backend/items/genitemcode') ?>";
        var data = {};
        $.post(url, data, function (datas) {
            $("#itemcode").val(datas.itemcode);
        }, 'Json');
        $("#product_id").val(productID);
        $("#popuptitle").text("สินค้า : " + productName);
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