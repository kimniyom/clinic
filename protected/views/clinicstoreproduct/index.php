<?php
$this->breadcrumbs = array(
    "คลังสินค้า" => array('storeclinic/index'),
    "คลังสินค้า (สาขา" . $branchname . ")"
);

$web = new Configweb_model();
?>
<input type="hidden" id="branch" value="<?php echo $branch ?>"/>
<div class="panel panel-default" style=" margin-bottom: 0px;">
    <div class="panel-heading" style=" padding-bottom: 15px; padding-right: 5px; background: none;">
        คลังสินค้า  <span id="loading"></span>  <span style=" color: #ff3300;">*สินค้าล๊อตที่มีการตัดสต๊อกไปแล้วไม่สามารถลบได้</span>
        <?php if (Yii::app()->session['branch'] == $branch) { ?>
            <div class="pull-right">
                <a href="<?php echo Yii::app()->createUrl('clinicstoreproduct/create', array('branch' => $branch)) ?>">
                    <div class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i>
                        <i class="fa fa-cart-plus"></i>
                        เพิ่มสินค้าเข้าคลัง</div></a>
            </div>
        <?php } ?>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <label>หมวดสินค้า</label>
                <?php
                $this->widget('booster.widgets.TbSelect2', array(
                    //'model' => $model,
                    'asDropDownList' => true,
                    //'attribute' => 'itemid',
                    'name' => 'producttype',
                    'id' => 'producttype',
                    'data' => CHtml::listData(ProductType::model()->findAll("upper IS NULL"), 'id', 'type_name'),
                    //'value' => $model,
                    'options' => array(
                        //$model,
                        'allowClear' => true,
                        //'oid',
                        //'tags' => array('clever', 'is', 'better', 'clevertech'),
                        'placeholder' => 'ทั้งหมด',
                        'width' => '100%',
                    //'tokenSeparators' => array(',', ' ')
                    )
                ));
                ?>
            </div>
             <div class="col-lg-3 col-md-3">
                <div id="boxsubproducttype">
                    <label>ประเภทสินค้า</label>
                    <select id="subproducttype" class="form-control">
                        <option value=""></option>
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-sm-2 col-xs-3">
                <button type="button" class="btn btn-primary" style=" margin-top: 25px;" onclick="getdata();"><i class="fa fa-search"></i> ค้นหา</button>
            </div>
        </div>
        <hr/>

        <div id="showdata">

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        getdata();
        $("#producttype").change(function () {
            var type_id = $("#producttype").val();
            var url = "<?php echo Yii::app()->createUrl('producttype/getsubproduct') ?>";
            var data = {type_id: type_id};
            $.post(url, data, function (datas) {
                $("#boxsubproducttype").html(datas);
            });
        });
    });

    function getdata() {
        var loading = '<i class="fa fa-spinner fa-spin fa-fw"></i>';
        $("#loading").html(loading);
        var type_id = $("#producttype").val();
        var branch = $("#branch").val();
        var subproducttype = $("#subproducttype").val();
        var url = "<?php echo Yii::app()->createUrl('clinicstoreproduct/getdatastockproduct') ?>";
        var data = {
            type_id: type_id,
            subproducttype: subproducttype,
            branch: branch};
        $.post(url, data, function (datas) {
            $("#loading").html('');
            $("#showdata").html(datas);
        });
    }
</script>
