<?php
/* @var $this MascommisionController */
/* @var $model Mascommision */

$this->breadcrumbs=array(
	'Mascommisions'=>array('index'),
	'Manage',
);

?>

<h4>Manage Mascommisions</h4>

<a href="<?php echo Yii::app()->createUrl('Mascommision/create') ?>">
    <button type="button" class="btn btn-default"><i class="fa fa-plus"></i>เพิ่ม</button></a>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'mascommision-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'commisionname',
		        array(
            'name' => 'user_status',
            'type' => 'raw',
            'filter' => CHtml::listData(StatusUser::model()->findall(), 'id', 'status'),
            'value' => function($data) {
                return StatusUser::model()->find('id=:id', array(':id' => $data->user_status))['status'];
            }
        ),
		'valuecom',
		array(
            'name' => 'typevalue',
            'type' => 'raw',
            //'filter' => CHtml::listData(StatusUser::model()->findall(), 'id', 'status'),
            'value' => function($data) {
            	return ($data->typevalue == 0) ? "%" : "บาท";
                //return StatusUser::model()->find('id=:id', array(':id' => $data->user_status))['status'];
            }
        ),
		array(
			'class'=>'CButtonColumn',
			'template' => '{update}{delete}',
		),
	),
)); ?>
