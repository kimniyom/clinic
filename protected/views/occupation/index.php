<?php
/* @var $this OcupationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Ocupations',
);
?>

<h1>Ocupations</h1>
<a href="<?php echo Yii::app()->createUrl('occupation/create') ?>">
    <button type="button" class="btn btn-default"><i class="fa fa-plus"></i> เพิ่มอาชีพ</button></a>
    <br/><br/>
    
    <table class="table table-bordered table-striped" id="occupation">
    <thead>
        <tr>
            <th>#</th>
            <th>อาชีพ</th>
            <th style="text-align: center;">action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0;
        foreach ($occupation as $rs): $i++; ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $rs['occupationname'] ?></td>
                <td style=" text-align: center;">
                    <a href="<?php echo Yii::app()->createUrl('occupation/view',array('id' => $rs['id']))?>"><i class="fa fa-eye"></i></a>
                    <a href="<?php echo Yii::app()->createUrl('occupation/update',array('id' => $rs['id']))?>"><i class="fa fa-pencil"></i></a>
                    <i class="fa fa-trash-o"></i>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    
    <script type="text/javascript">
        $(document).ready(function(){
           $("#occupation").dataTable(); 
        });
    </script>