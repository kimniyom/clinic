<script type="text/javascript">
    $(document).ready(function () {
        //loadimages();
        $('#Filedata').uploadify({
            /*'buttonText': 'กรุณาเลือกรูปภาพ ...',*/
            'auto': true, //เปิดใช้การอัพโหลดแบบอัติโนมัติ
            //'buttonImage': '<?//= Yii::app()->baseUrl ?>/images/image-up-icon.png',
            'swf': '<?= Yii::app()->baseUrl ?>/assets/uploadify/uploadify.swf', //โฟเดอร์ที่เก็บไฟล์ปุ่มอัพโหลด
            'uploader': "<?= Yii::app()->createUrl('service/uploadify', array("seq" => $seq)) ?>",
            'fileSizeLimit': '1MB', //อัพโหลดได้ครั้งละไม่เกิน 1024kb
            'width': '220',
            //'height': '132',
            'fileTypeExts': '*.jpg; *jpeg; *JPG; *JPEG', //กำหนดชนิดของไฟล์ที่สามารถอัพโหลดได้
            'multi': true, //เปิดใช้งานการอัพโหลดแบบหลายไฟล์ในครั้งเดียว
            'queueSizeLimit': 5, //อัพโหลดได้ครั้งละ 5 ไฟล์
            'onUploadSuccess': function (file, data, response) {
                loadimages();
            }
        });
    });
</script>

<?php
$branch = Yii::app()->session['branch'];
$branchList = Branch::model()->findAll("active = '1'");
if ($branch == "99") {
    $active = "";
    $disabled = "";
} else {
    $active = $branch;
    $disabled = "disabled='disabled'";
}
?>

<input type="hidden" id="seq" value="<?php echo $seq ?>"/>
<input type="hidden" id="id" value="<?php echo $model['id'] ?>"/>
<div class="panel panel-primary" style=" border-top: none; border: none;">
    <div class="panel-heading"  style=" border-top: none; border-radius: 0px;">
        <i class="fa fa-save"></i> บันทึกผลการตรวจ
        <button type="button" class="btn btn-success btn-xs pull-right" style=" margin: 0px;" onclick="Saveservice()">
            <i class="fa fa-save"></i> บันทึกข้อมูล
        </button>
    </div>
    <div class="panel-body">
        <div class="col-md-12 col-md-8 col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <label>รายการรักษา</label>
                    <font style=" font-size: 12px; color: #ff0303;">*ห้ามเป็นค่าว่าง</font>
                    <textarea id="service_result" rows="5" class=" form-control"><?php echo $model['service_result']?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-4">
                    <label>ราคา</label>
                    <input type="text" id="price_total" class="form-control" value="<?php echo $model['price_total']?>"/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label>comment</label>
                    <textarea id="comment" rows="3" class=" form-control"><?php echo $model['comment']?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <label>สาขา</label>
                    <select id="branch" class="form-control">
                        <?php foreach ($branchList as $b): ?>
                            <option value="<?php echo $b['id'] ?>" <?php
                            if ($b['id'] == $active) {
                                echo "selected";
                            }
                            ?> <?php echo $disabled; ?>><?php echo $b['branchname'] ?></option>
                                <?php endforeach; ?>
                    </select>
                </div>
       
        </div>
    </div>
    <div class="col-md-12 col-md-4 col-lg-4" style=" background: #f6f6f6; border-radius: 5px;">
        <div class="row" style=" padding: 10px;">
            <label><i class="fa fa-image"></i> รูปภาพ</label>
            <div class="upload">
                <form>
                    <input id="Filedata" name="Filedata" type="file" multiple="true">
                    <p style=" font-size: 12px; color: #ff0303;">อัพโหลดได้เฉพาะ jpg .jpeg,อัพโหลดได้ไม่เกินครั้งละ 2MB</p>
                </form>
            </div>

            <div id="showimages"></div>
        </div>
    </div>

</div>
</div>

<script type="text/javascript">
    loadimages();
    function loadimages() {
        var url = "<?php echo Yii::app()->createUrl('service/loadimages') ?>";
        var seq = $("#seq").val();
        var data = {seq: seq};
        $.post(url, data, function (result) {
            $("#showimages").html(result);
        });
    }

    function Saveservice() {
        var url = "<?php echo Yii::app()->createUrl('service/saveservice') ?>";
        var seq = $("#seq").val();
        var patient_id = $("#patient_id").val();
        var diagcode = $("#diagcode").val();
        var price_total = $("#price_total").val();
        var service_result = $("#service_result").val();
        var comment = $("#comment").val();
        var branch = $("#branch").val();
        var id = $("#id").val();
        if (service_result == "") {
            $("#service_result").focus();
            return false;
        }

        var data = {
            id: id,
            seq: seq,
            patient_id: patient_id,
            diagcode: diagcode,
            price_total: price_total,
            service_result: service_result,
            comment: comment,
            branch: branch
        };

        $.post(url, data, function (success) {
            swal("Success", "บันทึกข้อมูลการให้บริการสำเร็จ...", "success");
            GetformServece();
        });
    }
</script>