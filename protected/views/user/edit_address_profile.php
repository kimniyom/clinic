<script type="text/javascript">
    function chang_address(type, value, active) {
        var url = "<?php echo Yii::app()->createUrl('frontend/user/get_combobox') ?>";
        var data = {type: type, value: value, active: active};
        $.post(url, data, function (result) {
            $("#" + type).html(result);
        });
    }

    function save_address_profile() {
        var url = "<?php echo Yii::app()->createUrl('frontend/user/save_address_profile') ?>";
        var number = $("#number").val();
        var building = $("#building").val();
        var _class = $("#class").val();
        var room = $("#room").val();
        var changwat = $("#changwat").val();
        var ampur = $("#ampur").val();
        var tambon = $("#tambon").val();
        var zipcode = $("#zipcode").val();
        var pid = "<?php echo Yii::app()->session['pid'] ?>";


        if (number == '') {
            $("#number").focus();
            return false;
        }
        if (changwat == '') {
            $("#changwat").focus();
            return false;
        }

        if (ampur == '') {
            $("#ampur").focus();
            return false;
        }

        if (tambon == '') {
            $("#tambon").focus();
            return false;
        }

        if (zipcode == '') {
            $("#zipcode").focus();
            return false;
        }

        var data = {
            number: number,
            building: building,
            _class: _class,
            room: room,
            changwat: changwat,
            ampur: ampur,
            tambon: tambon,
            pid: pid,
            zipcode: zipcode
        };

        $.post(url, data, function (result) {
            window.location.reload();
            //$("#edit_address_profile").modal("hide");
            //load_address();
        });

    }
</script>

<script>
    $(document).ready(function () {
        chang_address("ampur", '<?php echo $address['changwat'] ?>', '<?php echo $address['ampur'] ?>');
        chang_address("tambon", '<?php echo $address['ampur'] ?>', '<?php echo $address['tambon'] ?>');
    });

</script>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label>เลขที่ *</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" id="number" name="number" class="form-control input-sm" value="<?php echo $address['number'] ?>"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label>อาคาร</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" id="building" name="building" class="form-control input-sm" value="<?php echo $address['building'] ?>"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label>ชั้น</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" id="class" name="class" class="form-control input-sm" value="<?php echo $address['class'] ?>"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label>ห้อง</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" id="room" name="room" class="form-control input-sm" value="<?php echo $address['room'] ?>"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label>จังหวัด *</label>
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
                            <label>อำเภอ *</label>
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
                            <label>ตำบล *</label>
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
                            <label>รหัสไปรษณีย์ *</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" id="zipcode" name="zipcode" class="form-control input-sm" maxlength="5" value="<?php echo $address['zipcode'] ?>"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="button" class="btn btn-primary" onclick="save_address_profile()" style=" width: 100%;"><i class="fa fa-save"></i> แก้ไขที่อยู่</button>
            </div>
        </div>
    </div>
</div>