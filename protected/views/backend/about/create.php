<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/assets/ckeditor/ckfinder/ckfinder.js"></script>

<?php
$title = "เกี่ยวกับเรา";
$this->breadcrumbs = array(
    $title,
);
?>

<script type="text/javascript">

    function save_about() {
        var url = "<?php echo Yii::app()->createUrl('backend/about/save') ?>";
        var about = CKEDITOR.instances.about.getData();
        
        if (about == '') {
            $("#f_error").show().delay(5000).fadeOut(500);
            return false;
        }
        var data = {
            about: about
        };
        
        $.post(url, data, function (success) {
            window.location = "<?php echo Yii::app()->createUrl('backend/about')?>";
            $("#f_success").show().delay(5000).fadeOut(500);
        });
    }
</script>
<div class="well" style="width:100%;">

    <form class="form-horizontal">
        <fieldset>
            <legend>
                <span class="label label-default" style="padding:10px;">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/Mail-icon.png" style="height:36px;"/>
                    เกี่ยวกับเรา
                </span>
            </legend>
            <div class="form-group">
                <div class="col-lg-12">
                    <label>รายละเอียด</label>
                    <textarea id="about" name="about" rows="5" class="form-control input-sm" required="required"><?php echo $about['about']?></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-12">
                    <button type="button" class="btn btn-success" onclick="save_about()">
                        <i class="fa fa-save"></i>
                        บันทึกข้อมูล
                    </button>
                    <font style=" color: #ff0033; display: none;" id="f_error">กรอกข้อมูลไม่ครบ ..?</font>
                    <font style=" color: green; display: none;" id="f_success">บันทึกข้อมูลแล้ว</font>
                    <!--
                    <button id="save_regis" name="save_regis" class="btn btn-success"
                            onclick="save_product();">
                        <span class="glyphicon glyphicon-save"></span> <b>บันทึกข้อมูล</b></button>
                    -->
                </div>
            </div>
        </fieldset>
    </form>

</div>

<script>
    //Modify By Kimniyom
    CKEDITOR.replace('about', {
        language: 'th',
        //uiColor: '#000000',
        toolbarGroups: [
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                //{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
                { name: 'links' },
                { name: 'insert' },
                //{ name: 'forms' },
                { name: 'tools' },
                //{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                //{ name: 'others' },
                '/',
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                { name: 'styles' },
                { name: 'colors' },
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
    });</script>

