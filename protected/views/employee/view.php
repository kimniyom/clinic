<?php
/* @var $this EmployeeController */
/* @var $model Employee */

$this->breadcrumbs=array(
	'Employees'=>array('index'),
	$model->name,
);
$config = new Configweb_model();
$branchModel = new Branch();
?>
<style type="text/css">
    #font-18{
        color: #666666;
    }
</style>


<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-user"></i> ID <?php echo $model['pid'] ?>
    </div>
    <div class="row" style="margin:0px;">
        <div class="col-md-3 col-lg-3" style="text-align: center;">
            <?php
            if (!empty($model['images'])) {
                $img_profile = "uploads/profile/" . $model['images'];
            } else {
                if ($model['sex'] == 'M') {
                    $img_profile = "images/Big-user-icon.png";
                } else if ($model['sex'] == 'F') {
                    $img_profile = "images/Big-user-icon-female.png";
                } else {
                    $img_profile = "images/Big-user.png";
                }
            }
            ?>
            <center>
                <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_profile; ?>" class="img-responsive img-thumbnail" id="img_profile" style=" margin-top: 5px; max-height: 200px;"/>
                <br/><br/>
                <div class="well" style="border-radius:0px; text-align: left; padding-left: 30px; padding-bottom: 0px;">
                    <input type="file" name="file_upload" id="file_upload" />
                    <p id="font-16" style=" color: #ff0000; text-align: center; margin-bottom: 0px;">(ไม่เกิน 2MB)</p>
                </div>
            </center>
            <div id="font-18" style="color: #ff6600;">
                <font id="font-rsu-20" style=" color: #000020;"><?php echo $model['alias']; ?></font><br/>
                เป็นสมาชิกเมื่อ <br/><?php echo $config->thaidate($model['create_date']); ?>
            </div>
        </div>
        <div class="col-md-9 col-lg-9" style="padding-right: 0px;">
            <div class="well" style="margin: 5px; background: none;" id="font-20">
                <a href="<?php echo Yii::app()->createUrl('employee/update',array('id' => $model['id']))?>">
                    <button type="button" class="btn btn-default btn-sm pull-right" id="font-rsu-14">แก้ไขข้อมูล</button></a>
                    
                ชื่อ - สกุล <p class="label" id="font-18"><?php echo $model['name'] . ' ' . $model['lname'] ?></p><br/>
                ชื่อเล่น <p class="label" id="font-18"><?php
                    if (isset($model['alias'])) {
                        echo $model['alias'];
                    } else {
                        echo "-";
                    }
                    ?></p><br/>
                เพศ <p class="label" id="font-18"><?php
                    if ($model['sex'] == 'M') {
                        echo "ชาย";
                    } else {
                        echo "หญิง";
                    }
                    ?></p><br/>
                   เกิดวันที่ <p class="label" id="font-18"><?php
                    if (isset($model['birth'])) {
                        echo $config->thaidate($model['birth']);
                    } else {
                        echo "-";
                    }
                    ?></p> ปี<br/>
                อายุ <p class="label" id="font-18"><?php
                    if (isset($model['birth'])) {
                        echo $config->get_age($model['birth']);
                    } else {
                        echo "-";
                    }
                    ?></p><br/>
                อีเมล์ <p class="label" id="font-18"><?php
                    if (isset($model['email'])) {
                        echo $model['email'];
                    } else {
                        echo "-";
                    }
                    ?></p><br/>

                เบอร์โทรศัพท์ <p class="label" id="font-18"><?php
                    if (isset($model['tel'])) {
                        echo $model['tel'];
                    } else {
                        echo "-";
                    }
                    ?></p><br/>
                สถานที่ปฏิบัติงาน <p class="label" id="font-18"><?php
                        echo "สาขา ".$branchModel->Getbranch($model['branch']);
                    ?></p><br/>
                วันที่เข้าทำงาน <p class="label" id="font-18"><?php
                    if (isset($model['walking'])) {
                        echo $config->thaidate($model['walking']);
                    } else {
                        echo "-";
                    }
                    ?></p><br/>
                ตำแหน่ง <p class="label" id="font-18"><?php
                        $position = $model['position'];
                        echo Position::model()->find("id = '$position' ")['position'];

                    ?></p><br/>
                 เงินเดือน <p class="label" id="font-18"><?php
                    if (isset($model['salary'])) {
                        echo number_format($model['salary'],2);
                    } else {
                        echo "-";
                    }
                    ?> </p>บาท<br/>
                 
                 ข้อมูลอัพเดทวันที่ <p class="label" id="font-18"><?php
                    if (isset($model['d_update'])) {
                        echo $config->thaidate($model['d_update']);
                    } else {
                        echo "-";
                    }
                    ?></p><br/>
                <br/>
                
                <!--
                ที่อยู่ <br/>
                <div class="btn btn-default btn-sm pull-right" id="font-rsu-14" onclick="edit_address_profile();">แก้ไขที่อยู่</div>
                <ul style=" padding-top: 5px;">
                -->
                    <?php
                    /*
                    echo "<li>เลขที่ ";
                    if (isset($model['number'])) {
                        echo ($model['number']);
                    } else {
                        echo "-";
                    } "</li>";
                    echo "<li>อาคาร ";
                    if (isset($model['building'])) {
                        echo ($model['building']);
                    } else {
                        echo "-";
                    } "</li>";
                    echo "<li>ชั้น ";
                    if (isset($model['class'])) {
                        echo ($model['class']);
                    } else {
                        echo "-";
                    }
                    echo " ห้อง ";
                    if (isset($model['room'])) {
                        echo ($model['room']);
                    } else {
                        echo "-";
                    } "</li>";
                    echo "<li>ต. ";
                    if (isset($model['tambon_name'])) {
                        echo ($model['tambon_name']);
                    } else {
                        echo "-";
                    }
                    echo " &nbsp;&nbsp;อ. ";
                    if (isset($model['ampur_name'])) {
                        echo ($model['ampur_name']);
                    } else {
                        echo "-";
                    }
                    echo " &nbsp;&nbsp;จ. ";
                    if (isset($model['changwat_name'])) {
                        echo ($model['changwat_name']);
                    } else {
                        echo "-";
                    } "</li>";
                    echo "<li>รหัสไปรษณีย์ ";
                    if (isset($model['zipcode'])) {
                        echo ($model['zipcode']);
                    } else {
                        echo "-";
                    } "</li>";
                     * 
                     */
                    ?>
                </ul>
            </div>
        </div>

    </div>


</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('#file_upload').uploadify({
            'buttonText': 'เลือกรูปภาพ ...',
            //'swf ': '<?//php echo Yii::app()->baseUrl; ?>/lib/uploadify/uploadify.swf',
            'swf': '<?php echo Yii::app()->baseUrl . "/lib/uploadify/uploadify.swf?preventswfcaching=1442560451655"; ?>',
            'uploader': '<?php echo Yii::app()->createUrl('employee/save_upload', array('pid' => $model['pid'])) ?>',
            'auto': true,
            'fileSizeLimit': '2MB',
            'fileTypeExts': ' *.jpg; *.png',
            'uploadLimit': 1,
            'onUploadSuccess': function (data) {
                window.location.reload();
            }
        });
    });

    
</script>

