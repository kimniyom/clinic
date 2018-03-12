<?php
/* @var $this PositionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'ตำแหน่งพนักงาน',
);
?>

<div class="panel panel-default" style=" margin-bottom: 0px;">
    <div class="panel-heading">
        ตำแหน่งพนักงาน
        <a href="<?php echo Yii::app()->createUrl('position/create') ?>">
            <button type="button" class="btn btn-success"><i class="fa fa-plus"></i> เพิ่ม</button></a>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped" id="position">
            <thead>
                <tr>
                    <th style=" text-align: center;">#</th>
                    <th>ตำแหน่ง</th>
                    <th style="text-align:right;">เงินประจำตำแหน่ง</th>
                    <th style=" text-align: center;">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($position as $rs): $i++;
                    ?>
                    <tr>
                        <td style=" text-align: center;"><?php echo $i ?></td>
                        <td><?php echo $rs['position'] ?></td>
                        <td style="text-align:right;"><?php echo number_format($rs['positionfree'],2) ?></td>
                        <td style=" text-align: center;">
                            <a href="<?php echo Yii::app()->createUrl('position/update', array('id' => $rs['id'])) ?>" style="color:orange; text-decoration:none;"><i class="fa fa-pencil"></i> แก้ไข</a>
                            <a href="javascript:deleteposition('<?php echo $rs['id'] ?>')" style="color:red;text-decoration:none;"><i class="fa fa-trash-o"></i> ลบ</a>
                        </td>
                    </tr>
<?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">

    function deleteposition(id) {
        var r = confirm("Are you sure");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('position/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (datas) {
                window.location.reload();
            });
        }
    }
    $(document).ready(function(){
        $("#position").dataTable();
    });
</script>
