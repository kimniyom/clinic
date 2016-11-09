<script type="text/javascript">
    function edit_type() {
        $("#loading").addClass("fa fa-spinner fa-spin");
        var url = "<?php echo Yii::app()->createUrl('backend/typeproduct/save_edit_type') ?>";
        var id = "<?php echo $type['id'] ?>";
        var type_name = $("#type_name").val();
        var active = $("#active").val();
        var data = {
            id: id,
            type_name: type_name,
            active: active
        };
        if (type_name == "") {
            $("#type_name").focus();
            return false;
        }

        $.post(url, data, function (success) {
            $("#loading").addClass("fa fa-check");
            window.location.reload();
        });

    }

    function set_active(active) {
        $("#active").val(active);
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
$this->breadcrumbs = array(
    'ประเภทสินค้า' => array("backend/typeproduct/from_add_type"),
    $type['type_name']
);
?>

<div class="panel panel-default">
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
        <label for="">สถานะ</label>
        <input type="hidden" id="active" value="<?php echo $type['active'] ?>"/>
        <input id="status" name="status" class="styled" type="radio"
        <?php
        if ($type['active'] == '1') {
            echo "checked='checked'";
        }
        ?>  onclick="set_active(1);">
        <label for="radio">พร้อมขาย</label>

        <input id="status" name="status" class="styled" type="radio"
        <?php
        if ($type['active'] == '0') {
            echo "checked='checked'";
        }
        ?>  onclick="set_active(0);">
        <label for="radio">ไม่พร้อมขาย</label>

        <br/>
    </div>
    <div class="panel-footer">
        <div class="btn btn-success" onclick="edit_type();">
            <i class="fa fa-save" id="loading"></i> 
            แก้ไขข้อมูล</div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">ประเภทสินค้า</div>
        <table class="table table-striped table-bordered" id="product_type">
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ประเภท</th>
                    <th style="text-align: center;">Staus</th>
                    <th style=" text-align: center;">เมนูจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($typeall as $rs): ?>
                    <tr>
                        <td><?php echo $rs['type_id'] ?></td>
                        <td><?php echo $rs['type_name'] ?></td>
                        <td style="text-align: center;">
                            <?php if ($rs['active'] == 1) echo "<i class='fa fa-check text-success'></i> Active";
                            else echo "<i class='fa fa-remove text-danger'></i> Unactive"; ?>
                        </td>
                        <td style=" text-align: center;">
                            <a href="<?php echo Yii::app()->createUrl('backend/typeproduct/edit', array('id' => $rs['id'])) ?>">
                                <div class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> แก้ไข</div></a>
                            <div class="btn btn-danger btn-xs" onclick="Check('<?php echo $rs['type_id'] ?>')"><i class="glyphicon glyphicon-trash"></i> ลบ</div>
                        </td>
                    </tr>
<?php endforeach; ?>
            </tbody>
        </table>

</div>




