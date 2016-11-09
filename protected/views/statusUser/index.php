<?php
/* @var $this StatusUserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Status Users',
);

?>

<h1>Status Users</h1>
<a href="<?php echo Yii::app()->createUrl('statusUser/create')?>">
    <button type="button" class="btn btn-default"><i class="fa fa-plus"></i> เพิ่ม</button></a>
    <br/><br/>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Status</th>
                <th style=" text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0;foreach($status as $rs): $i++;?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $rs['status']?></td>
                <td style=" text-align: center;">
                    <a href="<?php echo Yii::app()->createUrl('statusUser/update',array('id' => $rs['id'])) ?>"><i class="fa fa-pencil"></i></a>
                    <?php if($rs['id'] != '1'){ ?>
                    <a href="javascript:deletestatus('<?php echo $rs['id']?>')"><i class="fa fa-trash"></i></a>
                    <?php } ?>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    
    <script type="text/javascript">
        function deletestatus(id){
            var r = confirm("คุณแน่ใจหรือไม่ ...");
            if(r == true){
                var url = "<?php echo Yii::app()->createUrl('statusUser/delete')?>";
                var data = {id: id};
                $.post(url,data,function(success){
                    window.location.reload();
                });
            }
        }
    </script>
