<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">น้ำหนัก</div>
                <input type="text" class="form-control" id="weight" value="<?php echo $result['weight'] ?>">
                <div class="input-group-addon">กก.</div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">ส่วนสูง</div>
                <input type="text" class="form-control" id="height" value="<?php echo $result['height'] ?>">
                <div class="input-group-addon">ซม.</div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">อุณหภูมิร่างกาย</div>
                <input type="text" class="form-control" id="btemp" value="<?php echo $result['btemp'] ?>">
                <div class="input-group-addon">&#176;C</div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">อัตราการเต้นชีพจร</div>
                <input type="text" class="form-control" id="pr" value="<?php echo $result['pr'] ?>">
                <div class="input-group-addon">/m</div>
            </div>
        </div>
    </div>
    
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">อัตราการหายใจ</div>
                <input type="text" class="form-control" id="rr" value="<?php echo $result['rr'] ?>">
                <div class="input-group-addon">/m</div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">ความดันโลหิต</div>
                <input type="text" class="form-control" id="ht" value="<?php echo $result['ht'] ?>">
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">รอบเอว</div>
                <input type="text" class="form-control" id="waistline"  value="<?php echo $result['waistline'] ?>">
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">วันที่ตรวจ</div>
                <input type="text" class="form-control" id="date_serv"  value="<?php echo $result['date_serv'] ?>" readonly="readonly">
            </div>
        </div>
    </div>
</div>
<label>อาการสำคัญ</label>
<textarea class="form-control" id="cc" rows="5"><?php echo $result['cc'] ?></textarea>
<hr/>
<button type="button" class="btn btn-success btn-block btn-lg" onclick="savebody()"><i class="fa fa-save"></i> แก้ไขข้อมูล</button>

<script type="text/javascript">
    function savebody() {
        var url = "<?php echo Yii::app()->createUrl('checkbody/saveupdate') ?>";
        var id = "<?php echo $result['id'] ?>";
        var patient_id = $("#patient_id").val();
        var weight = $("#weight").val();
        var height = $("#height").val();
        var btemp = $("#btemp").val();
        var pr = $("#pr").val();
        var rr = $("#rr").val();
        var ht = $("#ht").val();
        var waistline = $("#waistline").val();
        var cc = $("#cc").val();
        var data = {
            id: id,
            patient_id: patient_id,
            weight: weight,
            height: height,
            btemp: btemp,
            pr: pr,
            rr: rr,
            ht: ht,
            waistline: waistline,
            cc: cc
        };

        $.post(url, data, function (success) {
            window.location.reload();
        });
    }
</script>