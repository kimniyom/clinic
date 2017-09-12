<?php
/* @var $this ServiceDrugController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Service Drugs',
);

$this->menu = array(
    array('label' => 'Create ServiceDrug', 'url' => array('create')),
    array('label' => 'Manage ServiceDrug', 'url' => array('admin')),
);
?>

<h1>Service Drugs</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
