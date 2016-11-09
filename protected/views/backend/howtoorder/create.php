<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.js"></script>
<script type="text/javascript">
    function check_form() {
        var url = "<?php echo Yii::app()->createUrl('backend/howtoorder/save') ?>";
        var howto = CKEDITOR.instances.howto.getData();
        var data = {
            howto: howto
        };
        if (howto == '') {
            $("#f_error").show().delay(5000).fadeOut(500);
            return false();
        }

        $.post(url, data, function (success) {
            window.location="<?php echo Yii::app()->createUrl('backend/howtoorder')?>";
        });
    }
</script>
<?php
$this->breadcrumbs = array(
    "วิธีการสั่งซื้อ"
        )
?>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="pull-right">
            <a href="<?php echo Yii::app()->createUrl('backend/howtoorder')?>" title="view"><i class="fa fa-eye"></i></a>
        </div>
        <label>วิธีการสั่งซื้อ</label>
        <textarea id="howto" name="howto" rows="5" class="form-control input-sm" required="required"><?php echo $howtoorder; ?></textarea>
    </div>
    <div class="panel-footer">
        <button type="button" class="btn btn-default" style="border-radius:0px;"
                onclick="check_form()"><i class="fa fa-save"></i> บันทึกข้อมูล</button>

        <font style="color:#ff3300; display: none;" id="f_error">กรุณากรอกข้อมูล</font>
    </div>
</div>

<script>
    //Modify By Kimniyom
    CKEDITOR.replace('howto', {
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

