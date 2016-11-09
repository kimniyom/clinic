
<?php
$this->breadcrumbs = array(
    "แจ้งหมายเลขพัสดุ"
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <font id="font-rsu-18" style="color: #ff3300">
        <img src="<?php echo Yii::app()->baseUrl; ?>/images/transport-icon.png"/>
        แจ้งหมายเลขพัสดุ</font>
    </div>
    <div class="panel-body">
        <table width="100%" class="table table-bordered">
            <thead>
                <tr>
                    <td>#</td>
                    <td style="text-align:center;">รายละเอียด</td>
                    <td>รหัสสั่งซื้อ</td>
                    <td>ชื่อ-นามสกุล</td>
                    <td style="text-align: center;;">แจ้งเลขพัสดุ</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($order as $rs):
                    ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td style="text-align: center;">
                            <button class="btn btn-info btn-sm" 
                            onclick="view_order('<?php echo $rs['order_id']?>')">
                            <i class="fa fa-eye"></i>
                        </button>
                        </td>
                        <td><?= $rs['order_id']; ?></td>
                        <td><?= $rs['name'].' '.$rs['lname']; ?></td>
                        <td style="text-align: center;">
                            <button class="btn btn-danger btn-sm"
                            onclick="notification('<?php echo $rs['order_id']?>')">แจ้งเลขพัสดุ</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- POPUP -->
<div class="modal fade" id="popup_view_order">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">ตรวจสอบรายการแจ้งชำระ</h4>
      </div>
      <div class="modal-body" id="view_order"></div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- POPUP save notification -->
<div class="modal fade bs-example-modal-sm" id="popup_notification">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">แจ้งเลขพัสดุ</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="inputEmail3">รหัสสั่งซื้อ</label>
              <input type="text" class="form-control input-sm" id="order_id" readonly="readonly">
          </div>
          <div class="form-group">
            <label for="inputPassword3">เลขพัสดุ</label>
              <input type="text" class="form-control input-sm" id="post" placeholder="เลขพัสดุ">
          </div>
      </div>
      <div class="modal-footer" style="text-align:center;">
            <button type="button" class="btn btn-default" onclick="order_success();"><i class="fa fa-save"></i> ตกลง</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
    function view_order(order_id){
        $("#view_order").html("<br/><center><i class=\"fa fa-refresh fa-spin fa-2x\"></i></center>");
        var url = "<?php echo Yii::app()->createUrl('backend/orders/view_order')?>";
        var data = {order_id: order_id};

        $.post(url,data,function(result){
            $("#popup_view_order").modal();
            $("#view_order").html(result);
        });
    }
</script>

<script type="text/javascript">
    function notification(order_id){
        $("#post").val('');
        $("#order_id").val(order_id);
        $("#popup_notification").modal();
    }
</script>

<script type="text/javascript">
    function order_success(){
        var url = "<?php echo Yii::app()->createUrl('backend/orders/order_success')?>";
        var order_id = $("#order_id").val();
        var post = $("#post").val();
        var data = {order_id: order_id,post: post};

        if(post == ''){
            $("#post").focus();
            return false;
        }

        $.post(url,data,function(result){
            window.location.reload();
        });
    }
</script>

