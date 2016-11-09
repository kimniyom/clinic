<?php
/* @var $this MasuserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Masusers',
);

$system = new Configweb_model();
$MasuserModel = new Masuser();
?>

<h1>ผู้ใช้งานระบบ</h1>
<a href="<?php echo Yii::app()->createUrl('masuser/create')?>">
    <button type="button" class="btn btn-default"><i class="fa fa-user-plus"></i> เพิ่มผู้ใช้งาน</button></a>
<hr/>
<table class="table table-striped" id="tuser">
    <thead>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Password</th>
            <th>Name - Lname</th>
            <th>Status</th>
            <th>CreateDate</th>
            <th style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0; foreach($user as $rs): $i++;?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $rs['username'] ?></td>
            <td><?php echo $rs['password'] ?></td>
            <td>
                <?php 
                    $rss = $MasuserModel->GetDetailUser($rs['id']);
                    echo $rss['pername'].''.$rss['name'].' '.$rss['lname'];
                ?>
            </td>
            <td><?php echo $rs['statusname'] ?></td>
            <td><?php echo $system->thaidate($rs['create_date']) ?></td>
            <td style="text-align: center;">
                <a href="<?php echo Yii::app()->createUrl('Masuser/view',array('id' => $rs['id']))?>"><i class="fa fa-eye"></i></a>
                <a href="<?php echo Yii::app()->createUrl('Masuser/update',array('id' => $rs['id']))?>"><i class="fa fa-pencil"></i></a>
                
                <?php if($rs['id'] != '1'){ ?>
                    <a href="javascript:deletuser('<?php echo $rs['id']?>')"><i class="fa fa-trash"></i></a>
                <?php } else { ?>
                    <a href="javascript:alert('ไม่สามารถลบ ผู้ใช้งานที่เป็น Admin ...')"><i class="fa fa-trash"></i></a>
                <?php } ?>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>


<script type="text/javascript">
    $(document).ready(function(){
        $("#tuser").dataTable();
    });
        function deletuser(id){
            var r = confirm("คุณแน่ใจหรือไม่ ...");
            if(r == true){
                var url = "<?php echo Yii::app()->createUrl('Masuser/delete')?>";
                var data = {id: id};
                $.post(url,data,function(success){
                    window.location.reload();
                });
            }
        }
    </script>