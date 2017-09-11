<?php
/* @var $this DiagController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'รายการหัตถการ',
);
?>

<h1>รายการหัตถการ</h1>
<a href="<?php echo Yii::app()->createUrl('diag/create') ?>">
    <button type="button" class="btn btn-default"><i class="fa fa-plus"></i> เพิ่มข้อมูลหัตถการ</button></a>
<br/><br/>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>diagname</th>
            <th style=" text-align: center;">price</th>
            <th style=" text-align: center;">action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0;
        foreach ($diag as $rs): $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $rs['diagname'] ?></td>
                <td style=" text-align: right;"><?php echo $rs['price'] ?></td>
                <td style="text-align: center;">
                    <a href="<?php echo Yii::app()->createUrl('diag/view', array('id' => $rs['diagcode'])) ?>">
                        <i class="fa fa-eye"></i></a>
                    <a href="<?php echo Yii::app()->createUrl('diag/update', array('id' => $rs['diagcode'])) ?>">
                        <i class="fa fa-pencil"></i></a>
                    <a href="javascript:deletediag('<?php echo $rs['diagcode'] ?>')">
                        <i class="fa fa-trash"></i></a>
                </td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    function deletediag(id) {
        var r = confirm("Are you sure");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('diag/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (datas) {
                window.location.reload();
            });
        }
    }
</script>
