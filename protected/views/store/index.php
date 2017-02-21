<script src="<?= Yii::app()->baseUrl ?>/assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl ?>/assets/uploadify/uploadify.css">
<script type="text/javascript">
    $(document).ready(function () {
        $('#Filedata').uploadify({
            'buttonText': 'Logo ...',
            'auto': true, //เปิดใช้การอัพโหลดแบบอัติโนมัติ
            'swf': '<?= Yii::app()->baseUrl ?>/assets/uploadify/uploadify.swf', //โฟเดอร์ที่เก็บไฟล์ปุ่มอัพโหลด
            'uploader': "<?= Yii::app()->createUrl('companycenter/upload') ?>",
            'fileSizeLimit': '1MB', //อัพโหลดได้ครั้งละไม่เกิน 1024kb
            /*
             'width': '350',
             'height': '40',
             */
            'fileTypeExts': '*.jpg; *.png', //กำหนดชนิดของไฟล์ที่สามารถอัพโหลดได้
            'multi': false, //เปิดใช้งานการอัพโหลดแบบหลายไฟล์ในครั้งเดียว
            'queueSizeLimit': 1, //อัพโหลดได้ครั้งละ 5 ไฟล์
            'onUploadSuccess': function (file, data, response) {
                //alert(data);
                window.location.reload();
            }
        });
    });
</script>

<?php
/* @var $this ProductTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'คลังสินค้ากลาง',
);

$product_model = new Product();
?>

<h2>
    <img src="<?= Yii::app()->baseUrl; ?>/images/shipping-box-icon.png" 
         style="border-radius:20px; padding:2px; border:#FFF solid 2px;">
    คลังสินค้ากลาง     
</h2>
<hr/>
<h4>ที่อยู่ / ข้อมูลติดต่อ</h4>
<div class="row">
    <div class="col-lg-2 col-md-2">
        <?php if (empty($company['logo'])) { ?>
            <img src="<?php echo Yii::app()->baseUrl; ?>/images/No_image_available.jpg" width="50" style="margin: 0px;"/>
        <?php } else { ?>
            <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $company['logo'] ?>" width="50" style="margin: 0px;"/>
        <?php } ?>
        <input id="Filedata" name="Filedata" type="file" multiple="true">
    </div>
    <div class="col-lg-10 col-md-10">
        บริษัท : <?php echo $company['companyname'] ?><br/>
        ที่อยู่ : <?php echo $company['address'] ?><br/>
        ผู้จัดการ : <?php echo $company['memager'] ?><br/>
        เบอร์โทร : <?php echo $company['tel'] ?><br/> 
        เลขประจำตัวผู้เสียภาษี : <?php echo $company['tax'] ?>
        <a href="<?php echo Yii::app()->createUrl('companycenter/update', array('id' => 1)) ?>">
            <i class="fa fa-pencil"></i> แก้ไข</a>
    </div>

</div>
<hr/>
<h4>สินค้า</h4>
<div class="row">
    <!--
    <div class="col-lg-2 col-md-2">
        <a href="<?//php echo Yii::app()->createUrl('centerstoreproduct/index') ?>">
            <button type="button" class="btn btn-success btn-block">
                <img src="<?//= Yii::app()->baseUrl; ?>/images/box-icon.png"/><br/>
                คลังสินค้า
            </button></a>
    </div>
    -->
    <div class="col-lg-2 col-md-2">
        <a href="<?php echo Yii::app()->createUrl('centerstockproduct/index') ?>">
            <button type="button" class="btn btn-success btn-block">
                <img src="<?= Yii::app()->baseUrl; ?>/images/Product-sale-report-icon.png"/><br/>
                รายการสินค้า
            </button></a>
    </div>

    <div class="col-lg-2 col-md-2">
        <a href="<?php echo Yii::app()->createUrl('unit/index') ?>">
            <button type="button" class="btn btn-default btn-block">
                <img src="<?= Yii::app()->baseUrl; ?>/images/unit-icon.png"><br/>
                หน่วยนับ สินค้า
            </button></a>
    </div>

    <div class="col-lg-2 col-md-2">
        <a href="<?php echo Yii::app()->createUrl('centerstockcompany/index') ?>">
            <button type="button" class="btn btn-default btn-block">
                <img src="<?= Yii::app()->baseUrl; ?>/images/company-building-icon.png"><br/>
                บริษัทสั่งซื้อวัตถุดิบ
            </button></a>
    </div>
    <div class="col-lg-4 col-md-2">
        <label>รายงาน</label>
        <button type="button" class="btn btn-default btn-block" onclick="PopupCenter('<?php echo Yii::app()->createUrl('reportstorecenter/formreportincome')?>','รายงานรายได้จากการขายสินค้า')">รายงานรายได้จากการขายสินค้า</button>
        <button type="button" class="btn btn-default btn-block">รายงานการซื้อสินค้าแต่ละสาขา</button>
    </div>

</div>
<hr/>
<h4>วัตถุดิบ</h4>
<div class="row">
    <div class="col-lg-2 col-md-2">
        <a href="<?php echo Yii::app()->createUrl('centerstockitem/index') ?>">
            <button type="button" class="btn btn-primary btn-block">
                <img src="<?= Yii::app()->baseUrl; ?>/images/store-icon.png"/><br/>
                คลังวัตถุดิบ
            </button></a>
    </div>
    <div class="col-lg-2 col-md-2">
        <a href="<?php echo Yii::app()->createUrl('centerstockitemname/index') ?>">
            <button type="button" class="btn btn-primary btn-block">
                <img src="<?= Yii::app()->baseUrl; ?>/images/product-icon.png"/><br/>
                รายการวัตถุดิบ
            </button></a>
    </div>

    <div class="col-lg-2 col-md-2">
        <a href="<?php echo Yii::app()->createUrl('centerstockunit/index') ?>">
            <button type="button" class="btn btn-default btn-block">
                <img src="<?= Yii::app()->baseUrl; ?>/images/unit-icon.png"><br/>
                หน่วยนับ วัตถุดิบ
            </button></a>
    </div>
    <div class="col-lg-4 col-md-2">
        <label>รายงาน</label>
        <button type="button" class="btn btn-default btn-block">รายงานการนำเข้าวัตถุดิบ</button>
        <button type="button" class="btn btn-default btn-block">รายงานการสั่งซื้อวัตถุดิบ</button>
    </div>
</div>


