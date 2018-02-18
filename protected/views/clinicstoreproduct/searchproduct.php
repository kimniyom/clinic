<?php
/* @var $this OrdersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'ค้นหาสินค้า',
);
?>

<div class="panel panel-default" style=" margin-bottom: 0px;">
    <div class="panel-heading" style="background: none;">
        <i class="fa fa-search"></i> ค้นหาสินค้า  <span id="loading"></span>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <label>รหัสสินค้า</label>
                <input type="text" class="form-control" id="product_code" />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-2">
                <label>สาขา*</label>
                <?php
                $this->widget('booster.widgets.TbSelect2', array(
                    'name' => 'branch',
                    'id' => 'branch',
                    'data' => CHtml::listData($BranchList, 'id', 'branchname'),
                    'value' => $branch,
                    'options' => array(
                        'placeholder' => 'เลือกสาขา',
                        'width' => '100%',
                        'allowClear' => true,
                    )
                        )
                );
                ?>
            </div>
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
                    <label>ประเภท</label>
                    <select id="subproducttype" class="form-control">
                        <option value=""></option>
                    </select>
                </div>
            </div>

            <div class="col-lg-2 col-md-2">
                <button type="button" class="btn btn-default" style=" margin-top: 25px;" onclick="getdata();">ค้นหา</button>
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
        var product_id = $("#product_code").val();
        var url = "<?php echo Yii::app()->createUrl('clinicstoreproduct/datasearchproduct') ?>";
        var data = {
            type_id: type_id,
            subproducttype: subproducttype,
            branch: branch,
            product_id: product_id
        };
        $.post(url, data, function (datas) {
            $("#loading").html('');
            $("#showdata").html(datas);
        });
    }
</script>


