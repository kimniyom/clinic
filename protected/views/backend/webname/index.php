<?php
$this->breadcrumbs = array(
    "ชื่อร้าน"
);
?>

<div class="well well-sm">
    <h4 style=" font-size: 20px; color: #ff0000;">
        <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $web->get_logoweb(); ?>" height="32px"/>
        จัดการชื่อร้าน
    </h4>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $web->get_logoweb(); ?>" height="32px"/>
        ชื่อร้าน
    </div>
    <div class="panel-body">
        <textarea id="webname" class="form-control" style="font-size:50px; text-align:left; color:green;"><?php echo $webname; ?></textarea>
    </div>
    <div class="panel-footer">
        <button class="btn btn-default" onclick="save_webname()"><i class="fa fa-save"></i> แก้ไขชื่อร้าน</button>
        <button class="btn btn-default" onclick="refresh()"><i class="fa fa-refresh"></i></button>
    </div>
</div>

<script type="text/javascript">
    function save_webname(){
        var url = "<?php echo Yii::app()->createUrl('backend/web/save_webname')?>";
        var webname = $("#webname").val();
        if(webname == ''){
            $("#webname").focus();
            return false;
        }
        var data = {webname: webname};
        $.post(url,data,function(success){
            window.location.reload();
        });
    }

    function refresh(){
        window.location.reload();
    }
</script>