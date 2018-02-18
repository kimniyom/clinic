<style type="text/css">
    #label{
        color: #006666;
    }
</style>
<?php
$orderModel = new Orders();
$Config = new Configweb_model();
?>    
<table class="table table-striped" id="tb-orderssearch" style=" width: 100%; background: #ffffff;">
    <thead>
        <tr>
            <th style="text-align: center; display: none;">#</th>
            <th>ใบสั่งซื้อสินค้า</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($order as $rs):$i++;
            ?>
            <tr>
                <td style=" text-align: center; display: none;"><?php echo $i ?></td>
                <td>
                    <label id="label">เลขที่สั่งซื้อ:</label> <?php echo $rs['order_id'] ?>
                    <label id="label">วันที่สั่งซื้อ:</label> <?php echo $Config->thaidate($rs['create_date']) ?><br/>
                    <label id="label">จำนวน:</label> <?php echo number_format($rs['total']) ?> <label id="label">ชิ้น</label><br/>
                    <label id="label">ผู้สั่งซื้อ:</label> <?php echo $rs['name'] . " " . $rs['lname'] ?>
                    <label id="label">สาขา:</label> <?php echo $rs['branchname'] ?><br/>
                    <label id="label">สถานะ:</label> <?php echo $orderModel->SetstatusOrder($rs['status']) ?>
                    <hr style="margin-top: 0px;"/>
                    <div class="row" style=" margin: 2px 0px 0px 0px">
                        <div class="col-lg-2 col-md-2 col-sm-4">
                            <a href="<?php echo Yii::app()->createUrl('orders/view', array('order_id' => $rs['order_id'])) ?>">
                                <button type="botton" class="btn btn-primary btn-block">รายละเอียด</button></a>
                        </div>
                        <?php if ($rs['status'] == '0') { ?>
                            <?php if (Yii::app()->session['branch'] != "99") { ?>
                                <div class="col-lg-2 col-md-2 col-sm-4">
                                    <a href="<?php echo Yii::app()->createUrl('orders/update', array('order_id' => $rs['order_id'])) ?>">
                                        <button type="botton" class="btn btn-warning btn-block"><i class="fa fa-pencil"></i> แก้ไข</button></a>
                                </div>
                            <?php } ?>
                            <div class="col-lg-2 col-md-2 col-sm-4">
                                <a href="javascript:Deleteorder('<?php echo $rs['order_id'] ?>')">
                                    <button type="botton" class="btn btn-danger btn-block"><i class="fa fa-remove"></i> ยกเลิก</button></a>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    Setscreen();
    function Setscreen() {
        var boxsell = window.innerHeight;
        var w = window.innerWidth;
        var screenfull;
        if (w > 786) {
            screenfull = (boxsell - 435);
        } else {
            screenfull = false;
        }
        $("#tb-orderssearch").dataTable({
            //"sPaginationType": "full_numbers", // แสดงตัวแบ่งหน้า
            "bLengthChange": false, // แสดงจำนวน record ที่จะแสดงในตาราง
            //"iDisplayLength": 50, // กำหนดค่า default ของจำนวน record
            //"scrollCollapse": true,
            "paging": false,
            "bFilter": true, // แสดง search box
            "sScrollY": screenfull, // กำหนดความสูงของ ตาราง
            "sScrollX": true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'print'
            ]
        });
    }

</script>


