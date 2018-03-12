<?php
/* @var $this BonuslevelController */
/* @var $model Bonuslevel */

$this->breadcrumbs = array(
    'Bonuslevels' => array('index'),
    'Manage',
);
?>

<h4>Manage Bonuslevels</h4>

<a href="<?php echo Yii::app()->createUrl('bonuslevel/create') ?>">
    <button type="button" class="btn btn-default"><i class="fa fa-plus"></i>เพิ่ม</button></a>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('booster.widgets.TbGridView', array(
    'id' => 'bonuslevel-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'startlevel',
        'endlevel',
        'bonus',
        array(
            'name' => 'branch',
            'type' => 'raw',
            'filter' => CHtml::listData(Branch::model()->findall('id!=:id', array(':id' => '99')), 'id', 'branchname'),
            'value' => function($data) {
                return Branch::model()->find('id=:id', array(':id' => $data->branch))['branchname'];
            }
        ),
        array(
            'name' => 'user_status',
            'type' => 'raw',
            'filter' => CHtml::listData(StatusUser::model()->findall(), 'id', 'status'),
            'value' => function($data) {
                return StatusUser::model()->find('id=:id', array(':id' => $data->user_status))['status'];
            }
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
        ),
    ),
));
?>
