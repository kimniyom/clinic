<?php
if (Yii::app()->session['status'] == '1') {
    $status = "คลังสินค้าย่อย";
} else {
    $status = "คลังสินค้า";
}
$this->breadcrumbs = array(
    $status => array('storeclinic/index'),
    "รายการสินค้า (สาขา" . $branchname . ")"
);

$web = new Configweb_model();
?>

<div class="panel panel-default" style=" margin-bottom: 0px;">
    <div class="panel-heading" style=" padding-bottom: 15px; padding-right: 5px; background: none;">
        รายการสินค้า  <span id="loading"></span>
        <?php if (Yii::app()->session['branch'] == $branch) { ?>
            <div class="pull-right">
                <a href="<?php echo Yii::app()->createUrl('clinicstockproduct/create', array("branch" => $branch)) ?>">
                    <div class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i>
                        <i class="fa fa-cart-plus"></i>
                        เพิ่มรายการสินค้า</div></a>
            </div>
        <?php } ?>
    </div>
    <div class="panel-body" style="padding: 10px;">
        <div class="row">
            <div class="col-lg-3">
                <label>หมวด</label>
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
                    <label>ประเภทสินค้า</label>
                    <select id="subproducttype" class="form-control">
                        <option value=""></option>
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <button type="button" class="btn btn-primary" onclick="getdata();" style=" margin-top: 25px;"><i class="fa fa-search"></i> ค้นหา</button>
            </div>
        </div>
        <hr/>

        <div id="showdata"></div>
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
        var subproducttype = $("#subproducttype").val();
        var branch = "<?php echo $branch ?>";
        var url = "<?php echo Yii::app()->createUrl('clinicstockproduct/getdata') ?>";
        var data = {
            type_id: type_id,
            subproducttype: subproducttype,
            branch: branch
        };
        $.post(url, data, function (datas) {
            $("#loading").html('');
            $("#showdata").html(datas);
        });
    }
</script>
