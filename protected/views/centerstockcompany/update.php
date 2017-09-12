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

?>

<h1>แก้ไข <?php echo $model->company_name; ?></h1>
<hr/>
<?php $this->renderPartial('_form', array('model' => $model)); ?>