<?php
/* @var $this EmployeeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'พนักงาน',
);

$system = new Configweb_model();
?>

<h1>พนักงาน</h1>
<a href="<?php echo Yii::app()->createUrl('employee/create') ?>">
    <button type="button" class="btn btn-default"><i class="fa fa-user-plus"></i> เพิ่มข้อมูลพนักงาน</button></a>
<hr/>
<table class="table" id="temployee">
    <thead>
        <tr>
            <th>#</th>
            <th>Pid</th>
            <th>Name - Lname</th>
            <th>Alias</th>
            <th style="text-align: center;">Tel</th>
            <th style="text-align: center;">Salary</th>
            <th>Banch</th>
            <th style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($employee as $rs): $i++;
        $branch_id = $rs['branch'];
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $rs['pid'] ?></td>
                <td><?php echo $rs['name'] . ' ' . $rs['lname'] ?></td>
                <td><?php echo $rs['alias'] ?></td>
                <td style=" text-align: center;"><?php echo $rs['tel'] ?></td>
                <td style=" text-align: center;"><?php echo number_format($rs['salary'], 2) ?></td>
                <td><?php echo Branch::model()->find("id = '$branch_id' ")['branchname']?></td>
                <td style="text-align: center;">
                    <a href="<?php echo Yii::app()->createUrl('employee/view', array('id' => $rs['id'])) ?>"><i class="fa fa-eye text-info"></i></a>
                    <a href="<?php echo Yii::app()->createUrl('employee/update', array('id' => $rs['id'])) ?>"><i class="fa fa-pencil text-warning"></i></a>
                    <a href="javascript:deletemployee('<?php echo $rs['id'] ?>')"><i class="fa fa-trash text-danger"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<script type="text/javascript">
    $(document).ready(function () {
        $("#temployee").dataTable();
    });
    function deletemployee(id) {
        var r = confirm("คุณแน่ใจหรือไม่ ... ข้อมูลที่เกี่ยวข้องกับพนักงานจะถูกลบทั้งหมด ... ?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('employee/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }
</script>
