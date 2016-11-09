<style type="text/css">
    .register label{font-size: 16px;}
</style>

<?php
$this->breadcrumbs = array(
    'ลงทะเบียนพนักงาน',
);
?>

<script src="<?php echo Yii::app()->baseUrl; ?>/js/_function_masuser.js" type="text/javascript"></script>
<?php $web = new Configweb_model(); ?>
<div class="panel panel-default">
    <?php if (isset($error)) { ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>
    <form id="register" name="register" class="register"
          action="<?php echo Yii::app()->createUrl('backend/user/save_register'); ?>" 
          method="post" role="form" onSubmit="return check_from();">
        <div class="panel-body" id="font-rsu-20">
            <legend>
                ลงทะเบียนพนักงาน<br/>
            </legend>

            <div class="row">
                <div class="col-sm-12">
                    <label>รหัสพนักงาน</label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <input type="text" id="pid" name="pid" class="form-control" value="<?php echo $id; ?>" readonly/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label>สาขาที่ทำงาน</label>
                </div>
            </div>
            <select id="branch" name="branch" class=" form-control">
                <?php foreach ($branch as $b): ?>
                    <option value="<?php echo $b['id'] ?>"><?php echo $b['branchname'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="row">
                <div class="col-sm-12">
                    <label>อีเมล์</label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <input type="email" id="email" name="email" class="form-control" placeholder="ex. xxxxxxxx_122@gmail.com"/>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <label>ชื่อที่ใช้แสดง</label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <input type="text" id="alias" name="alias" class="form-control " placeholder="ชื่อที่ใช้แสดง"/>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <label>รหัสผ่าน</label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <input type="password" id="password" name="password" class="form-control " maxlength="8" placeholder="อักขระ A-Z,a-z,0-9 ความยาว 6-8 ตัว"/>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <label>ชื่อของคุณ</label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <input type="text" id="name" name="name" class="form-control " placeholder="ชื่อจริง"/>
                </div>

                <div class="col-sm-6">
                    <input type="text" id="lname" name="lname" class="form-control " placeholder="นามสกุล"/>
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
                        <option value="">วัน</option>
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            if (strlen($i) <= 1) {
                                $day = "0" . $i;
                            } else {
                                $day = $i;
                            }
                            ?>
                            <option value="<?php echo $day; ?>"><?php echo $day; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-sm-4">
                    <select id="month" name="month" class="form-control">
                        <option value="">เดือน</option>
                        <?php for ($i = 0; $i <= 11; $i++) { ?>
                            <option value="<?php echo $monthval[$i]; ?>"><?php echo $monthname[$i]; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-sm-4">
                    <select id="year" name="year" class="form-control">
                        <option value="">ปี</option>
                        <?php
                        $yearnow = date("Y");
                        for ($i = $yearnow; $i >= $yearnow - 50; $i--) {
                            ?>
                            <option value="<?php echo $i; ?>"><?php echo $i + 543; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <label>คุณเป็น</label>
                </div>
            </div>
            <input type="hidden" id="sex" name="sex"/>
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                            <div type="button" class="well well-sm" style=" width: 100%; text-align: center;">
                                <input type="radio" name="s_sex" onclick="set_sex('M');"/>
                                ผู้ชาย
                                <i class="fa fa-mars" style=" color: #33cc00;"></i>
                            </div>
                        </div>


                        <div class="btn-group" role="group">
                            <div type="button" class="well well-sm" style=" width: 100%; text-align: center;">
                                <input type="radio" name="s_sex" onclick="set_sex('F');"/>
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
                            <input type="text" id="tel" name="tel" class="form-control" maxlength="10" placeholder="กรอกตัวเลข 10 หลักเท่านั้น" onkeypress="return chkNumber()" style=" z-index: 0;"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <label>เข้าใช้งานระบบ</label>
                    <input type="checkbox" id="login" name="login" checked="checked"/>
                </div>
            </div>

            <label>วันที่เข้าทำงาน</label>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'walking',
                        //'attribute' => 'publication_date',
                        //'model' => $model,
                        'language' => 'th',
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd',
                            'altFormat' => 'yy-mm-dd',
                            'changeMonth' => true,
                            'changeYear' => true,
                            //'appendText' => 'yyyy-mm-dd',
                        ),
                    ));
                    ?>
                </div>
            </div>

        </div>
        <div class="panel-footer" style="text-align: center;">
            <input type="submit" id="save_regis" name="save_regis" class="btn btn-success" value="บันทึกข้อมูล"/>
        </div>
    </form>
</div>

<script type="text/javascript">
    function set_sex(sex) {
        $("#sex").val(sex);
    }
</script>








