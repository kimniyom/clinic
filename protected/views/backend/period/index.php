<?php
$this->breadcrumbs = array(
    "ระยะเวลาจองสินค้า"
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-calendar"></i> ระยะเวลาจองสินค้า
    </div>
    <div class="panel-body">
        <label>ระยะเวลาจองสินค้า</label>
        <input type="text" id="period" class="form-control" placeholder="ใส่จำนวนวันที่นี้ ..." onkeypress="return chkNumber();">
    </div>
    <div class="panel-footer">
        <button type="button" class="btn btn-default" onclick="save_period()"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-clock-o"></i> ระยะเวลาจองสินค้า
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>ระยะเวลา(วัน)</th>
                <th style="text-align:center;">STATUS</th>
                <th style="text-align:center;">DELETE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><i class="fa fa-clock-o"></i> 3</td>
                <td style="text-align:center;">
                    <div class="radio radio-danger" style=" margin: 0px;">
                        <?php 
                        $active = $model->get_period_active();
                        if(empty($result) || empty($active)){ ?>
                            <input id="active" name="active" class="styled" type="radio" checked="checked">
                            <label for="radio"></label>
                        <?php } else { ?>
                            <input id="active" name="active" class="styled" type="radio" checked="checked"
                            onclick="set_active('')">
                            <label for="radio"></label>
                        <?php } ?>
                    </div>
                </td>
                <td style="text-align:center;">
                    <button type="button" class="btn btn-danger btn-sm disabled"><i class="fa fa-ban"></i> delete</button>
                </td>
            </tr>
            <?php $i=1;foreach($result as $rs): $i++;?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <i class="fa fa-clock-o"></i>
                    <?php echo $rs['period']?>
                </td>
                <td style="text-align:center;">
                     <div class="radio radio-danger" style=" margin: 0px;">
                        <?php if($rs['active'] == '1'){ ?>
                            <input id="active" name="active" class="styled" type="radio" checked="checked"  onclick="set_active('<?php echo $rs['id'] ?>');">
                        <?php } else {?>
                            <input id="active" name="active" class="styled" type="radio" onclick="set_active('<?php echo $rs['id'] ?>');">
                        <?php } ?>
                        <label for="radio"></label>
                    </div>  
                </td>
                <td style="text-align:center;">
                    <button type="button" class="btn btn-danger btn-sm" onclick="delete_period('<?php echo $rs['id']?>')"><i class="fa fa-trash"></i> delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php 
        if(empty($result)){
            echo "<div class='well'><center>ไม่มีข้อมูล</center></div>";
        }
    ?>
</div>

<span>* ระบบจะตั้งค่าเริ่มต้นให้เป็น 3 วัน ถ้ายังไม่ได้กำหนด</span>

<script type="text/javascript">
    function set_active(id){
        var url = "<?php echo Yii::app()->createUrl('backend/period/set_active')?>";
        var data = {id: id};
        $.post(url,data,function(success){
            window.location.reload();
        });
    }

    function save_period(){
        var period = $("#period").val();
        var url = "<?php echo Yii::app()->createUrl('backend/period/save_period')?>";
        var data = {period: period};
        if(period == ''){
            $("#period").focus();
            return false;
        }

        $.post(url,data,function(success){
            window.location.reload();
        });
    }

    function delete_period(id){
        var r = confirm("คุณแน่ใจหรือไม่ ...");
        var url = "<?php echo Yii::app()->createUrl('backend/period/delete')?>";
        var data = {id: id};
        if(r == true){
            $.post(url,data,function(success){
                window.location.reload();
            });
        }
    }
</script>
