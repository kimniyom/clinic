<script type="text/javascript">
    function edit_type() {
        $("#loading").addClass("fa fa-spinner fa-spin");
        var url = "<?php echo Yii::app()->createUrl('backend/typeproduct/save_edit_type') ?>";
        var id = "<?php echo $type['id'] ?>";
        var type_name = $("#type_name").val();
        var upper = $("#upper").val();
        var level = $('input[name=level]:checked').val();

        var active = $("#active").val();
        var data = {
            id: id,
            type_name: type_name,
            active: active,
            upper: upper,
            level: level
        };
        if (type_name == "") {
            $("#type_name").focus();
            return false;
        }

        $.post(url, data, function (success) {
            $("#loading").addClass("fa fa-check");
            window.location="<?php echo Yii::app()->createUrl('backend/typeproduct/from_add_type',array('upper' => $upper))?>";
        });

    }


    function delete_type(type_id) {
        var r = confirm("ต้องการลบข้อมูล ใช่ หรือ ไม่ ...?");
        if (r === true) {
            var url = "<?php echo Yii::app()->createUrl("backend/typeproduct/delete") ?>";
            var data = {type_id: type_id};

            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }

    function Check(type_id) {
        var url = "<?php echo Yii::app()->createUrl("backend/typeproduct/checkproduct") ?>";
        var data = {type_id: type_id};

        $.post(url, data, function (datas) {
            if (datas > 0) {
                alert("มีสินค้าในประเภทนี้ไม่สามารถทำรายการได้");
                return false;
            } else {
                //alert("TRUE");
                delete_type(type_id);
            }
        });
    }
</script>

<?php
if(!empty($upper)){
$this->breadcrumbs = array(
    'ประเภทสินค้า' => array("backend/typeproduct/from_add_type"),
    $uppername => array("backend/typeproduct/from_add_type&upper=$upper"),
    $type['type_name']
);
} else {
   $this->breadcrumbs = array(
    'ประเภทสินค้า' => array("backend/typeproduct/from_add_type"),
    $type['type_name']
); 
}
?>

<div class="panel panel-primary">
    <div class="panel-heading">จัดการประเภทสินค้า</div>
    <div class="panel-body">
        <div class="row" style="margin: 0px;">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <label>รหัส</label>
                <input class="form-control input-sm" id="type_id" name="type_id" type="text" value="<?php echo $type['type_id']; ?>" readonly="readonly"/>
            </div>
        </div>
        <div class="row" style="margin: 0px;">
            <div class="col-sm-12 col-lg-12">
                <label>ประเภท</label>
                <input class="form-control input-sm" id="type_name" name="type_name" type="text" placeholder="ชื่อประเภทสินค้า ..." value="<?php echo $type['type_name'] ?>"/>
            </div>
            <br/>
        </div>

        <br/>
        <label for="">มีเมนูย่อย</label>
        <input id="level" name="level" type="radio"
        <?php
        if ($type['sublevel'] == '1') {
            echo "checked='checked'";
        }
        ?> value="1">
        <label for="">ไม่มีเมนูย่อย</label>
        <input id="level" name="level" type="radio"
        <?php
        if ($type['sublevel'] == '0') {
            echo "checked='checked'";
        }
        ?> value="0">

        <br/>
    </div>
    <div class="panel-footer">
        <div class="btn btn-success" onclick="edit_type();">
            <i class="fa fa-save" id="loading"></i> 
            แก้ไขข้อมูล</div>
    </div>
</div>