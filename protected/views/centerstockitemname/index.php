<style type="text/css">
.centerstockitemname table thead tr th{
    white-space: nowrap;
}
    
.centerstockitemname table tbody tr td{
    white-space: nowrap;
}
</style>
<?php
/* @var $this CenterStockunitController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    //'คลังสินค้า' => Yii::app()->createUrl('store/index'),
    'รายการวัตถุดิบ',
);
?>
<div class="centerstockitemname">
<div class="panel panel-default" style=" margin-bottom: 0px;">
    <div class="panel-heading" style=" background: none; padding-top: 10px; padding-bottom: 15px; padding-right: 5px;">
        รายการวัตถุดิบ
        <span style=" margin-top: 5px;" id="t-comment">*</i> <font style="color:red;">คลิกที่แถวเพื่อจัดการข้อมูล</font></span>
        <a href="<?php echo Yii::app()->createUrl('centerstockitemname/create') ?>" class=" pull-right" style=" margin-top: 0px;">
            <button class="btn btn-default btn-sm"><i class="fa fa-plus"></i> เพิ่มรายการวัตถุดิบ</button></a>
    </div>
    <div class="panel-body">
        <table class="table-bordered table-hover " id="tb-items" style=" width: 100%;">
            <thead>
                <tr>
                    <th style=" width: 5%; text-align: center;">#</th>
                    <th>รหัส</th>
                    <th>วัตถุดิบ</th>
                    <th style="text-align:right;">ราคา / หน่วย</th>
                    <th style="text-align:right;">หน่วยนับ</th>
                    <th style="text-align:right;">หน่วยตัดสต๊อก</th>
                    <th style="text-align:center;">แจ้งเตือนใกล้หมด</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($item as $rs): $i++;
                    ?>
                    <tr onclick="action('<?php echo $rs['id'] ?>')" style="cursor: pointer;">
                        <td style=" text-align: center;"><?php echo $i ?></td>
                        <td><?php echo $rs['itemcode'] ?></td>
                        <td><?php echo $rs['itemname'] ?></td>
                        <td style="text-align:right;"><?php echo number_format($rs['price']) ?></td>
                        <td style=" text-align: right;">
                            <?php
                            $unit = $rs['unit'];
                            echo CenterStockunit::model()->find("id = '$unit' ")['unit']
                            ?>
                        </td>
                        <td style=" text-align: right;">
                            <?php
                            $unitcut = $rs['unitcut'];
                            echo CenterStockunit::model()->find("id = '$unitcut' ")['unit']
                            ?>
                        </td>
                        <td style="text-align:center;">
                            <?php echo $rs['alert'] ?>
                        </div>
                    </tr>
                <?php endforeach; ?>
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
function edit(){
        var id = $("#_id").val();
        var url = "<?php echo Yii::app()->createUrl('centerstockitemname/update') ?>" + "&id=" + id;
        window.location=url;
    }

    function Delete() {
        var id = $("#_id").val();
        var r = confirm("Are you sure ..?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('centerstockitemname/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }
</script>

<script type="text/javascript">

    Setscreen();
    function Setscreen() {
        var boxsell = $(window).height();
        var w = window.innerWidth;
        var screenfull;
        if (w >= 786) {
            screenfull = (boxsell - 295);
            $("#t-comment").show();
        } else {
            screenfull = false;
            $("#t-comment").hide();
        }
        
        $("#tb-items").dataTable({
            //"sPaginationType": "full_numbers", // แสดงตัวแบ่งหน้า
            "bLengthChange": false, // แสดงจำนวน record ที่จะแสดงในตาราง
            //"iDisplayLength": 50, // กำหนดค่า default ของจำนวน record
            //"scrollCollapse": true,
            "paging": false,
            "bFilter": true, // แสดง search box
            "sScrollY": screenfull, // กำหนดความสูงของ ตาราง
            "sScrollX": true, // กำหนดความสูงของ ตาราง
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'print'
            ]
        });
    }

    function action(id){
        $("#_id").val(id);
        $("#action").modal();
    }

</script>
