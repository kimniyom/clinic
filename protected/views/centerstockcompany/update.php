<?php
/* @var $this CenterStockcompanyController */
/* @var $model CenterStockcompany */

$this->breadcrumbs = array(
    /*
      'Center Stockcompanies'=>array('index'),
      $model->id=>array('view','id'=>$model->id),
     * 
     */
    //"คลังสินค้า" => array('store/index'),
    "บริษัทสั่งซื้อวัตถุดิบ" => array('centerstockcompany/index'),
    'แก้ไข',
);

?>

<h1>แก้ไข <?php echo $model->company_name; ?></h1>
<hr/>
<?php $this->renderPartial('_form', array('model' => $model)); ?>