<style type="text/css">
    #tuser thead tr th{
        white-space: nowrap;
    }
    #tuser tbody tr td{
        white-space: nowrap;
    }
</style>
<?php
$system = new Configweb_model();
$MasuserModel = new Masuser();
?>
<table class="table table-bordered table-hover table-striped" id="tuser" style=" width: 100%;">
    <thead>
        <tr>
            <th style=" text-align: center;">#</th>
            <th>Username</th>
            <th>Name - Lname</th>
            <th class="columns">Status</th>
            <th class="columns">CreateDate</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($user as $rs): $i++;
            $rss = $MasuserModel->GetDetailUser($rs['user_id']);
            ?>
            <tr onclick="action('<?php echo $rs['id'] ?>','<?php echo $rs['user_id'] ?>')" style=" cursor: pointer;">
                <td style=" text-align: center;"><?php echo $i ?></td>
                <td><?php echo $rs['username'] ?></td>
                <td>
                    <?php echo $rss['pername'] . '' . $rss['name'] . ' ' . $rss['lname']; ?>
                </td>
                <td class="columns"><?php echo $rs['statusname'] ?></td>
                <td class="columns"><?php echo $system->thaidate($rs['create_date']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Action -->
<div class="modal fade" tabindex="-1" role="dialog" id="action" style="margin-top:20%;">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <input type="hidden" id="_id">
                <input type="hidden" id="user_id">
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
                        <button class="btn btn-danger btn-block btn-lg" onclick="deletuser()"><i class="fa fa-trash"></i> ลบ</button>
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
        var w = window.innerWidth;
        var screenfull;
        if (w >= 768) {
            screenfull = (boxsell - 371);
        } else {
            screenfull = false;
            $(".columns").hide();
        }
        $("#tuser").dataTable({
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

    function action(id,user_id) {
        $("#_id").val(id);
        $("#user_id").val(user_id);
        $("#action").modal();
    }

    function view() {
        var id = $("#user_id").val();
        var url = "<?php echo Yii::app()->createUrl('employee/view') ?>" + "/id/" + id;
        window.location = url;
    }

    function edit() {
        var id = $("#_id").val();
        var user_id = $("#user_id").val();
        var url = "<?php echo Yii::app()->createUrl('masuser/update') ?>" + "/id/" + id + "/user_id/" + user_id;
        window.location = url;
    }

    function deletuser() {
        var id = $("#_id").val();
        if (id != "1") {
            var r = confirm("คุณแน่ใจหรือไม่ ...");
            if (r == true) {
                var url = "<?php echo Yii::app()->createUrl('masuser/delete') ?>";
                var data = {id: id};
                $.post(url, data, function (success) {
                    window.location.reload();
                });
            }
        } else {
            alert("ไม่สามารถลบ ผู้ใช้งานที่เป็น Admin ...");
            return false;
        }
    }
</script>