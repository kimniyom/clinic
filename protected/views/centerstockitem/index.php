<style type="text/css">
    #cutstock{
        background: #003d2d;
        color: #ff0000;
    }
    #bcutstock{
        background: #ccffff;
        font-weight: bold;
    }

    table tbody tr td{
        padding: 5px;
    }

    .centerstockitem table thead tr th{
        white-space: nowrap;
    }

    .centerstockitem table tbody tr td{
        white-space: nowrap;
    }

</style>
<?php
/* @var $this CenterStockitemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    //'คลังสินค้า' => Yii::app()->createUrl('store/index'),
    'คลังวัตถุดิบ',
);
?>
<div class="centerstockitem">
    <div class="panel panel-default" style=" margin-bottom: 0px;">
        <div class="panel-heading" style=" background: none; padding-top: 10px; padding-bottom: 15px; padding-right: 5px;">
            <b>คลังวัตถุดิบ</b>
            <a href="<?php echo Yii::app()->createUrl('centerstockitem/create') ?>" class=" pull-right">
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> เพิ่มวัตถุดิบเข้าคลัง</button></a>
            <span style=" margin-top: 5px;">*<i class="fa fa-lock"></i> <font style="color:red;">มีการตัดสต๊อกไม่สามารถแก้ไขหรือลบได้</font></span>
            <span style=" margin-top: 5px;">*</i> <font style="color:red;">คลิกที่แถวเพื่อจัดการข้อมูล</font></span>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover" id="stockitem" style="width:100%;">
                <thead>
                    <tr>
                        <th style=" width: 5%; text-align: center;">#</th>
                        <th>ล๊อต</th>
                        <th>รหัส</th>
                        <th>วัตถุดิบ</th>
                        <th>จำนวน</th>
                        <th>ราคาซื้อเข้ารวม</th>
                        <th style=" text-align: center;">หมดอายุ</th>
                        <th style=" text-align: center;">วันที่นำเข้า</th>
                        <th id="cutstock">จำนวนที่ตัดได้</th>
                        <th id="cutstock">จำนวนคงเหลือ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($item as $rs):
                        if ($rs['totalcut'] > "0" && $rs['outstock'] == "F"):
                            $i++;
                            if ($rs['expire'] < date("Y-m-d") && $rs['expire'] != '') {
                                $class = "class='danger'";
                                $status = "1";
                            } else {
                                $class = "";
                                $status = "2";
                            }
                            ?>
                            <tr <?php echo $class ?> onclick="action('<?php echo $rs['id'] ?>', '<?php echo $status ?>')" style="cursor: pointer;">
                                <td style=" text-align: center;"><?php echo $i ?></td>
                                <td><?php echo $rs['lotnumber'] ?></td>
                                <td><?php echo $rs['itemcode'] ?></td>
                                <td><?php echo $rs['itemname'] ?></td>
                                <td><?php echo $rs['number'] ?> <?php echo $rs['unit'] ?></td>
                                <td style=" text-align: right"><?php echo number_format($rs['price']) ?></td>
                                <td style=" text-align: center;"><?php echo $rs['expire'] != "" ? $rs['expire'] : "-"; ?></td>
                                <td style=" text-align: center;"><?php echo $rs['create_date'] ?></td>
                                <td id="bcutstock" style=" text-align: right;"><?php echo number_format($rs['numbercut']) ?> <?php echo $rs['unitcutstock'] ?></td>
                                <td id="bcutstock" style=" text-align: right;"><?php echo number_format($rs['totalcut']) ?> <?php echo $rs['unitcutstock'] ?></td>

                            </tr>
                            <?php
                        endif;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Action -->
<div class="modal fade" tabindex="-1" role="dialog" id="action" style="margin-top:20%;">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <input type="hidden" id="_id">
                <div class="row" id="outstock">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button class="btn btn-default btn-block btn-lg" onclick="outstock()"><i class="fa fa-remove"></i> นำออกจากคลังสินค้า</button>
                    </div>
                </div>
                <div class="row" style="margin-top:10px;" id="editupdate">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <button class="btn btn-default btn-block btn-lg" onclick="edit()"><i class="fa fa-pencil"></i> แก้ไข</button>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <button class="btn btn-default btn-block btn-lg" onclick="Delete()"><i class="fa fa-trash"></i> ลบ</button>
                    </div>
                </div>
                <hr/>
                <button type="button" class="btn btn-default btn-block btn-lg" data-dismiss="modal">Close</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
    function Delete() {
        var r = confirm("Are you sure ..?");
        if (r == true) {
            var id = $("#_id").val();
            var url = "<?php echo Yii::app()->createUrl('centerstockitem/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }

    function edit() {
        var id = $("#_id").val();
        var url = "<?php echo Yii::app()->createUrl('centerstockitem/update') ?>" + "&id=" + id;
        window.location = url;
    }


    Setscreen();
    function Setscreen() {
        var boxsell = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull;
        var w = window.innerWidth;
        if (w > 786) {
            screenfull = (boxsell - 295);
        } else {
            screenfull = false;
        }
        $("#stockitem").dataTable({
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

    function action(id, status) {
        $("#_id").val(id);
        if (status == 1) {
            $("#outstock").show();
            $("#editupdate").hide();
        } else {
            $("#outstock").hide();
            $("#editupdate").show();
        }
        $("#action").modal();
    }

    function outstock() {
        var id = $("#_id").val();
        var url = "<?php echo Yii::app()->createUrl('centerstockitem/outstock') ?>";
        var data = {id: id};
        $.post(url, data, function (datas) {
            window.location.reload();
            /*
             $("#_id").val('');
             $("#action").modal('hide');
             */
        });
    }
</script>


