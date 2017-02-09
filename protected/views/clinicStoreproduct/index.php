<?php
$this->breadcrumbs = array(
    "คลังสินค้า" => array('storeclinic/index'),
    "คลังสินค้า (สาขา" . $branchname . ")"
);

$web = new Configweb_model();
?>
<input type="hidden" id="branch" value="<?php echo $branch ?>"/>
<div class="panel panel-info">
    <div class="panel-heading" style=" padding-bottom: 15px; padding-right: 5px;">
        คลังสินค้า  <span id="loading"></span>
        <div class="pull-right">
            <a href="<?php echo Yii::app()->createUrl('clinicstoreproduct/create', array('branch' => $branch)) ?>">
                <div class="btn btn-success btn-sm">
                    <i class="fa fa-plus"></i>
                    <i class="fa fa-cart-plus"></i>
                    เพิ่มสินค้าเข้าคลัง</div></a>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-2" style=" text-align: right;">
                <label>หมวดสินค้า</label>
            </div>
            <div class="col-lg-3">
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
            <div class="col-lg-3">
                <div id="boxsubproducttype">
                    <select id="subproducttype" class="form-control">
                        <option value=""></option>
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <button type="button" class="btn btn-default" onclick="getdata();">ค้นหา</button>
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
