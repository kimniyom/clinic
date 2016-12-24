<style type="text/css">
    #cutstock{
        background: #003d2d;
        color: #ff0000;
    }
    #bcutstock{
        background: #ccffff;
        font-weight: bold;
    }
    
    table tbody tr td{
        padding: 5px;
    }
</style>
<?php
/* @var $this CenterStockitemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'คลังสินค้า' => Yii::app()->createUrl('store/index'),
    'คลังวัตถุดิบ',
);
?>

<h1><img src="<?php echo Yii::app()->baseUrl; ?>/images/add-item-icon.png"/> คลังวัตถุดิบ</h1>
<hr/>
<a href="<?php echo Yii::app()->createUrl('centerstockitem/create') ?>">
    <button type="button" class="btn btn-default"><i class="fa fa-plus"></i> เพิ่มวัตถุดิบเข้าคลัง</button></a>
<hr/>

<table class="table-bordered table-hover">
    <thead>
        <tr>
            <th style=" width: 5%; text-align: center;">#</th>
            <th>เลขล๊อต</th>
            <th>รหัส</th>
            <th>วัตถุดิบ</th>
            <th>จำนวน</th>
            <th>ราคาซื้อเข้ารวม</th>
            <th style=" text-align: center;">วันที่นำเข้า</th>
            <th id="cutstock">จำนวนที่ตัดได้</th>
            <th id="cutstock">จำนวนคงเหลือ</th>
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
                 <td><?php echo $rs['lotnumber'] ?></td>
                <td><?php echo $rs['itemcode'] ?></td>
                <td><?php echo $rs['itemname'] ?></td>
                <td><?php echo $rs['number'] ?> <?php echo $rs['unit'] ?></td>
                <td><?php echo number_format($rs['price']) ?></td>
                <td style=" text-align: center;"><?php echo $rs['create_date'] ?></td>
                <td id="bcutstock" style=" text-align: right;"><?php echo number_format($rs['numbercut']) ?> <?php echo $rs['unitcutstock'] ?></td>
                <td id="bcutstock" style=" text-align: right;"><?php echo number_format($rs['totalcut']) ?> <?php echo $rs['unitcutstock'] ?></td>
                <td style=" text-align: center; width: 10%;">
                    <a href="<?php echo Yii::app()->createUrl('centerstockitem/update', array('id' => $rs['id'])) ?>"><i class="fa fa-pencil"></i> แก้ไข</a>
                    <a href="javascript:Delete('<?php echo $rs['id'] ?>')"><i class="fa fa-trash"></i> ลบ</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    function Delete(id) {
        var r = confirm("Are you sure ..?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('centerstockitem/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }
</script>


