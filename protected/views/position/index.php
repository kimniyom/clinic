<?php
/* @var $this PositionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'ตำแหน่งพนักงาน',
);
?>

<div class="panel panel-primary" style=" margin-bottom: 0px;">
    <div class="panel-heading" style=" position: relative;">
        <h4>ตำแหน่งพนักงาน</h4>
        <a href="<?php echo Yii::app()->createUrl('position/create') ?>" style="position: absolute; right: 10px; top: 10px;">
            <button type="button" class="btn btn-success"><i class="fa fa-plus"></i> เพิ่ม</button></a>
    </div>
    <div class="panel-body" id="boxbody">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ตำแหน่ง</th>
                    <th style=" text-align: center;">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($position as $rs): $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $rs['position'] ?></td>
                        <td style=" text-align: center;">
                            <a href="<?php echo Yii::app()->createUrl('position/update', array('id' => $rs['id'])) ?>"><i class="fa fa-pencil"></i> แก้ไข</a>
                            <a href="javascript:deleteposition('<?php echo $rs['id'] ?>')"><i class="fa fa-trash-o"></i> ลบ</a>
                        </td>
                    </tr>
<?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    Setscreen();
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

    function Setscreen() {
        var screen = $(window).height();
        var w = window.innerWidth;
        var screenfull = (screen - 160);
        if (w > 768) {
            $("#boxbody").css({'height': screenfull, 'overflow': 'auto'});
        }
    }
</script>
