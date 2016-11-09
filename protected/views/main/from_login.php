

<script type="text/javascript">
    $(document).ready(function () {
        $("#login_btn").click(function () {
            $("#load").addClass("fa fa-spinner fa-pulse");
            if ($("#login_email").val() == "" || $("#login_password").val() == "") {
                $("#errorlog").hide();
                $("#error").fadeIn();
                return false;
            }

            var url = "<?php echo Yii::app()->createUrl('frontend/main/login/'); ?>";
            var data = {login_email: $("#login_email").val(), login_password: $("#login_password").val()};

            $.post(url, data,
                    function (success) {
                        if (success == 'nosuccess') {
                            $("#load").removeClass("fa fa-spinner fa-pulse");
                            $("#load").addClass("fa fa-check");
                            $("#error").hide();
                            $("#errorlog").fadeIn();
                        } else {
                            window.location = "<?php echo Yii::app()->createUrl('frontend/main') ?>";
                        }
                    }
            );//end post

        });

        // Cencel 

        $("#reset").click(function () {
            $("#load").removeClass("fa fa-spinner fa-pulse");
            $("#load").addClass("fa fa-check");
            $("#error").fadeOut();
            $("#errorlog").fadeOut();
            $("#login_email").val("");
            $("#login_password").val("");
        });

    });// end jquery
</script>
<center>
    <p id="font-rsu-22">กรอกข้อมูลสมาชิก</p>
</center>
<label>อีเมล์ *</label>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-user"></i></div>
        <input type="text" id="login_email" name="login_email" class="form-control" placeholder="EMAIL..."/>
    </div>
</div>

<label>รหัสผ่าน *</label>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-key"></i></div>
        <input type="password" id="login_password" name="login_password" class="form-control" placeholder="PASSWORD..."/>
    </div>
</div>

<center>
    <div type="button"id="login_btn"  class="btn btn-primary">
        <i class="fa fa-check" id="load"></i>
        เข้าสู่ระบบ
    </div>

    <div type="button" id="reset"  class="btn btn-danger">
        <i class="fa fa-remove"></i>
        ยกเลิก
    </div>
</center>



