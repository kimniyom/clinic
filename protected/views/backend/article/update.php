<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#file_upload').uploadify({
            'buttonText': 'เลือกไฟล์ ...',
            'swf ': '<?php echo Yii::app()->baseUrl; ?>/assets/uploadify/uploadify.swf',
            'uploader': '<?php echo Yii::app()->createUrl('backend/article/upload', array('id' => $rs['id'])) ?>',
            'auto': false,
            'fileSizeLimit': '1024KB',
            'fileTypeExts': ' *.jpg; *.png',
            'uploadLimit': 1,
            'onSelect': function (file) {
                $("#images").val(file.name);
                //alert('The file ' + file.name + ' was added to the queue.');
            },
            'onCancel': function (file) {
                $("#images").val("");
            }
        });
    });


    function check_form() {
        var url = "<?php echo Yii::app()->createUrl('backend/article/save_update') ?>";
        var id = "<?php echo $rs['id'] ?>";
        var title = $("#title").val();
        var msg = CKEDITOR.instances.msg.getData();
        var data = {
            id: id,
            title: title,
            msg: msg
        };
        if (title == '' || msg == '') {
            $("#f_error").show().delay(5000).fadeOut(500);
            return false();
        }

        $.post(url, data, function (success) {
            $('#file_upload').uploadify('upload', '*');
            window.location = "<?php echo Yii::app()->createUrl('backend/article/view/id/') ?>" + "/" + id;
        });
    }
</script>
<?php
$this->breadcrumbs = array(
    "บทความ" => array('backend/article'),
    $rs['title']
        )
?>

<div class="panel panel-default">
    <div class="panel-body">
        <label>เรื่อง</label>
        <input type="text" id="title" name="title" class="form-control" value="<?php echo $rs['title']?>"/>
        <label>รายละเอียด</label>
        <textarea id="msg" name="msg" rows="5" class="form-control input-sm" required="required"><?php echo $rs['detail']?></textarea>
        <label>ภาพหน้าปก</label><br/>
        <img src="<?php echo Yii::app()->baseUrl;?>/uploads/article/<?php echo $rs['images']?>" style=" max-width: 80px;"/><br/><br/>
        <input type="hidden" id="images" name="images" />
        <input type="file" name="file_upload" id="file_upload" />
        (ไฟล์นามสกุล jpg,png ไม่เกิน 1MB)
    </div>
    <div class="panel-footer">
        <button type="button" class="btn btn-default" style="border-radius:0px;"
                onclick="check_form()"><i class="fa fa-save"></i> บันทึกข้อมูล</button>

        <font style="color:#ff3300; display: none;" id="f_error">กรุณากรอกข้อมูล</font>
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

</script>

