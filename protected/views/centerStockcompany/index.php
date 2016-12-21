<?php
$this->breadcrumbs = array(
    "คลังสินค้า" => array('store/index'),
    "บริษัท"
);

$web = new Configweb_model();
?>

<h1>บริษัท</h1>
<hr/>
<a href="<?php echo Yii::app()->createUrl('centerstockcompany/create') ?>">
    <button class="btn btn-default"><i class="fa fa-plus"></i> เพิ่มบริษัท</button></a>
<hr/>

<table class="table-bordered table-hover">
    <thead>
        <tr>
            <th style=" width: 5%;">#</th>
            <th>รหัส</th>
            <th>ชื่อบริษัท</th>
            <th style=" text-align: center;">ตัวเลือก</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($company as $last):
            $i++;
            ?>
            <tr>
                <td style=" text-align: center;"><?php echo $i ?></td>
                <td><?php echo $last['company_id']; ?></td>
                <td><?php echo $last['company_name']; ?></td>
                <td style=" text-align: center; font-weight: bold;">
                    <a href="<?php echo Yii::app()->createUrl('centerstockcompany/update', array('id' => $last['id'])) ?>"><i class="fa fa-pencil"></i></a>
                    <a href="javascript:Delete('<?php echo $last['id'] ?>')"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    function Delete(id) {
        var r = confirm("Are you sure ..?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('centerstockcompany/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }
</script>
