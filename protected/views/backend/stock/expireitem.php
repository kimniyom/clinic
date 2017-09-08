<?php
$this->breadcrumbs = array(
    "สินค้าใกล้หมดอายุ",
);

$stock = new Items();
$web = new Configweb_model();
$Alert = new Alert();
$alam = $Alert->Getalert()['alert_expire'];
?>

<div class="panel panel-default" style=" margin-bottom: 0px;">
    <div class="panel-heading" style=" padding-bottom: 15px; padding-right: 5px; background: none;">
        <i class="fa fa-info-circle"></i> สินค้าใกล้หมดอายุ *สินค้าเหลือน้อยกว่า <?php echo $alam ?> วัน
        <span class="text-danger">*คลิกที่รายชื่อสินค้าเพื่อดูรายละเอียด</span>
    </div>
    <div class="panel-body">
        <table class="table table-bordered" id="p_product">
            <thead>
                <tr>
                    <th>#</th>
                    <th>สินค้า</th>
                    <th style=" text-align: center;">ล๊อตสินค้า</th>
                    <th style=" text-align: center;">วันที่หมดอายุ</th>
                    <th style="text-align: center;">คงเหลือ / วัน</th>
                    <th style="text-align: center;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $product_model = new Product();
                $i = 0;
                $branch = Yii::app()->session['branch'];
                foreach ($item as $last):
                    $productID = $last['product_id'];
                    $link = Yii::app()->createUrl('clinicstockproduct/detail', array("product_id" => $last['product_id'], "branch" => $branch));
                    $i++;
                    $trid = "td" . $i;
                    ?>
                    <tr id="<?php echo $trid; ?>">
                        <td><?php echo $i ?></td>
                        <td>
                            <a href="<?php echo $link ?>">
                                <?php echo $last['product_id']; ?> <?php echo $last['product_nameclinic']; ?></a>
                        </td>
                        <td style="text-align: center;"><?php echo $last['lotnumber']; ?></td>
                        <td style="text-align: center;"><?php echo $web->thaidate($last['expire']) ?></td>
                        <td style=" text-align: center; font-weight: bold;" class=" text-danger"><?php echo $last['dayexpire'] ?></td>
                        <td style=" text-align: center; font-weight: bold;">
                            <a href="javascript:delstock('<?php echo $last['id'] ?>')"><i class="fa fa-trash-o"></i>ลบออกจากคลัง</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    Setscreen();
    function Setscreen() {
        var boxsell = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = (boxsell - 290);
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

    function delstock(id) {
        var r = confirm("Are you sure...?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('backend/stock/delstock') ?>";
            var data = {id: id};
            $.post(url, data, function (datas) {
                window.location.reload();
            });
        }
    }
</script>



