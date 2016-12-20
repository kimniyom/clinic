<?php
/* @var $this CenterStockunitController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'คลังสินค้า' => Yii::app()->createUrl('store/index'),
    'รายการวัตถุดิบ',
);
?>

<h1>รายการวัตถุดิบ</h1>
<hr/>
<a href="<?php echo Yii::app()->createUrl('centerstockitemname/create') ?>">
    <button class="btn btn-default"><i class="fa fa-plus"></i> เพิ่มรายการวัตถุดิบ</button></a>
<hr/>
<table class="table-bordered table-hover">
    <thead>
        <tr>
            <th style=" width: 5%; text-align: center;">#</th>
            <th>รหัส</th>
            <th>วัตถุดิบ</th>
            <th>ราคา / หน่วย</th>
            <th>หน่วยนับ</th>
            <th>หน่วยตัดสต๊อก</th>
            <th style=" text-align: center;">ตัวเลือก</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($item as $rs): $i++;
            ?>
            <tr>
                <td style=" text-align: center;"><?php echo $i ?></td>
                <td><?php echo $rs['itemcode'] ?></td>
                <td><?php echo $rs['itemname'] ?></td>
                <td><?php echo number_format($rs['price']) ?></td>
                <td><?php
                    $unit = $rs['unit'];
                    echo CenterStockunit::model()->find("id = '$unit' ")['unit']
                    ?></td>
                <td><?php
                    $unitcut = $rs['unitcut'];
                    echo CenterStockunit::model()->find("id = '$unitcut' ")['unit']
                    ?></td>
                <td style=" text-align: center; width: 10%;">
                    <a href="<?php echo Yii::app()->createUrl('centerstockitemname/update', array('id' => $rs['id'])) ?>"><i class="fa fa-pencil"></i></a>
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
            var url = "<?php echo Yii::app()->createUrl('centerstockitemname/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }
</script>
