<?php
/* @var $this CenterStockcompanyController */
/* @var $model CenterStockcompany */

$this->breadcrumbs = array(
    /*
      'Center Stockcompanies'=>array('index'),
      $model->id=>array('view','id'=>$model->id),
     * 
     */
    "คลังสินค้า" => array('store/index'),
    "บริษัท" => array('centerstockcompany/index'),
    'Update',
);

$this->menu = array(
    array('label' => 'List CenterStockcompany', 'url' => array('index')),
    array('label' => 'Create CenterStockcompany', 'url' => array('create')),
    array('label' => 'View CenterStockcompany', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage CenterStockcompany', 'url' => array('admin')),
);
?>

<h1>แก้ไข <?php echo $model->company_name; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>