<?php
    $title = "ข้อมูลติดต่อ";
    $this->breadcrumbs = array($title,);
?>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">
            <i class="fa fa-phone"></i> ข้อมูลติดต่อ</a></li>
    <li role="presentation">
        <a href="#social" aria-controls="social" role="tab" data-toggle="tab">
            <i class="fa fa-facebook"></i> โซเชียลมีเดีย</a></li>
    <li role="presentation"><a href="<?php echo Yii::app()->createUrl('backend/contact')?>"><i class="fa fa-eye"></i> view</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="contact">
        <div class="panel panel-default" style="border-top:none; border-radius:0px;">
            <div class="panel-heading">
                <i class="fa fa-phone"></i> ข้อมูลติดต่อ
                <div class="pull-right">
                  <font style=" color: #ff0033; display: none;" id="f_email_error">อีเมล์ไม่ถูกต้อง ..?</font>
                  <font style=" color: #ff0033; display: none;" id="f_error">กรอกข้อมูลไม่ครบ ..?</font>
                  <font style=" color: green; display: none;" id="f_success">บันทึกข้อมูลแล้ว</font>
                  <button class="btn btn-link" onclick="save_contact();" style="padding-top:0px;">
                    <i class="fa fa-save"></i> บันทึกข้อมูลส่วนนี้
                  </button>
                </div>
            </div>
            <div class="panel-body">
              <div class="col-lg-12">
                  <label>อีเมล์</label>
                  <input type="text" id="c_email" class="form-control" value="<?php echo $contact['email']?>"/>
                  <label>เบอร์โทรศัพท์</label>
                  <input type="text" id="c_tel" class="form-control" value="<?php echo $contact['tel']?>">
              </div>
          </div>
        </div>
    </div>

    <!-- content Tab 2-->
    <div role="tabpanel" class="tab-pane" id="social">
        <div role="tabpanel" class="tab-pane active" id="contact">
            <div class="panel panel-default" style="border-top:none; border-radius:0px;">
                    <div class="panel-heading">
                        <i class="fa fa-facebook"></i> โซเชียลมีเดีย
                        <div class="pull-right">
                            <font style=" color: #ff0033; display: none;" id="s_error">กรอกข้อมูลไม่ครบ ..?</font>
                            <font style=" color: green; display: none;" id="s_success">บันทึกข้อมูลแล้ว</font>
                            <button class="btn btn-link" onclick="save_social();" style="padding-top:0px;">
                              <i class="fa fa-save"></i> บันทึกข้อมูลส่วนนี้
                            </button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <label>Social media</label>
                            </div>
                            <div class="col-lg-8">
                                <label>ID Account</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="dropdown">
                                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width:100%;">
                                    <span id="icon">
                                      <img src="<?php echo Yii::app()->baseUrl;?>/images/Social-network-icon.png" width="24"/>
                                      เลือกแอพพลิเคชั่น
                                    </span>
                                    <span class="caret"></span>
                                  </button>
                                  <input type="hidden" class="form-control" id="social_id"/>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <?php foreach($massocial as $rs):?>
                                    <li>
                                        <a href="javascript:set_social('<?php echo $rs['id']?>','<?php echo $rs['social_app']?>','<?php echo $rs['icon']?>')">
                                            <img src="<?php echo Yii::app()->baseUrl;?>/images/<?php echo $rs['icon']?>" width="24"/>
                                            <?php echo $rs['social_app']?>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                  </ul>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <input type="text" id="account" class="form-control">
                            </div>
                        </div>
                        <br/>
                        <div id="show_data_social"></div>
                    </div>

                </div><!-- end panel -->
        </div>
    </div><!-- End Tab 2 -->
</div>

<script type="text/javascript">
    function IsEmail(email) {
      var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if(!regex.test(email)) {
          return false;
      } else {
          return true;
      }
    }

    function save_contact() {
        var url = "<?php echo Yii::app()->createUrl('backend/contact/save') ?>";
        var checkemail = $("#c_email").val();
        var email;
        var tel = $("#c_tel").val();

        if(IsEmail(checkemail) == false || checkemail == ''){
          $("#f_email_error").show().delay(5000).fadeOut(500);
          return false;
        }else{
          email = checkemail;
        }

        if (tel == '') {
            $("#f_error").show().delay(5000).fadeOut(500);
            return false;
        }
        var data = {
            email: email,
            tel: tel
        };

        $.post(url, data, function (success) {
            //window.location = "<?//php echo Yii::app()->createUrl('backend/contact/view')?>";
            $("#f_success").show().delay(5000).fadeOut(500);
        });
    }
</script>

<script type="text/javascript">
    load_data_social();
    function set_social(id,app,icon){
        var img = "<img src='<?php echo Yii::app()->baseUrl;?>/images/" + icon + "' width='24'/> " + app;
        $("#social_id").val(id);
        $("#icon").html(img);
    }

    function save_social(){
      var url = "<?php echo Yii::app()->createUrl('backend/contact/save_social') ?>";
      var social_id = $("#social_id").val();
      var account = $("#account").val();
      var data = {social_id: social_id,account: account};
      if(social_id == '' || account == ''){
        $("#s_error").show().delay(5000).fadeOut(500);
        $("#account").focus();
        return false;
      }

      $.post(url,data,function(success){
        $("#s_success").show().delay(5000).fadeOut(500);
        $("#social_id").val('');
        $("#account").val('');
        $("#icon").text("เลือกแอพพลิเคชั่น");
        load_data_social();
      });
    }

    function load_data_social(){
      var load = "<center><i class=\"fa fa-spinner fa-spin\"></i></center>";
      $("#show_data_social").html(load);
      var url = "<?php echo Yii::app()->createUrl('backend/contact/get_data_social') ?>";
      var data = {a:1};
      $.post(url,data,function(success){
        $("#show_data_social").html(success);
      });
    }

    function delete_social(id){
      var r = confirm("คุณแน่ใจหรือไม่...?");
      var url = "<?php echo Yii::app()->createUrl('backend/contact/delete_social') ?>";
      var data = {id: id};
      if(r == true){
        $.post(url,data,function(success){
          load_data_social();
        });
      }
    }
</script>
