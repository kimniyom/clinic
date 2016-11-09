<?php
$title = "ช่องทางการขนส่ง";
$this->breadcrumbs = array(
    $title,
);
?>
<div class="panel panel-default" style="border-top:none; border-radius:0px;">
  <div class="panel-heading">
      <img src="<?php echo Yii::app()->baseUrl; ?>/images/transport-icon.png" style="height:36px;"/>
      ช่องทางการขนส่ง
      <div class="pull-right">
          <font style=" color: #ff0033; display: none;" id="f_error">กรอกข้อมูลไม่ครบ ..?</font>
          <font style=" color: green; display: none;" id="f_success">บันทึกข้อมูลแล้ว</font>
          <button type="button" class="btn btn-success btn-sm" onclick="save_transport()">
              <i class="fa fa-save"></i>
              บันทึกข้อมูล
          </button>
      </div>
  </div>
  <div class="panel-body">
    <div class="form-group">
        <div class="col-lg-12">
            <label>ราคาค่าขนส่ง</label>
            <input type="text" id="price" name="price" class="form-control" onkeypress="return chkNumber();"/>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-12">
            <label>รายละเอียด</label>
            <textarea id="detail" name="detail" rows="5" class="form-control input-sm" required="required"></textarea>
        </div>
    </div>
    <hr/>
  </div>
</div>

<div id="load_data_transport"></div>

<script type="text/javascript">
  load_data_transport();
  function load_data_transport(){
    var load = "<center><i class=\"fa fa-spinner fa-spin\"></i></center>";
    $("#load_data_transport").html(load);
    var url = "<?php echo Yii::app()->createUrl('backend/transport/load_data') ?>";
    var data = {a:1};
    $.post(url,data,function(success){
      $("#load_data_transport").html(success);
    });
  }

  function save_transport(){
    var url = "<?php echo Yii::app()->createUrl('backend/transport/save_transport') ?>";
    var price = $("#price").val();
    var detail = $("#detail").val();
    var data = {price: price,detail: detail};
    if(price == '' || detail == ''){
      $("#f_error").show().delay(5000).fadeOut(500);
      return false;
    }

    $.post(url,data,function(success){
      $("#f_success").show().delay(5000).fadeOut(500);
      $("#price").val('');
      $("#detail").val('');
      load_data_transport();
    });
  }

  function delete_transport(id){
    var r = confirm("คุณแน่ใจหรือไม่ ...?");
    var url = "<?php echo Yii::app()->createUrl('backend/transport/delete_transport') ?>";
    var data = {id: id};
    if(r == true){
      $.post(url,data,function(success){
        load_data_transport();
      });
    }
  }
</script>
