<style type="text/css">
    .centerstockitem table thead tr th{
        white-space: nowrap;
    }

    .centerstockitem table tbody tr td{
        white-space: nowrap;
    }

</style>
<?php
$Config = new Configweb_model();
$this->breadcrumbs = array(
    'วัตถุดิบหมดอายุ',
);
?>

<div class="centerstockitem">
    <div class="panel panel-default" style=" margin-bottom: 0px;">
        <div class="panel-heading" style=" background: none; color: #ff0000;">
            <i class="fa fa-info-circle"></i> วัตถุดิบหมดอายุ
            <span style=" margin-top: 5px;">*</i> <font style="color:red;">คลิกที่แถวเพื่อจัดการข้อมูล</font></span>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover" id="stockitem" style="width:100%;">
                <thead>
                    <tr>
                        <th style=" width: 5%; text-align: center;">#</th>
                        <th>รหัส</th>
                        <th>วัตถุดิบ</th>
                        <th style="text-align:right;">จำนวนคงเหลือ</th>
                        <th style="text-align:right;">วันที่หมดอายุ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($listexpire as $rs):
                        $i++;
                        ?>
                        <tr onclick="action('<?php echo $rs['id'] ?>')" style="cursor: pointer;">
                            <td style=" text-align: center;"><?php echo $i ?></td>
                            <td><?php echo $rs['itemcode'] ?></td>
                            <td><?php echo $rs['itemname'] ?></td>
                            <td style=" text-align: right; color:red;">
                                <b><?php echo number_format($rs['totalcut']) ?> <?php echo $rs['unit'] ?></b>
                            </td>
                            <td style=" text-align: right;">
                                <?php echo $Config->thaidate($rs['expire']) ?>
                            </td>
                        </tr>
                        <?php
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
                <hr/>
                <button type="button" class="btn btn-default btn-block btn-lg" data-dismiss="modal">Close</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
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
                'excel', 'print'
            ]
        });
    }

    function action(id) {
        $("#_id").val(id);
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