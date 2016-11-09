<?php
/* @var $this PositionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Positions',
);

$this->menu=array(
	array('label'=>'Create Position', 'url'=>array('create')),
	array('label'=>'Manage Position', 'url'=>array('admin')),
);
?>

<h1>Positions</h1>
<a href="<?php echo Yii::app()->createUrl('position/create')?>">
    <button type="button" class="btn btn-success"><i class="fa fa-plus"></i> เพิ่ม</button></a>
<br/><br/>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>ตำแหน่ง</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0;foreach($position as $rs): $i++;?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $rs['position'] ?></td>
            <td style=" text-align: center;">
                <a href="<?php echo Yii::app()->createUrl('position/update',array('id' => $rs['id']))?>"><i class="fa fa-pencil"></i></a>
                <a href=""><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
