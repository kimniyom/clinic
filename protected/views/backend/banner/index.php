<script src="<?= Yii::app()->baseUrl ?>/assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl ?>/assets/uploadify/uploadify.css">
<script type="text/javascript">
    $(document).ready(function () {
        $('#Filedata').uploadify({
            'buttonText': 'กรุณาเลือกรูปภาพ ...',
            'auto': true, //เปิดใช้การอัพโหลดแบบอัติโนมัติ
            'swf': '<?= Yii::app()->baseUrl ?>/assets/uploadify/uploadify.swf', //โฟเดอร์ที่เก็บไฟล์ปุ่มอัพโหลด
            'uploader': "<?= Yii::app()->createUrl('backend/banner/saveupload') ?>",
            'fileSizeLimit': '2MB', //อัพโหลดได้ครั้งละไม่เกิน 1024kb
            'width': '350',
            'height': '40',
            'fileTypeExts': '*.jpg; *.png', //กำหนดชนิดของไฟล์ที่สามารถอัพโหลดได้
            'multi': true, //เปิดใช้งานการอัพโหลดแบบหลายไฟล์ในครั้งเดียว
            'queueSizeLimit': 1, //อัพโหลดได้ครั้งละ 5 ไฟล์
            'onUploadSuccess': function (file, data, response) {
                window.location.reload();
            }
        });
    });
</script>

<?php
$this->breadcrumbs = array(
    "BANNER"
);
?>

<div class="well well-sm">
    <h4 style=" font-size: 20px; color: #ff0000;">
        <i class="fa fa-image"></i> จัดการรูปภาพ Banner
    </h4>
</div>

<div class="panel panel-default">
    <div class="panel-heading">อัพโหลดรูปภาพ</div>
    <div class="panel-body">
        <div class="upload">
            <ul style=" font-size: 16px; color: #ff3300;">
                <li>อัพโหลดได้เฉพาะ .jpg , .png</li>
                <li>อัพโหลดได้ไม่เกินครั้งละ 2MB</li>
                <li>อัพโหลดได้ไม่เกินครั้งละ 1 ไฟล์</li>
                <li>รูปภาพจะแสดงผลได้ดีที่ขนาด 1000 x 300 พิกเซล</li>
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
</div>

<div class="panel panel-default">
    <div class="panel-heading">BANNER</div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>BANNER</th>
                <th style="text-align:center;">STATUS</th>
                <th style="text-align:center;">DELETE</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=0;foreach($banner as $rs): $i++;?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <img src="<?php echo Yii::app()->baseUrl;?>/uploads/banner/<?php echo $rs['banner_images']; ?>" class="img-resize" style="max-width:200px;"/>
                </td>
                <td style="text-align:center;">
                  <center>
                        <?php if($rs['status'] == '1'){ ?>
                            <input id="status" name="status" class="styled" type="checkbox" checked="checked"  onclick="set_active('<?php echo $rs['banner_id'] ?>','0');">
                        <?php } else {?>
                            <input id="status" name="status" class="styled" type="checkbox" onclick="set_active('<?php echo $rs['banner_id'] ?>','1');">
                        <?php } ?>
                  </center>
                </td>
                <td style="text-align:center;">
                    <button type="button" class="btn btn-danger btn-sm" onclick="delete_banner('<?php echo $rs['banner_id']?>')"><i class="fa fa-trash"></i> delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    function set_active(id,status){
        var url = "<?php echo Yii::app()->createUrl('backend/banner/set_active')?>";
        var data = {banner_id: id,status: status};
        $.post(url,data,function(success){

        });
    }

    function delete_banner(id){
        var r = confirm("คุณแน่ใจหรือไม่ ...");
        var url = "<?php echo Yii::app()->createUrl('backend/banner/delete')?>";
        var data = {banner_id: id};
        if(r == true){
            $.post(url,data,function(success){
                window.location.reload();
            });
        }
    }
</script>
