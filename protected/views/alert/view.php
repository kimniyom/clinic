<?php
/* @var $this AlertController */
/* @var $model Alert */

$this->breadcrumbs = array(
    'แจ้งเตือน'
);
?>

<h1>แจ้งเตือน</h1>
<a href="<?php echo Yii::app()->createUrl('alert/update', array('id' => 1)) ?>">
    <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> แก้ไข</button></a>
<br/><br/>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'id',
        'alert_appoint',
        'alert_product',
        'alert_expire',
    ),
));
?>
