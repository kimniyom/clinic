<script src="<?php echo Yii::app()->baseUrl; ?>/js/_function_edit_profile.js" type="text/javascript"></script>

<script type="text/javascript">
    function set_sex(sex) {
        $("#sex").val(sex);
    }
</script>
<?php
$web = new Configweb_model();
?>

<div class="row" style=" margin: 0px;">
    <div class="col-sm-12">
        <div class="panel panel-default">

            <form id="register" name="register" action="<?php echo Yii::app()->createUrl('frontend/main/save_edit_profile'); ?>" method="post" role="form" onSubmit="return check_from();">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>รหัสสมาชิก</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="text" id="pid" name="pid" class="form-control input-sm" value="<?php echo $pid; ?>" readonly/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label>ชื่อที่ใช้แสดง</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="text" id="alias" name="alias" value="<?php echo $user['alias'] ?>" class="form-control input-sm" placeholder="ชื่อที่ใช้แสดง"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label>อีเมล์</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="email" id="email" name="email" value="<?php echo $user['email'] ?>" class="form-control input-sm" placeholder="ex. xxxxxxxx_122@gmail.com"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label>ชื่อ - นามสกุล</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" id="name" name="name" value="<?php echo $user['name'] ?>" class="form-control input-sm" placeholder="ชื่อจริง"/>
                        </div>

                        <div class="col-sm-6">
                            <input type="text" id="lname" name="lname" value="<?php echo $user['lname'] ?>" class="form-control input-sm" placeholder="นามสกุล"/>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-12">
                            <label>วันเกิด</label>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $monthname = $web->MonthFull();
                        $monthval = $web->Monthval();
                        ?>
                        <div class="col-sm-4">
                            <select id="day" name="day" class="form-control">
                                <?php
                                for ($i = 1; $i <= 31; $i++) {
                                    if (strlen($i) <= 1) {
                                        $dayactive = "0" . $i;
                                    } else {
                                        $dayactive = $i;
                                    }
                                    ?>
                                    <option value="<?php echo $dayactive; ?>" 
                                    <?php
                                    if ($dayactive == $day) {
                                        echo "selected";
                                    }
                                    ?>>
                                                <?php echo $dayactive; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <select id="month" name="month" class="form-control">
                                <?php for ($i = 0; $i <= 11; $i++) { ?>
                                    <option value="<?php echo $monthval[$i]; ?>"
                                    <?php
                                    if ($monthval[$i] == $month) {
                                        echo "selected";
                                    }
                                    ?>><?php echo $monthname[$i]; ?></option>
                                        <?php } ?>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <select id="year" name="year" class="form-control">
                                <?php
                                $yearnow = date("Y");
                                for ($i = $yearnow; $i >= $yearnow - 50; $i--) {
                                    ?>
                                    <option value="<?php echo $i; ?>"
                                            <?php if ($i == $year) {
                                                echo "selected";
                                            } ?>><?php echo $i + 543; ?></option>
<?php } ?> 
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label>คุณเป็น</label>
                        </div>
                    </div>

                    <input type="hidden" id="sex" name="sex" value="<?php echo $user['set_status'] ?>"/>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                <div class="btn-group" role="group">
                                    <div type="button" class="well well-sm" style=" width: 100%; text-align: center;">
                                        <input type="radio" name="s_sex"  onclick="set_sex('M');" <?php
                                        if ($user['set_status'] == 'M') {
                                            echo "checked='checked'";
                                        }
                                        ?>/>
                                        ผู้ชาย
                                        <i class="fa fa-mars" style=" color: #33cc00;"></i>
                                    </div>
                                </div>

                                <div class="btn-group" role="group">
                                    <div type="button" class="well well-sm" style=" width: 100%; text-align: center;">
                                        <input type="radio" name="s_sex" onclick="set_sex('F');" <?php
                                        if ($user['set_status'] == 'F') {
                                            echo "checked='checked'";
                                        }
                                        ?>/>
                                        ผู้หญิง
                                        <i class="fa fa-venus" style=" color: #ff66ff;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label>เบอร์โทรศัพท์</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <input type="text" id="tel" name="tel" value="<?php echo $user['tel'] ?>" class="form-control" maxlength="10" placeholder="กรอกตัวเลข 10 หลักเท่านั้น" onkeypress="return chkNumber();"/>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel-footer" style="text-align: center;">
                    <input type="submit" id="save_regis" name="save_regis" class="btn btn-success" value="แก้ไขข้อมูลส่วนตัว" style="width:100%;"/>
                </div>
            </form>
        </div>
    </div>
</div>








