<script src="<?= Yii::app()->baseUrl ?>/assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl ?>/assets/uploadify/uploadify.css">
<script type="text/javascript">
    $(document).ready(function () {
        $('#Filedata').uploadify({
            'buttonText': 'กรุณาเลือกรูปภาพ ...',
            'auto': true, //เปิดใช้การอัพโหลดแบบอัติโนมัติ
            'swf': '<?= Yii::app()->baseUrl ?>/assets/uploadify/uploadify.swf', //โฟเดอร์ที่เก็บไฟล์ปุ่มอัพโหลด
            'uploader': "<?= Yii::app()->createUrl('backend/logo/saveupload', array("branch" => $branch)) ?>",
            'fileSizeLimit': '1MB', //อัพโหลดได้ครั้งละไม่เกิน 1024kb
            /*
             'width': '350',
             'height': '40',
             */
            'fileTypeExts': '*.jpg; *.png', //กำหนดชนิดของไฟล์ที่สามารถอัพโหลดได้
            'multi': true, //เปิดใช้งานการอัพโหลดแบบหลายไฟล์ในครั้งเดียว
            'queueSizeLimit': 1, //อัพโหลดได้ครั้งละ 5 ไฟล์
            'onUploadSuccess': function (file, data, response) {
                //alert(data);
                window.location.reload();
            }
        });
    });
</script>

<?php
$branchModel = Branch::model()->find("id = '$branch'");
$this->breadcrumbs = array(
    'ข้อมูลสาขา' => Yii::app()->createUrl('branch/index'),
    "LOGO",
    $branchModel['branchname']
);
?>

<div class="well well-sm">
    <h4 style=" font-size: 20px; color: #ff0000;">
        <i class="fa fa-smile-o"></i> จัดการโลโก้ร้าน สาขา <?php echo $branchModel['branchname'] ?>
    </h4>
</div>

<div class="panel panel-default">
    <div class="panel-heading">อัพโหลดรูปภาพ</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="upload">
                    <ul style=" font-size: 16px; color: #ff3300;">
                        <li>อัพโหลดได้เฉพาะ .jpg , .png</li>
                        <li>อัพโหลดได้ไม่เกินครั้งละ 1MB</li>
                        <li>อัพโหลดได้ไม่เกินครั้งละ 1 ไฟล์</li>
                    </ul>
                    <form>
                        <div id="queue"></div>
                        <div style="width:350px; float:left;">
                            <input id="Filedata" name="Filedata" type="file" multiple="true">
                        </div>
                        <div style="width:300px; float:left;">
                            <!--
                            <a href="javascript:$('#Filedata').uploadify('upload')" style="float:left; cursor:pointer;">
                                <input type="button" class="btn btn-success" value="อัพโหลดรูปภาพ"/>
                            </a>
                            -->
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-lg-6" style=" text-align: center; padding-top: 30px;">
                <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $logo['logo']; ?>" class="img-resize" style="max-width:50px;"/>
            </div>
        </div>
    </div>
</div>

<?php
if (empty($logo)) {
    echo "<div class='well'><center>ไม่มีข้อมูล</center></div>";
}
?>
</div>

<script type="text/javascript">

    function delete_logo(id) {
        var r = confirm("คุณแน่ใจหรือไม่ ...");
        var url = "<?php echo Yii::app()->createUrl('backend/logo/delete') ?>";
        var data = {id: id};
        if (r == true) {
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }
</script>
