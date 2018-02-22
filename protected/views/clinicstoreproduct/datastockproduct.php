<style type="text/css">
    #box-data table thead tr th{
        white-space: nowrap;
    }
    #box-data table tbody tr td{
        white-space: nowrap;
    }
</style>

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
                <!--
                <th style="text-align: center;">หมวด</th>
                <th style="text-align: center;">ประเภท</th>
                -->
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
                        <!--
                        <td><?php //echo $last['category']             ?></td>
                        <td><?php //echo $last['type_name']             ?></td>
                        -->
                        <td><?php echo $last['lotnumber'] ?></td>
                        <!--
                        <td><?php //echo $config->thaidate($last['generate'])                           ?></td>
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
                        <td style=" padding: 0px;"><a href="javascript:handcutstock('<?php echo $last['product_id']; ?>','<?php echo $last['lotnumber'] ?>','<?php echo $last['product_name']; ?>','<?php echo $last['total'] ?>')" class="btn btn-info btn-block" style=" margin: 0px; font-size: 18px;"><i class="fa fa-cut"></i> ตัดสต๊อกด้วยมือ</a></td>
                    </tr>
                <?php } ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<!--
    POPUP HandCutStock
-->

<div class="modal fade bs-example-modal-sm" tabindex="-1" data-backdrop='static' role="dialog" aria-labelledby="mySmallModalLabel" id="popupcutstock">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">ตัดสต๊อก(<span id="cut_productname"></span>)</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="cut_product_id" />
                <label>ล๊อตที่</label>
                <input type="text" class="form-control" id="cut_lotnumber" readonly="readonly"/>
                <label>คงเหลือ</label>
                <input type="text" class="form-control" id="cut_total" readonly="readonly"/>
                <label>จำนวนสินค้า</label>
                <input id='cut_number' placeholder="ตัวเลขเท่านั้น ..." class="form-control" type='text' onKeyUp="if (this.value * 1 != this.value)
                            this.value = '';" >
                <label>หมายเหตุ</label>
                <textarea id="etc" class="form-control" rows="5"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-block" onclick="cutstock()">ยืนยัน</button>
            </div>
        </div>
    </div>
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

    function handcutstock(product_id, lotnumber, productname, total) {
        $("#cut_product_id").val(product_id);
        $("#cut_lotnumber").val(lotnumber);
        $("#cut_total").val(total);
        $("#cut_productname").html(productname);
        $("#popupcutstock").modal();
    }

    function cutstock() {
        var product_id = $("#cut_product_id").val();
        var lotnumber = $("#cut_lotnumber").val();
        var total = $("#cut_total").val();
        var number = $("#cut_number").val();
        var etc = $("#etc").val();
        var totals = parseInt(total);
        var numbers = parseInt(number);
        if (number == "") {
            $("#cut_number").focus();
            return false;
        }
        
        if (numbers > totals || numbers == "0") {
            swal("ข้อมูลจำนวนไม่ถูกต้อง ...!");
            return false;
        }
    }
</script>

