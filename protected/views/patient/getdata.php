<style type="text/css">
    #box-patient table thead tr th{
        white-space: nowrap;
    }
    #box-patient table tbody tr td{
        white-space: nowrap;
    }
</style>
<?php
$system = new Configweb_model();
$branchModel = new Branch();
$typeModel = new Gradcustomer();
?>
<div id="box-patient">
    <table class="table table-striped table-hover" id="patient" style=" width: 100%;">
        <thead>
            <tr>
                <th>#</th>
                <th class="pid">Pid</th>
                <th>Card</th>
                <th>Name - Lname</th>
                <th class="branch">สาขา</th>
                <th class="type">ประเภท</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($patient as $rs): $i++;
                ?>
                <tr onclick="action('<?php echo $rs['id'] ?>')" style=" cursor: pointer;">
                    <td><?php echo $i ?></td>
                    <td class="pid"><?php echo $rs['pid'] ?></td>
                    <td><?php echo $rs['card'] ?></td>
                    <td><?php echo $rs['name'] . ' ' . $rs['lname'] ?></td>
                    <td class="branch">
                        <?php
                        $branchId = $rs['branch'];
                        echo $branchModel->find("id = '$branchId'")['branchname'];
                        ?>
                    </td>
                    <td class="type">
                        <?php
                        $typeId = $rs['type'];
                        echo $typeModel->find("id = '$typeId'")['grad'];
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Action -->
<div class="modal fade" tabindex="-1" role="dialog" id="action" style="margin-top:20%;">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <input type="hidden" id="_id">
                <div class="row" id="outstock">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button class="btn btn-default btn-block btn-lg" onclick="view()"><i class="fa fa-eye"></i> ดูข้อมูล</button>
                    </div>
                </div>
                <div class="row" style="margin-top:10px;" id="editupdate">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <button class="btn btn-default btn-block btn-lg" onclick="edit()"><i class="fa fa-pencil"></i> แก้ไข</button>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <button class="btn btn-danger btn-block btn-lg" onclick="deletepatient()"><i class="fa fa-trash"></i> ลบ</button>
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
        var w = window.innerWidth;
        var screenfull;
        if (w > 768) {
            //var contentboxsell = $("#content-boxsell").height();
            screenfull = (boxsell - 345);
        } else {
            screenfull = false;
            $(".pid").hide();
            $(".branch").hide();
            $(".type").hide();
        }
        
        $("#patient").dataTable({
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

    function action(id) {
        $("#_id").val(id);
        $("#action").modal();
    }

    function view() {
        var id = $("#_id").val();
        var url = "<?php echo Yii::app()->createUrl('patient/view') ?>" + "/id/" + id;
        window.location = url;
    }

    function edit() {
        var id = $("#_id").val();
        var url = "<?php echo Yii::app()->createUrl('patient/update') ?>" + "/id/" + id;
        window.location = url;
    }

    function deletepatient() {
        var id = $("#_id").val();
        var r = confirm("คุณแน่ใจหรือไม่ ...");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('patient/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }
</script>

