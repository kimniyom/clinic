<?php
/* @var $this GradcustomerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Gradcustomers',
);

$this->menu = array(
    array('label' => 'Create Gradcustomer', 'url' => array('create')),
    array('label' => 'Manage Gradcustomer', 'url' => array('admin')),
);
?>
<a href="<?php echo Yii::app()->createUrl('gradcustomer/create') ?>">
    <button type="button" class="btn btn-success"><i class="fa fa-plus"></i> เพิ่มประเภทลูกค้า</button></a>
<div class="panel panel-default">
    <div class="panel-heading">
        ประเภทลูกค้า
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ประเภทลูกค้า</th>
                    <th style="text-align: center;">ส่วนลดการรักษา</th>
                    <th style="text-align: center;">ส่วนลดการซื้อสินค้า</th>
                    <th style=" text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($gradcustomer as $rs): $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $rs['grad'] ?></td>
                        <td style=" text-align: center;"><?php echo number_format($rs['distcount']) ?></td>
                        <td style=" text-align: center;"><?php echo number_format($rs['distcountsell']) ?></td>
                        <td style=" text-align: center;">
                            <a href="<?php echo Yii::app()->createUrl('gradcustomer/update', array('id' => $rs['id'])) ?>">
                                <i class="fa fa-pencil"></i></a>
                            <a href="javascript:deletegrad('<?php echo $rs['id'] ?>')">
                                <i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<script type="text/javascript">
    function deletegrad(id){
        var r = confirm("Are you sure ...");
        if(r == true){
            var url = "<?php echo Yii::app()->createUrl('gradcustomer/delete')?>";
            var data = {id: id};
            $.post(url,data,function(success){
                window.location.reload();
            });
        }
    }
</script>
