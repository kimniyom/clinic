<script>
    $(document).ready(function () {
        chang_address("ampur", '<?php echo $address['changwat'] ?>', '<?php echo $address['ampur'] ?>');
        chang_address("tambon", '<?php echo $address['ampur'] ?>', '<?php echo $address['tambon'] ?>');
    });

</script>

<div class="form-group">
    <div class="row">
        <div class="col-sm-3 col-lg-3">
            ชื่อ *
        </div>
        <div class="col-lg-9">
            <input type="text" id="name" name="name" class="form-control input-sm" value="<?php echo $address['name'] ?>"/>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-lg-3">
            นามสกุล *
        </div>
        <div class="col-lg-9">
            <input type="text" id="lname" name="lname" class="form-control input-sm" value="<?php echo $address['lname'] ?>"/>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-lg-3">
            เลขที่ *
        </div>
        <div class="col-lg-9">
            <input type="text" id="number" name="number" class="form-control input-sm" value="<?php echo $address['number'] ?>"/>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-lg-3">
            อาคาร
        </div>
        <div class="col-lg-9">
            <input type="text" id="building" name="building" class="form-control input-sm" value="<?php echo $address['building'] ?>"/>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-lg-3">
            ชั้น
        </div>
        <div class="col-lg-9">
            <input type="text" id="class" name="class" class="form-control input-sm" value="<?php echo $address['class'] ?>"/>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-lg-3">
            ห้อง
        </div>
        <div class="col-lg-9">
            <input type="text" id="room" name="room" class="form-control input-sm" value="<?php echo $address['room'] ?>"/>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-lg-3">
            จังหวัด *
        </div>
        <div class="col-lg-9">
            <select id="changwat" name="changwat" class="form-control input-sm" onchange="chang_address('ampur', this.value, '')">
                <option value="">เลือกจังหวัด</option>
                <?php foreach ($changwat as $ch): ?>
                    <option value="<?php echo $ch['changwat_id'] ?>"
                    <?php
                    if ($address['changwat'] == $ch['changwat_id']) {
                        echo "selected";
                    }
                    ?>><?php echo $ch['changwat_name'] ?></option>
                        <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-lg-3">
            อำเภอ *
        </div>
        <div class="col-lg-9">
            <select id="ampur" name="ampur" class="form-control input-sm" onchange="chang_address('tambon', this.value, '')">
                <option value="">เลือกอำเภอ</option>
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-lg-3">
            ตำบล *
        </div>
        <div class="col-lg-9">
            <select id="tambon" name="tambon" class="form-control input-sm">
                <option value="">เลือกตำบล</option>
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-lg-3">
            รหัสไปรษณีย์ *
        </div>
        <div class="col-lg-9">
            <input type="text" id="zipcode" name="zipcode" class="form-control input-sm" maxlength="5" value="<?php echo $address['zipcode'] ?>"/>
        </div>
    </div>
</div>