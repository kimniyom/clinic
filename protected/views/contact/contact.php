<?php
$this->breadcrumbs = array(
    'ติดต่อเรา',
);
?>
<br/>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-phone-square"></i> ติดต่อเรา</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <h4>ข้อความถึงเรา</h4>
                <hr/>
                <?php if (Yii::app()->session['pid'] != '') { ?>
                    <div class="well">
                        <label>
                            ชื่อผู้ส่ง
                        </label>
                        <input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo $use['name'] ?>" readonly="readonly"/>
                        <label>
                            อีเมล์
                        </label>
                        <input type="text" name="user_email" id="user_email" class="form-control" value="<?php echo $use['email'] ?>" readonly="readonly"/>
                        <label>
                            ข้อความ
                        </label>
                        <textarea id="message" name="message" class="form-control"></textarea>
                        <hr/>
                        <center>
                            <button type="button" class="btn btn-default" onclick="send_massage()"><i class="fa fa-send-o"></i> ส่งข้อความ</button>
                            <br/>
                            <div id="msg_log" style="color: #339900; display: none;">
                                ระบบได้รับข้อความของท่านแล้ว <i class="fa fa-check"></i>
                            </div>
                        </center>
                    </div>
                <?php } else { ?>
                    <center>
                        กรุณาเข้าสู่ระบบก่อนค่ะ<br/><br/><br/>
                        <button type="button" id="btn-login" class="btn btn-default" onclick="login();">
                            <i class="fa fa-lock"></i> เข้าสู่ระบบ
                        </button>
                    </center>
                <?php } ?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style=" padding-left: 20px;">
                <h4>ติดต่อที่</h4>
                <hr/>
                <label>โซชียล</label><br/>
                <?php foreach ($social as $rs): ?>
                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/<?php echo $rs['icon'] ?>" width="36"/>
                    <?php if (substr($rs['account'], 0, 4) != 'http') { ?>
                        <?php echo $rs['social_app'] . ':' . $rs['account'] ?>
                    <?php } else { ?>
                        <a href="<?php echo $rs['account'] ?>" target="_blank">
                            <?php echo $rs['social_app'] ?>
                        </a>
                    <?php } ?>
                    <br/>
                <?php endforeach; ?>
                <br/>
                <label>อีเมล์ :</label> <?php echo $contact['email'] ?><br/>
                <label>โทรศัพท์ :</label> <?php echo $contact['tel'] ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function send_massage() {
        var url = "<?php echo Yii::app()->createUrl('frontend/contact/save_message') ?>";
        var pid = "<?php echo Yii::app()->session['pid'] ?>";
        var status = "<?php echo Yii::app()->session['status'] ?>";
        var message = $("#message").val();
        var data = {pid: pid, message: message, status: status};
        if (message == '') {
            $("#message").focus();
            return false;
        }

        $.post(url, data, function (success) {
            $("#message").val("");
            $("#msg_log").fadeIn(300).delay(3000).fadeOut(300);
            return false;
        });
    }
</script>