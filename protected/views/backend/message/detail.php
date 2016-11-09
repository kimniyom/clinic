<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.js"></script>
<script type="text/javascript">
    load_answer();
    function Answer_msg() {
        var url = "<?php echo Yii::app()->createUrl('backend/message/answer_msg') ?>";
        var msg = CKEDITOR.instances.msg.getData();
        var msg_id = "<?php echo $msg['id'] ?>";
        if (msg == '') {
            $("#f_error").show().delay(5000).fadeOut(500);
            return false;
        }
        var data = {
            message: msg,
            msg_id: msg_id
        };

        $.post(url, data, function (success) {
            //window.location = "<?//php echo Yii::app()->createUrl('backend/about') ?>";
            $("#f_success").show().delay(5000).fadeOut(500);
            load_answer();
            hide_box();
        });
    }

    function load_answer() {
        var url = "<?php echo Yii::app()->createUrl('backend/message/get_answer') ?>";
        var msg_id = "<?php echo $msg['id'] ?>";
        var data = {
            msg_id: msg_id
        };

        $.post(url, data, function (result) {
            //window.location = "<?//php echo Yii::app()->createUrl('backend/about') ?>";
            $("#answer").html(result);
        });
    }
</script>
<?php
$this->breadcrumbs = array(
    "กล่องข้อความ" => array('backend/message'),
    $msg['id']
);
if (!empty($msg['images'])) {
    $img = "uploads/profile/" . $msg['images'];
} else {
    $img = "images/User-null.png";
}
?>

<div class="panel panel-default">
    <div class="panel-heading">
        โดย : <i class="fa fa-user"></i> 
        <?php echo $msg['name'] . ' ' . $msg['lname'] ?>
        <div class="pull-right">เมื่อ : <i class="fa fa-calendar"></i> <?php echo $web->thaidate($msg['date_send']) ?></div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
                <img class="media-object img-responsive img-thumbnail" src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img ?>">
            </div>
            <div class="col-xs-10 col-sm-10 col-md-11 col-lg-11">
                <i class="fa fa-trash-o pull-right btn" title="ลบ" 
                   onclick="delete_msg('<?php echo $msg['id'] ?>')"></i>
                <h4 id="font-blue"><i class="fa fa-envelope-o"></i> <?php echo $msg['message'] ?></h4>
                <font id="font-glay"><i class="fa fa-mail-forward"></i> <?php echo $msg['ip'] ?></font>
            </div>
        </div>
        <hr/>
        <button type="button" class="btn btn-default" onclick="show_box()"><i class="fa fa-comment"></i> ตอบกลับ</button>
    </div>
    <div class="panel-footer">
        <div id="answer"></div>
    </div>
</div>

<div class="panel panel-default" id="box-send-msg" 
     style=" width:450px; height:auto; position:fixed; right: 5px; bottom: 0px; background: #FFF; border-radius:0px; display: none; margin-bottom: 0px;">
    <div class="panel-body">
        <textarea id="msg" name="msg" rows="2" class="form-control input-sm" required="required"></textarea>
    </div>
    <div class="panel-footer">
        <button type="button" class="btn btn-default" style="border-radius:0px;"
                onclick="Answer_msg()"><i class="fa fa-send"></i>ส่งข้อความ</button>
        <button type="button" class="btn btn-default" style="border-radius:0px;" onclick="hide_box()"><i class="fa fa-remove"></i></button>
        <font style="color:#ff3300; display: none;" id="f_error">กรุณากรอกข้อมูล</font>
        <font style="color:#006600; display: none;" id="f_success">ส่งข้อความสำเร็จ</font>
    </div>
</div>

<script>
    //Modify By Kimniyom
    CKEDITOR.replace('msg', {
        language: 'th',
        //uiColor: '#FFFFFF',
        toolbarGroups: [
            //{name: 'clipboard', groups: ['clipboard', 'undo']},
            //{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
            //{name: 'links'},
            {name: 'insert'},
            //{ name: 'forms' },
            {name: 'tools'},
            //{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
            //{ name: 'others' },
            '/',
            {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
            {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
            {name: 'styles'},
            {name: 'colors'},
            //{ name: 'about' }
        ],
        removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar',
        image_removeLinkByEmptyURL: true,
        filebrowserBrowseUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.html",
        filebrowserImageBrowseUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.html?Type=Images",
        filebrowserFlashBrowseUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.html?Type=Flash",
        filebrowserUploadUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
        filebrowserImageUploadUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
        filebrowserFlashUploadUrl: "<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"
    });

    function hide_box() {
        $("#box-send-msg").slideUp(500);
    }

    function show_box() {
        $("#box-send-msg").slideToggle("slow");
    }

    function delete_msg(id) {
        var r = confirm("คุณแน่ใจหรือไม่ ...");
        var url = "<?php echo Yii::app()->createUrl('backend/message/delete_msg') ?>";
        var data = {id: id};
        if (r == true) {
            $.post(url, data, function (success) {
                $("#flag_del").fadeIn();
                window.location = "<?php echo Yii::app()->createUrl('backend/message') ?>";
            });
        }
    }
</script>

