<title id="title">รายชื่อลูกค้า </title>
<style type="text/css">
    #temployee thead tr th{
        white-space: nowrap;
    }
    #temployee tbody tr td{
        white-space: nowrap;
    }
</style>
<script type="text/javascript">
    Setscreen();
    $(document).ready(function () {
        $("#title").append("<?php echo $model['branchname'] ?>");
    });

    function Setscreen() {
        var boxsell = $(window).height();
        var w = window.innerWidth;
        var screenfull;
        if (w > 768) {
            screenfull = (boxsell - 353);
        } else {
            screenfull = false;
            $(".branchcolumn").hide();
            $(".telcolumn").hide();
            $(".salarycolumn").hide();
        }
        $("#temployee").dataTable({
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

<table class="table table-striped table-hover" id="temployee" style=" width: 100%;">
    <thead>
        <tr>
            <th>#</th>
            <th>Name - Lname</th>
            <th>Alias</th>
            <th class="telcolumn" style="text-align: center;">Tel</th>
            <th class="salarycolumn" style="text-align: center;">Salary</th>
            <th class="salarycolumn">สถานะ</th>
            <th class="branchcolumn">สาขา</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($employee as $rs): $i++;
            $branch_id = $rs['branch'];
            ?>
            <tr onclick="action('<?php echo $rs['id'] ?>')" style="cursor: pointer;">
                <td><?php echo $i ?></td>
                <td><?php echo $rs['name'] . ' ' . $rs['lname'] ?></td>
                <td><?php echo $rs['alias'] ?></td>
                <td class="telcolumn" style=" text-align: center;"><?php echo $rs['tel'] ?></td>
                <td class="salarycolumn" style=" text-align: center;"><?php echo number_format($rs['salary'], 2) ?></td>
                <td class="salarycolumn"><?php echo StatusUser::model()->find("id=:id",array(":id" => $rs['status_id']))['status'] ?></td>
                <td class="branchcolumn"><?php echo Branch::model()->find("id = '$branch_id' ")['branchname'] ?></td>
                
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
        <div class="row" style="margin-top:10px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button class="btn btn-default btn-block btn-lg" onclick="view()"><i class="fa fa-eye"></i> ดูข้อมูล</button>
            </div>
        </div>
        <div class="row" style="margin-top:10px;">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button class="btn btn-success btn-block btn-lg" onclick="job()"><i class="fa fa-save"></i> บันทึกการทำงาน</button>
            </div>
        </div>
        <hr/>
        <button type="button" class="btn btn-default btn-block btn-lg" data-dismiss="modal">Close</button>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
    function action(id){
        $("#_id").val(id);
        $("#action").modal();
    }

    function view(){
        var id = $("#_id").val();
        var url = "<?php echo Yii::app()->createUrl('employee/view') ?>" + "&id=" + id;
        window.location=url;
    }

    function job(){
        var id = $("#_id").val();
        var url = "<?php echo Yii::app()->createUrl('job/index') ?>" + "&employee=" + id;
        window.location=url;
    }
</script>