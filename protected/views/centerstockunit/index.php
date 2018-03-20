<?php
/* @var $this CenterStockunitController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'คลังสินค้า' => Yii::app()->createUrl('store/index'),
    'หน่วยนับวัตถุดิบ',
);
?>

<h4>หน่วยนับวัตถุดิบ</h4>
<hr/>
<a href="<?php echo Yii::app()->createUrl('centerstockunit/create') ?>">
    <button class="btn btn-default"><i class="fa fa-plus"></i> เพิ่มหน่วยนับ</button></a>
<hr/>
<table class="table-bordered table-hover">
    <thead>
        <tr>
            <th style=" width: 5%; text-align: center;">#</th>
            <th>หน่วยนับ</th>
            <th style=" text-align: center;">ตัวเลือก</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0;
        foreach ($unit as $rs): $i++; ?>
            <tr>
                <td style=" text-align: center;"><?php echo $i ?></td>
                <td><?php echo $rs['unit'] ?></td>
                <td style=" text-align: center; width: 10%;">
                    <a href="<?php echo Yii::app()->createUrl('centerstockunit/update', array('id' => $rs['id'])) ?>"><i class="fa fa-pencil"></i></a>
                    <a href="javascript:Delete('<?php echo $rs['id'] ?>')"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    function Delete(id) {
        var r = confirm("Are you sure ..?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('centerstockunit/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }
</script>
