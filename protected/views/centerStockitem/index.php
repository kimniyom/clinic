<?php
/* @var $this CenterStockitemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Center Stockitems',
);

$this->menu = array(
    array('label' => 'Create CenterStockitem', 'url' => array('create')),
    array('label' => 'Manage CenterStockitem', 'url' => array('admin')),
);
?>

<h1>รายการ Items</h1>
<a href="<?php echo Yii::app()->createUrl('centerstockitem/create') ?>">
    <button type="button" class="btn btn-default">เพิ่ม Item</button></a>
