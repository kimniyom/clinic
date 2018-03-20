<style type="text/css">

</style>
<?php
/* @var $this MasuserController */
/* @var $model Masuser */

$this->breadcrumbs = array(
    'ผู้ใช้งาน' => array('privilege'),
    $model->username,
);

$MasuserModel = new Masuser();
$profile = $MasuserModel->GetDetailUser($model['user_id']);
$StatusModel = new StatusUser();
$statuss = $model['status'];
$status = $StatusModel->find("id = '$statuss'")['status'];
$branch = new Branch();

echo $profile['user_id'];
?>

<div class="row" style=" margin: 0px;">
    <div class="col-md-4 col-lg-4" id="p-left">
        <input type="hidden" id="user_id" value="<?php echo $user_id ?>"/>
        <div class="panel panel-default">
            <div class="panel-heading">ข้อมูล <?php echo $model->username; ?></div>
            <div style="color:#000000;">
                <?php
                $this->widget('booster.widgets.TbDetailView', array(
                    'data' => $model,
                    'attributes' => array(
                        'id',
                        'username',
                        array(// related city displayed as a link
                            'label' => 'ชื่ผู้ใช้งาน',
                            'type' => 'raw',
                            'value' => $profile['name'] . ' ' . $profile['lname'],
                        ),
                        //'password',
                        array(// related city displayed as a link
                            'label' => 'สถานะ',
                            'type' => 'raw',
                            'value' => $status,
                        ),
                        array(// related city displayed as a link
                            'label' => 'วันที่บันทึกข้อมูล',
                            'type' => 'raw',
                            'value' => $model->create_date,
                        ),
                        array(// related city displayed as a link
                            'label' => 'วันที่อัพเดืข้อมูล',
                            'type' => 'raw',
                            'value' => $model->d_update,
                        ),
                    //'flag',
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-lg-8">
        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><font class="sit">สิทธิ์</font>สาขา</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" onclick="menu()"><font class="sit">สิทธิ์</font>เมนู</a></li>
                <li role="presentation"><a href="#menureport" aria-controls="menureport" role="tab" data-toggle="tab" onclick="getmenureport()"><font class="sit">สิทธิ์</font>ดูรายงาน</a></li>
                <li role="presentation"><a href="#menusetting" aria-controls="menusetting" role="tab" data-toggle="tab" onclick="getmenusetting()"><font class="sit">สิทธิ์</font>ตั้งค่า</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content" id="p-right" style="  padding:0px; border-top: solid #009ed8 2px;">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="row" style=" margin: 10px 0px 0px 0px;">
                        <div class="col-lg-10">
                            <?php
                            $user_id = $profile['id'];
                            $sql = "SELECT b.id,b.branchname FROM branch b";
                            //$sql = "SELECT b.id,b.branchname FROM branch b WHERE b.id NOT IN(SELECT branch_id FROM role_branch WHERE user_id = '$user_id')";
                            $datas = Yii::app()->db->createCommand($sql)->queryAll();
                            $this->widget('booster.widgets.TbSelect2', array(
                                //'model' => $model,
                                'asDropDownList' => true,
                                //'attribute' => 'user_id',
                                'name' => 'branch',
                                'id' => 'branch',
                                'data' => CHtml::listData($datas, 'id', 'branchname'),
                                //'value' => $model,
                                'options' => array(
                                    //$model,
                                    //'oid',
                                    //'tags' => array('clever', 'is', 'better', 'clevertech'),
                                    'placeholder' => 'เลือกสาขา',
                                    'width' => '100%',
                                //'tokenSeparators' => array(',', ' ')
                                )
                            ));
//echo CHtml::dropDownList('user_id', $model, CHtml::listData(Employee::model()->findAll(""), 'id', 'name'), array('empty' => '(Select a employee)', 'class' => 'form-control')
//);
                            ?>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-success btn-block" onclick="setBranch()"><i class="fa fa-plus-circle"></i> เพิ่ม</button>
                        </div>
                    </div>
                    <br/>
                    <div id="branchs"></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <div id="menu"></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="menureport">

                </div>
                <div role="tabpanel" class="tab-pane" id="menusetting">

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    Getrole();
    menu();
    function setBranch() {
        var url = "<?php echo Yii::app()->createUrl('masuser/setbranch') ?>";
        var user_id = "<?php echo $profile['id'] ?>";
        var branch = $("#branch").val();
        if (branch == '') {
            alert("ยังไม่ได้เลือกสาขา ...");
            return false;
        }
        var data = {user_id: user_id, branch: branch};
        $.post(url, data, function (datas) {
            Getrole();
        });
    }
    function Getrole() {
        var url = "<?php echo Yii::app()->createUrl('masuser/getrole') ?>";
        var user_id = "<?php echo $profile['id'] ?>";
        var data = {user_id: user_id};
        $.post(url, data, function (datas) {
            $("#branchs").html(datas);
        });
    }
    function Deletebranch(id) {
        var url = "<?php echo Yii::app()->createUrl('masuser/deletebranch') ?>";
        var data = {id: id};
        $.post(url, data, function (datas) {
            Getrole();
        });
    }
    function menu() {
        var url = "<?php echo Yii::app()->createUrl('menu/getmenu') ?>";
        var user_id = "<?php echo $profile['id'] ?>";
        var data = {user_id: user_id};
        $.post(url, data, function (datas) {
            $("#menu").html(datas);
        });
    }

    function getmenureport() {
        var url = "<?php echo Yii::app()->createUrl('menureport/getmenureport') ?>";
        var user_id = "<?php echo $profile['id'] ?>";
        var data = {user_id: user_id};
        $.post(url, data, function (datas) {
            $("#menureport").html(datas);
        });
    }

    function getmenusetting() {
        var url = "<?php echo Yii::app()->createUrl('menusetting/getmenusetting') ?>";
        var user_id = "<?php echo $profile['id'] ?>";
        var data = {user_id: user_id};
        $.post(url, data, function (datas) {
            $("#menusetting").html(datas);
        });
    }
</script>

<script type="text/javascript">
    Setscreen();
    function Setscreen() {
        var screen = $(window).height();
        var w = window.innerWidth;
        if (w >= 768) {
            var screenfull = (screen - 115);
            var screenfullRight = (screen - 155);
            $("#p-left").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
            $("#p-right").css({'height': screenfullRight, 'overflow': 'auto', 'padding-bottom': '25px'});
            
            //$("#patientbox").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF'});
            //$("#boxorders").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF', 'overflow': 'auto', 'padding-left': '10px'});
        } else {
            $(".sit").hide();
        }
    }
</script>